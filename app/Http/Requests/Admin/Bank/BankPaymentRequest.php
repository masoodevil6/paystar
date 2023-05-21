<?php

namespace App\Http\Requests\Admin\Bank;

use App\Rules\PaymentExist;
use Illuminate\Foundation\Http\FormRequest;

class BankPaymentRequest extends FormRequest
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
            "is_status" => "required|numeric|in:0,1" ,
            "text_admin" => "nullable|string" ,
        ];
    }


    public function attributes()
    {
        return [
            "is_status" => "وضعیت تراکنش" ,
            "text_admin" => "متن ادمین"
        ];
    }
}
