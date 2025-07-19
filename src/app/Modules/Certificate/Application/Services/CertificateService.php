<?php

namespace App\Modules\Certificate\Application\Services;

use App\Modules\Certificate\Domain\Entities\Certificate;
use App\Modules\Certificate\Infrastructure\Repositories\CertificateRepositoryInterface;
use App\Shared\Base\BaseService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CertificateService extends BaseService
{
    protected CertificateRepositoryInterface $repository;

    public function __construct(CertificateRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get paginated list of certificate records.
     *
     * @param int $perPage Number of records per page.
     * @return LengthAwarePaginator Paginated certificate records.
     */
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }

    /**
     * Create a new certificate record with transaction.
     *
     * @param array $data Data for the new certificate.
     * @return Certificate The newly created certificate entity.
     */
    public function create(array $data): Certificate
    {
        return $this->handleTransaction(function () use ($data) {
            return $this->repository->create($data);
        });
    }

    /**
     * Find a certificate record by its ID.
     *
     * @param int $id The ID of the certificate.
     * @return Certificate|null The certificate entity or null if not found.
     */
    public function findById(int $id): ?Certificate
    {
        return $this->repository->findById($id);
    }

    /**
     * Update an existing certificate record with transaction.
     *
     * @param int $id The ID of the certificate.
     * @param array $data Updated data.
     * @return bool True if successful, false otherwise.
     */
    public function update(int $id, array $data): bool
    {
        return $this->handleTransaction(function () use ($id, $data) {
            return $this->repository->update($id, $data);
        });
    }

    /**
     * Soft delete a certificate record with transaction.
     *
     * @param int $id The ID of the certificate to delete.
     * @return bool True if deleted successfully, false otherwise.
     */
    public function delete(int $id): bool
    {
        return $this->handleTransaction(function () use ($id) {
            return $this->repository->delete($id);
        });
    }
}
