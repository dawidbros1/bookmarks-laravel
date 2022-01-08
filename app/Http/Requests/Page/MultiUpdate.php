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
                'public' => ['required', 'array'],
                'order' => ['required', 'array'],
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
            'public.required' => 'Pole public[] jest wymagane',
            'order.required' => 'Pole order[] jest wymagane',
            'open.required' => 'Pole open[] jest wymagane',

            'type.required' => 'Pole type jest wymagane.',
            'type.in' => 'Pole type musi posiadać wartość category lub subcategory',
        ];
    }
}
