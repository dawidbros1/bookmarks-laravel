<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
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
            'name' => ['required', 'min:1', 'max:255'],
            'image_url' => ['required', 'min:1', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Pole nazwa kategorii jest wymagane.',
            'name.min' => 'Nazwa kategorii nie może być krótsza niż :min znak.',
            'name.max' => 'Nazwa kategorii nie może być dłuższa niż :max. znaków.',

            'image_url.required' => 'Pole adres obrazka jest wymagane.',
            'image_url.min' => 'Adres obrazka nie może być krótszy niż :min znak.',
            'image_url.max' => 'Adres obrazka nie może być dłuższy niż :max znaków.',
        ];
    }
}
