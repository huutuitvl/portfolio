<?php

namespace App\Http\Requests;

use App\Helpers\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseRequest extends FormRequest
{
    /**
     * This method runs after validation passes.
     * Here we check if any unexpected input fields were submitted
     * that are not defined in the validation rules.
     *
     * If any extra fields are found, a 422 validation exception is thrown.
     */
    protected function passedValidation()
    {
        $rules = array_keys($this->rules());           // Allowed fields
        $inputKeys = array_keys($this->all());         // Actual submitted fields

        $extraFields = array_diff($inputKeys, $rules); // Find unexpected fields

        if (!empty($extraFields)) {

            // Return API response manually with HTTP 200
            abort(
                response()->json(ApiResponse::error(
                    'Validation failed',
                    Response::HTTP_UNPROCESSABLE_ENTITY,
                    ['extra_fields' => ['These fields are not allowed: ' . implode(', ', $extraFields)]]
                ))
            );
        }
    }

    /**
     * This returns only the validated fields,
     * according to the rules() method in each child class.
     *
     * You can use $request->validated() in your controllers or services.
     */
    public function validated($key = null, $default = null)
    {
        return parent::validated();
    }
}
