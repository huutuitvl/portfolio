<?php

namespace App\Modules\Contact\Infrastructure\Repositories;

use App\Modules\Contact\Domain\Entities\Contact;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ContactRepository implements ContactRepositoryInterface
{
    /**
     * @inheritdoc
     */
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return Contact::latest()->paginate($perPage);
    }

    /**
     * @inheritdoc
     */
    public function create(array $data): Contact
    {
        return Contact::create($data);
    }

    /**
     * @inheritdoc
     */
    public function update(int $id, array $data): Contact
    {
        $contact = $this->findById($id);
        $contact->update($data);
        return $contact;
    }

    /**
     * @inheritdoc
     */
    public function delete(int $id): bool
    {
        $contact = $this->findById($id);
        return $contact->delete();
    }

    /**
     * @inheritdoc
     */
    public function findById(int $id): ?Contact
    {
        return Contact::find($id);
    }
}
