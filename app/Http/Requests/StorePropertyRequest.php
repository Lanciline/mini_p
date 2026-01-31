<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePropertyRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price_per_night' => 'required|numeric|min:0',
            'city' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:1024',
            'images.*' => 'nullable|image|max:5120',
        ];
    }
}
