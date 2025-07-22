<?php

namespace App\Modules\Contact\Interface\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Helpers\PaginatorHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Modules\Contact\Application\Services\ContactService;
use App\Modules\Contact\Interface\Http\Requests\SearchContactRequest;
use App\Modules\Contact\Interface\Http\Requests\StoreContactRequest;
use App\Modules\Contact\Interface\Http\Requests\UpdateContactRequest;
use App\Modules\Contact\Interface\Http\Resources\ContactResource;

class ContactController extends Controller
{
    protected ContactService $contactService;

    /**
     * ContactController constructor.
     *
     * @param ContactService $contactService
     */
    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    /**
     * Get paginated list of contacts.
     *
     * @return JsonResponse
     */
    public function index(SearchContactRequest $request): JsonResponse
    {
        $contacts = $this->contactService->paginateWithFilter($request->validated(), $request->input('page', 1));

        if ($contacts->isEmpty()) {
            return ApiResponse::success([], 204);
        }

        return ApiResponse::success(
            PaginatorHelper::format($contacts, ContactResource::class)
        );
    }

    /**
     * Store a newly created contact.
     *
     * @param StoreContactRequest $request
     * @return JsonResponse
     */
    public function store(StoreContactRequest $request): JsonResponse
    {
        $contact = $this->contactService->create($request->validated());

        return  ApiResponse::success($contact, Response::HTTP_CREATED);
    }

    /**
     * Get a single contact by ID.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $contact = $this->contactService->getById($id);

        if (!$contact) {
            return ApiResponse::error('Contact not found', 404);
        }

        return ApiResponse::success($contact);
    }

    /**
     * Update a specific contact.
     *
     * @param UpdateContactRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateContactRequest $request, int $id): JsonResponse
    {
        $success = $this->contactService->update($id, $request->validated());

        if (!$success) {
            return ApiResponse::error('Blog not found', 404);
        }

        return ApiResponse::success(['message' => 'Updated successfully']);
    }

    /**
     * Delete a contact.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $success = $this->contactService->delete($id);

        if (!$success) {
            return ApiResponse::error('Blog not found', 404);
        }

        return ApiResponse::success(['message' => 'Deleted successfully']);
    }
}
