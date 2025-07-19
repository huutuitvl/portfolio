<?php

namespace App\Modules\Education\Infrastructure\Repositories;

use App\Modules\Education\Domain\Entities\Education;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EducationRepository implements EducationRepositoryInterface
{
    /**
     * Retrieve a paginated list of education records.
     *
     * @param int $perPage Number of records per page.
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return Education::orderBy('order')->paginate($perPage);
    }

    /**
     * Create a new education record.
     *
     * @param array $data Data for the new education record.
     * @return Education The newly created education entity.
     */
    public function create(array $data): Education
    {
        return Education::create($data);
    }

    /**
     * Find an education record by its ID.
     *
     * @param int $id The ID of the education record.
     * @return Education|null The education entity or null if not found.
     */
    public function findById(int $id): ?Education
    {
        return Education::find($id);
    }

    /**
     * Update an existing education record.
     *
     * @param int $id The ID of the education record to update.
     * @param array $data The updated data for the education record.
     * @return bool True if the update was successful, false otherwise.
     */
    public function update(int $id, array $data): bool
    {
        $education = Education::find($id);
        if (!$education) {
            return false;
        }

        return $education->update($data);
    }

    /**
     * Delete an education record by ID.
     *
     * @param int $id The ID of the education record to delete.
     * @return bool True if deletion was successful, false otherwise.
     */
    public function delete(int $id): bool
    {
        $education = Education::find($id);
        if (!$education) {
            return false;
        }

        return $education->delete();
    }
}
