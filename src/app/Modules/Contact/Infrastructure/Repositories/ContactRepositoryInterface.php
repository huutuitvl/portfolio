<?php

namespace App\Modules\Contact\Infrastructure\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Modules\Contact\Domain\Entities\Contact;

interface ContactRepositoryInterface
{
    /**
     * Get a paginated list of contacts.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 10): LengthAwarePaginator;

    /**
     * Store a new contact record.
     *
     * @param array $data
     * @return Contact
     */
    public function create(array $data): Contact;

    /**
     * Update an existing contact record.
     *
     * @param int $id
     * @param array $data
     * @return Contact
     */
    public function update(int $id, array $data): Contact;

    /**
     * Delete a contact record.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;

    /**
     * Find a contact by ID.
     *
     * @param int $id
     * @return Contact|null
     */
    public function findById(int $id): ?Contact;
}
