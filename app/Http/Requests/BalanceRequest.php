<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BalanceRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'receiver' => 'required',
            'balance' => 'required|numeric|min:1',
            'receiver_confirm'=>'required',

        ];
    }

    public function authorize(): bool
    {
        return true;
    }
    public function messages()
    {
        return [
            'receiver.required' => 'حقل رقم جوال المستقبل مطلوب.',
            'balance.required' => 'حقل المبلغ مطلوب.',
            'balance.numeric' => 'حقل المبلغ يجب أن يكون رقمًا.',
            'balance.min' => 'حقل المبلغ يجب أن يكون على الأقل :min.',
            'receiver_confirm.required' => 'حقل تأكيد رقم الجوال مطلوب.',
            'receiver_confirm.same' => 'حقل تأكيد رقم الجوال يجب أن يتطابق مع رقم الجوال.',
        ];
    }
}
