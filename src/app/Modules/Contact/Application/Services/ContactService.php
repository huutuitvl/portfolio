<?php

namespace App\Modules\Contact\Application\Services;

use App\Modules\Contact\Infrastructure\Repositories\ContactRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Modules\Contact\Domain\Entities\Contact;

class ContactService
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
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return $this->contactRepository->paginate($perPage);
    }

    /**
     * Store a new contact record.
     *
     * @param array $data
     * @return Contact
     */
    public function create(array $data): Contact
    {
        return $this->contactRepository->create($data);
    }
}