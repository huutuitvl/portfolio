<?php

namespace App\Modules\Contact\Application\Services;

use App\Modules\Contact\Infrastructure\Repositories\ContactRepositoryInterface;
use App\Modules\Contact\Domain\Entities\Contact;
use App\Shared\Base\BaseService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ContactService extends BaseService
{
    protected ContactRepositoryInterface $contactRepository;

    /**
     * ContactService constructor.
     *
     * @param ContactRepositoryInterface $contactRepository
     */
    public function __construct(ContactRepositoryInterface $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    /**
     * Get a paginated list of contact records.
     *
     * @param int $perPage Number of records per page.
     * @return LengthAwarePaginator Paginated list of contacts.
     */
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return $this->contactRepository->paginate($perPage);
    }

    /**
     * Store a new contact record with transaction handling.
     *
     * @param array $data Data for the new contact record.
     * @return Contact Newly created contact entity.
     */
    public function create(array $data): Contact
    {
        return $this->handleTransaction(function () use ($data) {
            return $this->contactRepository->create($data);
        });
    }
}
