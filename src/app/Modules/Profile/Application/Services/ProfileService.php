<?php

namespace App\Modules\Profile\Application\Services;

use App\Modules\Profile\Domain\Entities\Profile;
use App\Shared\Base\BaseService;
use Illuminate\Database\Eloquent\Collection;

class ProfileService extends BaseService
{
    /**
     * Get all profile records.
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Profile::all();
    }

    /**
     * Get a single profile by ID.
     *
     * @param int $id
     * @return Profile|null
     */
    public function getById(int $id): ?Profile
    {
        return Profile::find($id);
    }

    /**
     * Get the first profile record.
     *
     * @return Profile|null
     */
    public function getFirst(): ?Profile
    {
        return Profile::first();
    }

    /**
     * Create a new profile with transaction.
     *
     * @param array $data
     * @return Profile
     */
    public function create(array $data): Profile
    {
        return $this->handleTransaction(function () use ($data) {
            $data['created_by'] = auth()->id();
            return Profile::create($data);
        });
    }

    /**
     * Update an existing profile with transaction.
     *
     * @param Profile $profile
     * @param array $data
     * @return Profile
     */
    public function update(Profile $profile, array $data): Profile
    {
        return $this->handleTransaction(function () use ($profile, $data) {
            $data['updated_by'] = auth()->id();
            $profile->update($data);
            return $profile;
        });
    }

    /**
     * Soft delete a profile with transaction.
     *
     * @param Profile $profile
     * @return void
     */
    public function delete(Profile $profile): void
    {
        $this->handleTransaction(function () use ($profile) {
            $profile->delete();
        });
    }
}
