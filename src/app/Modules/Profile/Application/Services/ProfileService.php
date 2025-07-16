<?php

namespace App\Modules\Profile\Application\Services;

use App\Modules\Profile\Domain\Entities\Profile;

class ProfileService
{
    /**
     * Retrieve the first profile.
     *
     * @return Profile|null
     */
    public function getAll()
    {
        return Profile::all();
    }

    /**
     * Retrieve the first profile.
     *
     * @return Profile|null
     */
    public function getById($id): ?Profile
    {
        return Profile::find($id);
    }

    /**
     * Retrieve the first profile.
     *
     * @return Profile|null
     */
    public function getFirst(): ?Profile
    {
        return Profile::first();
    }

    /**
     * Retrieve the first profile.
     *
     * @return Profile|null
     */
    public function create(array $data): Profile
    {
        $data['created_by'] = auth()->id();

        return Profile::create($data);
    }

    /**
     * Update an existing profile.
     *
     * @param Profile $profile
     * @param array $data
     * @return Profile
     */
    public function update(Profile $profile, array $data): Profile
    {
        $data['updated_by'] = auth()->id();

        $profile->update($data);

        return $profile;
    }

    /**
     * Delete a profile.
     *
     * @param Profile $profile
     * @return void
     */
    public function delete(Profile $profile): void
    {
        $profile->delete();
    }
}
