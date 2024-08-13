<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => ['required', 'string', Rule::unique('products', 'name')->ignore($this->id)],
            "slug" => ['required', 'string', Rule::unique('products', 'slug')->ignore($this->id)],
            "short_description" => ['nullable', 'string'],
            "description" => ['nullable', 'string'],
            "category_id" => ['nullable', 'exists:categories,id'],
            "brand_id" => ['nullable', "exists:product_brands,id"],
            "featured_image" => ["string", "nullable"],
            "price" => ['integer', 'required'],
            "discount_price" => ['nullable', "integer", "lt:price"],
            "images" => ["array"],
            "in_stock" => ['boolean', 'nullable'],
            "visible" => ['boolean', 'nullable'],
            "specifications" => ["nullable"]
        ];
    }
}
