<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = $this->user();
        if ($user){
            return ($user->can('add product') || $user->can('allow all actions')) ? true : false;
        } else return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:1000'],
            'quantity' => ['required', 'regex:/^(\d+(,\d{1,2})?)?$/'],
            'price' => ['required', 'regex:/^(\d+(,\d{1,2})?)?$/'],
            'category_id' => ['required', 'exists:categories,id'],
            'general_image' => ['nullable','mimes:jpg,jpeg,png,bmp,tiff', 'max:1024'],
            'multiple_image.*' => ['nullable','mimes:jpg,jpeg,png,bmp,tiff', 'max:1024'],
        ];
    }
}
