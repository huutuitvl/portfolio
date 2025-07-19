<?php

namespace App\Modules\Certificate\Infrastructure\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Modules\Certificate\Domain\Entities\Certificate;

interface CertificateRepositoryInterface
{
    /**
     * Retrieve a paginated list of certificate records.
     *
     * @param int $perPage Number of records per page (default: 10).
     * @return LengthAwarePaginator Paginated list of certificates.
     */
    public function paginate(int $perPage = 10): LengthAwarePaginator;

    /**
     * Store a newly created certificate record.
     *
     * @param array $data Associative array of certificate data.
     * @return Certificate The created certificate entity.
     */
    public function create(array $data): Certificate;

    /**
     * Find a certificate record by its unique ID.
     *
     * @param int $id The ID of the certificate.
     * @return Certificate|null The certificate if found, or null.
     */
    public function findById(int $id): ?Certificate;

    /**
     * Update an existing certificate record.
     *
     * @param int $id The ID of the certificate to update.
     * @param array $data The new data to apply.
     * @return bool True if the update was successful, false otherwise.
     */
    public function update(int $id, array $data): bool;

    /**
     * Soft delete a certificate record by ID.
     *
     * @param int $id The ID of the certificate to delete.
     * @return bool True if the deletion was successful, false otherwise.
     */
    public function delete(int $id): bool;
}
