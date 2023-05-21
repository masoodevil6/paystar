<?php

namespace App\Http\Requests\Admin\Bank;

use App\Rules\PaymentExist;
use Illuminate\Foundation\Http\FormRequest;

class TestPaymentRequest extends FormRequest
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
            "amount" => "required|integer" ,
            "class_name" => ["required" , new PaymentExist()] ,
        ];
    }


    public function attributes()
    {
        return [
            "amount" => "مبلغ تست تراکنش" ,
            "class_name" => "کلاس تست تراکنش" ,
        ];
    }
}
