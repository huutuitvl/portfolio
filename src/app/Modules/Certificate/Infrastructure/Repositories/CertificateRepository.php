<?php

namespace App\Modules\Certificate\Infrastructure\Repositories;

use App\Modules\Certificate\Domain\Entities\Certificate;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CertificateRepository implements CertificateRepositoryInterface
{
    /**
     * Retrieve a paginated list of certificate records.
     *
     * @param int $perPage Number of records per page.
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return Certificate::query()->latest()->paginate($perPage);
    }

    /**
     * Store a newly created certificate.
     *
     * @param array $data Certificate data.
     * @return Certificate
     */
    public function create(array $data): Certificate
    {
        return Certificate::create($data);
    }

    /**
     * Find a certificate by ID.
     *
     * @param int $id Certificate ID.
     * @return Certificate|null
     */
    public function findById(int $id): ?Certificate
    {
        return Certificate::find($id);
    }

    /**
     * Update a certificate record.
     *
     * @param int $id Certificate ID.
     * @param array $data Updated data.
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        $certificate = Certificate::find($id);
        if (!$certificate) {
            return false;
        }

        return $certificate->update($data);
    }

    /**
     * Soft delete a certificate record.
     *
     * @param int $id Certificate ID.
     * @return bool
     */
    public function delete(int $id): bool
    {
        $certificate = Certificate::find($id);
        if (!$certificate) {
            return false;
        }

        return $certificate->delete();
    }
}
