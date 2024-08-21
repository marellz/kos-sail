<?php

namespace App\Http\Requests;

use App\Rules\MaxPrice;
use Illuminate\Foundation\Http\FormRequest;

class ProductFilterRequest extends FormRequest
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
            'order_by' => ['nullable'],
            'category_id' => ['nullable', 'int'],
            'query' => ['nullable'],
            'price_max' => ['nullable', 'int', new MaxPrice],
            'price_min' => ['nullable', 'int', 'sometimes'],
        ];
    }
}
