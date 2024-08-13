<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StoreProductRequest extends FormRequest
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
            "name" => ['required', 'string', 'unique:products,name'],
            "slug" => ['required', 'string', 'unique:products,slug'],
            "short_description" => ['nullable', 'string'],
            "description" => ['nullable', 'string'],
            "category_id" => ['nullable', 'exists:categories,id'],
            "brand_id" => ['nullable', "exists:product_brands,id"],
            "price" => ['integer', 'required'],
            "discount_price" => ['nullable', "integer", "lt:price"],
            "featured_image" => ["string", "nullable"],
            "images" => ["array"],
            "in_stock" => ['nullable', 'boolean'],
            "visible" => ['nullable', 'boolean'],
            "specifications" => ["nullable"]
        ];
    }

    protected function prepareforValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->name),
        ]);
    }
}
