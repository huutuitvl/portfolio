<?php

namespace App\Core\Repositories\Eloquent;

use App\Core\Repositories\Contracts\BaseRepositoryInterface;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Throwable;

/**
 * Class BaseRepository
 *
 * Provides base CRUD and pagination logic for Eloquent models,
 * with transaction handling for create, update, and delete operations.
 */
abstract class BaseRepository implements BaseRepositoryInterface
{
    /**
     * The Eloquent model instance.
     *
     * @var Model
     */
    protected Model $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model The Eloquent model to be used.
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Paginate the results from the model.
     *
     * @param int $perPage Number of records per page.
     * @param array $columns The columns to select.
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 15, array $columns = ['*']): LengthAwarePaginator
    {
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * Find a record by its primary key.
     *
     * @param int|string $id The ID of the record.
     * @return Model|null
     */
    public function find($id): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * Create a new record with transaction.
     *
     * @param array $data
     * @return Model
     * @throws Throwable
     */
    public function create(array $data): Model
    {
        return $this->handleTransaction(function () use ($data) {
            return $this->model->create($data);
        });
    }

    /**
     * Update an existing record by ID with transaction.
     *
     * @param $id
     * @param array $data
     * @return mixed
     * @throws Throwable
     */
    public function update($id, array $data)
    {
        return $this->handleTransaction(function () use ($id, $data) {
            $record = $this->find($id);
            return $record ? tap($record)->update($data) : false;
        });
    }

    /**
     *  Delete a record by ID with transaction.
     *
     * @param $id
     * @return bool
     * @throws Throwable
     */
    public function delete($id): bool
    {
        return $this->handleTransaction(function () use ($id) {
            $record = $this->find($id);
            return $record ? (bool) $record->delete() : false;
        });
    }

    /**
     * Paginate with dynamic filter conditions.
     *
     * @param array $filters
     * @param int $page
     * @param int $perPage
     * @param callable|null $callback
     * @return LengthAwarePaginator
     */
    public function paginateWithFilter(array $filters = [], int $page = 1, int $perPage = 10, callable $callback = null): LengthAwarePaginator
    {
        $query = $this->model->newQuery();

        $this->applyFilters($query, $filters);

        if ($callback) {
            $callback($query); // allow deeper customization
        }

        return $query->paginate($perPage);
    }

    /**
     * Apply dynamic filter conditions to the query.
     *
     * Supported operators: =, like, in, between, null, not_null
     *
     * Example:
     * [
     *   ['column' => 'title', 'operator' => 'like', 'value' => '%laravel%'],
     *   ['column' => 'status', 'operator' => '=', 'value' => 'active'],
     *   ['column' => 'id', 'operator' => 'in', 'value' => [1,2,3]],
     *   ['column' => 'created_at', 'operator' => 'between', 'value' => ['2024-01-01', '2024-12-31']],
     * ]
     *
     * @param Builder $query
     * @param array $filters
     * @return void
     */
    protected function applyFilters(Builder $query, array $filters): void
    {
        foreach ($filters as $filter) {
            $column = $filter['column'] ?? null;
            $operator = strtolower($filter['operator'] ?? '=');
            $value = $filter['value'] ?? null;

            if (!$column || $value === null) {
                continue; // Skip invalid filters
            }

            switch ($operator) {
                case 'like':
                    $query->where($column, 'like', $value);
                    break;

                case '=':
                case '!=':
                case '>':
                case '>=':
                case '<':
                case '<=':
                    $query->where($column, $operator, $value);
                    break;

                case 'in':
                    if (is_array($value)) {
                        $query->whereIn($column, $value);
                    }
                    break;

                case 'between':
                    if (is_array($value) && count($value) === 2) {
                        $query->whereBetween($column, $value);
                    }
                    break;

                case 'null':
                    $query->whereNull($column);
                    break;

                case 'not_null':
                    $query->whereNotNull($column);
                    break;

                default:
                    // Unknown operator - skip or log warning
                    break;
            }
        }
    }

    /**
     * Run a database transaction with automatic rollback and error handling.
     *
     * @param callable $callback
     * @return mixed
     * @throws Throwable
     */
    protected function handleTransaction(callable $callback)
    {
        try {
            return DB::transaction(function () use ($callback) {
                return $callback();
            });
        } catch (Throwable $e) {
            Log::error('Transaction failed: ' . $e->getMessage(), [
                'exception' => $e,
            ]);

            throw $e; // optional: rethrow the exception to handle it further up the stack
        }
    }
}
