<?php

namespace App\Http\Requests\Menu;

use Illuminate\Foundation\Http\FormRequest;

class StoreDailyMenuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->role === 'restaurant_owner' || $this->user()->role === 'admin';
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'date' => ['required', 'date', 'after_or_equal:today'],
            'sections' => ['required', 'array', 'min:1'],
            'sections.*.name' => ['required', 'string', 'max:100'],
            'sections.*.order' => ['sometimes', 'integer', 'min:0'],
            'sections.*.dishes' => ['required', 'array', 'min:1'],
            'sections.*.dishes.*.name' => ['required', 'string', 'max:255'],
            'sections.*.dishes.*.description' => ['nullable', 'string'],
        ];
    }
}
