<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdRequest extends FormRequest
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
            'name' => ['string', 'required', 'max:30'],
            'description' => ['string', 'required', 'max:1000', 'min:50'],
            'price' => ['required', 'numeric', 'min:0'],
            'img_url' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp']
        ];
    }
}
