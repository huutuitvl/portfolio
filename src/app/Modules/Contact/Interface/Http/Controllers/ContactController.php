<?php

namespace App\Modules\Contact\Interface\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Modules\Contact\Application\Services\ContactService;
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
    public function index(): JsonResponse
    {
        $contacts = $this->contactService->paginate(10);
        return response()->json(ContactResource::collection($contacts));
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
        return response()->json(new ContactResource($contact), Response::HTTP_CREATED);
    }

    /**
     * Get a single contact by ID.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $contact = $this->contactService->findById($id);
        if (!$contact) {
            return response()->json(['message' => 'Contact not found'], Response::HTTP_NOT_FOUND);
        }
        return response()->json(new ContactResource($contact));
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
        $contact = $this->contactService->update($id, $request->validated());
        return response()->json(new ContactResource($contact));
    }

    /**
     * Delete a contact.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $this->contactService->delete($id);
        return response()->json(['message' => 'Contact deleted successfully.']);
    }
}
