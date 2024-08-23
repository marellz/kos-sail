<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'name' => ['string', 'required'],
            'user_id' => ['nullable', 'exists:user,id'],
            'email' => ['email', 'required'],
            'phone' => ['string', 'required', 'starts_with:+'],
            'subject' => ['string', 'nullable'],
            'message' => ['string', 'required'],
            'reply_to' => ['nullable', 'exists:contacts,id'],
        ];
    }
}
