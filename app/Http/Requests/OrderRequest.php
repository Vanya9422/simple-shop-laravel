<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @property mixed objectOrder
 * @property mixed objectUser
 * @property mixed withRegistration
 */
class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !$this->withRegistration && !Auth::user() ? false : true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $validationDataOrder = [
            'objectOrder.name' => ['required', 'string', 'max:255'],
            'objectOrder.last_name' => ['required', 'string', 'max:255'],
            'objectOrder.email' => ['required', 'string', 'email', 'max:255'],
            'objectOrder.phone' => ['required', 'numeric'],
            'objectOrder.region' => ['required', 'string'],
            'objectOrder.city' => ['required', 'string'],
            'objectOrder.address' => ['required', 'string'],
            'objectOrder.zip' => ['required', 'numeric'],
            'objectOrder.quantity' => ['required', 'regex:/^(\d+(,\d{1,2})?)?$/'],
            'objectOrder.message' => ['string', 'nullable'],
            'objectOrder.product_id' => ['required', 'exists:products,id'],
        ];

        $validationDataUser = [
            'objectUser.name' => ['required', 'string', 'max:255'],
            'objectUser.last_name' => ['required', 'string', 'max:255'],
            'objectUser.username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'objectUser.email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'objectUser.password' => ['required', 'string', 'min:8','confirmed'],
        ];

        if ($this->withRegistration) {
            return array_merge($validationDataOrder, $validationDataUser);
        } else {
            return $validationDataOrder;
        }
    }
}
