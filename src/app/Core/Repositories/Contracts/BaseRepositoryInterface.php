<?php

namespace App\Core\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface BaseRepositoryInterface
 *
 * Defines the standard CRUD operations to be implemented
 * by all repository classes.
 */
interface BaseRepositoryInterface
{
    /**
     * Paginate the records.
     *
     * @param int $perPage Number of records per page.
     * @param array $columns Columns to select.
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 15, array $columns = ['*']): LengthAwarePaginator;

    /**
     * Find a record by its primary key.
     *
     * @param int|string $id Record ID.
     * @return Model|null
     */
    public function find($id): ?Model;

    /**
     * Create a new record.
     *
     * @param array $data Data to create.
     * @return Model
     */
    public function create(array $data): Model;

    /**
     * Update an existing record by ID.
     *
     * @param int|string $id Record ID.
     * @param array $data Data to update.
     * @return bool|Model False if not found, otherwise updated model.
     */
    public function update($id, array $data);

    /**
     * Delete a record by ID.
     *
     * @param int|string $id Record ID.
     * @return bool True if deleted, false if not found.
     */
    public function delete($id): bool;

    /**
     * Paginate with optional filter conditions.
     *
     * @param array $filters
     * @param int $page
     * @param int $perPage
     * @param callable|null $callback Optional callback for additional query customization.
     * @return LengthAwarePaginator
     */
    public function paginateWithFilter(array $filters = [], int $page = 1, int $perPage = 10, callable $callback = null): LengthAwarePaginator;
}
