<?php

namespace App\Http\Requests\Admin\Bank;

use App\Rules\PaymentExist;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            "description_finish" => "nullable|string" ,
            "is_finish" => "required|numeric|in:0,1"
        ];
    }


    public function attributes()
    {
        return [
            "description_finish" => "دلیل اتمام" ,
            "is_finish" => "وضعیت اتمام",
        ];
    }
}
