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
        $rules = [
            'cname' => 'required|max:500',
            'price' => 'required|numeric|min:1',
            'period' => 'required|numeric|min:1',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'network' => 'required|exists:networks,_id',
            'periodType' => 'required|in:H,D,W,M',
        ];
        if ($this->isMethod('post'))
            $rules['photo'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';

        return $rules;
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
            'periodType.required' => 'حقل نوع البطاقة مطلوب.',
            'periodType.in' => 'يجب أن يكون نوع البطاقة من بين القيم المسموح بها: بالساعة، يومي، أسبوعي، شهري.',
        ];
    }


}
