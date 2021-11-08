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
        return [
            'ids' => ['required', 'array'],
            'hidden' => ['required', 'array'],
            'public' => ['required', 'array'],
            'order' => ['required', 'array'],
            'open' => ['required', 'array'],
        ];
    }

    public function messages()
    {
        return [
            'ids.required'  => 'Pole ids[] jest wymagane',
            'hidden.required'  => 'Pole hidden[] jest wymagane',
            'public.required' => 'Pole public[] jest wymagane',
            'order.required' => 'Pole order[] jest wymagane',
        ];
    }
}