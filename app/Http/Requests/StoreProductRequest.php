<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'category_id' => 'required',
            'name' => 'required',
            'slug' => 'nullable',
            'brand' => 'nullable',
            'small_description' => 'nullable',
            'description' => 'nullable',
            'original_price' => 'nullable',
            'selling_price' => 'nullable',
            'quantity' => 'nullable',
            'trending' => 'nullable',
            'status' => 'nullable',
            'meta_title' => 'nullable',
            'meta_keyword' => 'nullable',
            'meta_description' => 'nullable',
            'image'=> [
                'nullable',
                //'image|mines:jpeg,png,jpg'
            ],
        ];
    }
}
