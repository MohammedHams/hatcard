<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Change to 'true' to allow any user to make this request. (You can add more complex authorization logic here if needed)
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */

    public function rules()
    {
        return [
            'csv' => 'required|file|mimes:csv|max:2048', // Adjust the maximum file size as needed
            // Add other validation rules for your form fields
        ];
    }

    public function messages()
    {
        return [
            'csv.required' => 'حقل الملف مطلوب.',
            'csv.mimes' => 'يجب أن يكون الملف من نوع CSV .',
            'csv.max' => 'حجم الملف لا يجب أن يتجاوز :max كيلوبايت.',
        ];
    }
}
