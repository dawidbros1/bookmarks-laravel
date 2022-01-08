<?php

namespace App\Http\Requests\Page;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
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
                'name' => ['required', 'min:1', 'max:255'],
                'image_url' => ['required', 'min:1', 'max:255'],
                'link' => ['required', 'min:1', 'max:255'],
                'subcategory_id' => ['required', 'integer'],
                'category_id' => ['required', 'integer'],

            ];
        }

        return [];
    }

    public function messages()
    {
        return [
            'name.required' => 'Pole nazwa jest wymagane',
            'name.min' => 'Nazwa stony nie może być krótsza niż :min znak.',
            'name.max' => 'Nazwa stony nie może być dłuższa niż :max. znaków.',

            'image_url.required' => 'Pole adres obrazka jest wymagane.',
            'image_url.min' => 'Adres obrazka nie może być krótszy niż :min znak.',
            'image_url.max' => 'Adres obrazka nie może być dłuższy niż :max znaków.',

            'link.required' => 'Pole link do strony jest wymagane.',
            'link.min' => 'Link do strony nie może być krótszy niż :min znak.',
            'link.max' => 'Link do strony nie może być dłuższy niż :max znaków.',

            'subcategory_id.required' => 'Pole subcategory_id jest wymagane.',
            'subcategory_id.integer' => 'Pole subcategory_id musi być liczbą.',

            'category_id.required' => 'Pole category_id jest wymagane.',
            'category_id.integer' => 'Pole category_id musi być liczbą.',
        ];
    }
}
