<?php

namespace App\Http\Requests\Page;

use Illuminate\Foundation\Http\FormRequest;

class MultiUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->method() == "POST") {
            return [
                'ids' => ['required', 'array'],
                'hidden' => ['required', 'array'],
                'private' => ['required', 'array'],
                'position' => ['required', 'array'],
                'type' => ['required', 'in:category,subcategory'],
            ];
        }

        return [];
    }

    public function messages()
    {
        return [
            'ids.required'  => 'Pole ids[] jest wymagane',
            'hidden.required'  => 'Pole hidden[] jest wymagane',
            'private.required' => 'Pole private[] jest wymagane',
            'position.required' => 'Pole order[] jest wymagane',

            'type.required' => 'Pole type jest wymagane.',
            'type.in' => 'Pole type musi posiadać wartość category lub subcategory',
        ];
    }
}
