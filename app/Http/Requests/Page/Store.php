<?php

namespace App\Http\Requests\Page;

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
            'name' => ['min:1, max:255'],
            'parent_id' => ['integer'],
            'type' => ['in:category,subcategory'],
            'link' => ["min:1, max:255"],
            'image_url' => ["min:1, max:255"],
            'hidden' => ['boolean'],
        ];
    }
}
