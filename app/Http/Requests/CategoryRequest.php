<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'cname' => 'required|max:500',
            'price' => 'required|numeric',
            'period' => 'required|numeric',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'network' => 'required|exists:networks,_id',
        ];
    }
    public function messages()
    {
        return [
            'cname.required' => 'اسم الفئة مطلوب.',
            'cname.max' => 'يجب أن يكون طول اسم الفئة أقل من 500 حرف.',
            'price.required' => 'حقل السعر مطلوب.',
            'price.numeric' => 'يجب أن يكون السعر رقمًا.',
            'period.required' => 'حقل فترة البطاقة مطلوب.',
            'period.numeric' => 'يجب أن تكون فترة البطاقة رقمًا.',
            'photo.image' => 'يجب أن تكون الصورة من نوع صورة.',
            'photo.mimes' => 'يجب أن تكون الصورة من نوع JPEG, PNG, JPG, GIF.',
            'photo.max' => 'يجب أن يكون حجم الصورة أقل من 2 ميجابايت.',
            'network.required' => 'حقل الشبكة مطلوب.',
            'network.exists' => 'الشبكة المحددة غير موجودة.',
        ];
    }


}
