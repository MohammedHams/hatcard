<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NetworkRequest extends FormRequest
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
            'name' => 'required|max:500',
            'owner' => 'required|max:500',
            'phone' => 'required|numeric|digits:10|phone_format',
            'city' => 'required',
            'area' => 'required',
            'url' => 'required|url',
            'facebook' => 'nullable|string|max:500',
            'instagram' => 'nullable|string|max:500',
            'webUrl' => 'nullable|url|max:500',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        if ($this->isMethod('post')) {
            $rules['cover'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'اسم الشبكة مطلوب.',
            'name.max' => 'يجب أن يكون طول اسم الشبكة أقل من 500 حرف.',
            'owner.required' => 'اسم المالك مطلوب.',
            'owner.max' => 'يجب أن يكون طول اسم المالك أقل من 500 حرف.',
            'phone.required' => 'رقم جوال المالك مطلوب.',
            'phone.numeric' => 'يجب أن يحتوي رقم جوال المالك على أرقام فقط.',
            'phone.digits' => 'يجب أن يحتوي رقم جوال المالك على 10 أرقام.',
            'phone.phone_format' => 'صيغة رقم جوال المالك غير صحيحة.',
            'city.required' => 'حقل المدينة مطلوب.',
            'area.required' => 'حقل المنطقة مطلوب.',
            'cover.required' => 'الصورة مطلوبة.',
            'cover.image' => 'يجب أن تكون الصورة من نوع صورة.',
            'cover.mimes' => 'يجب أن تكون الصورة من نوع JPEG, PNG, JPG, GIF.',
            'cover.max' => 'يجب أن يكون حجم الصورة أقل من 2 ميجابايت.',
            'url.required' => 'رابط الدخول للشبكة مطلوب.',
            'url.url' => 'رابط الدخول للشبكة غير صحيح.',
            'facebook.max' => 'يجب أن يكون طول اسم الحساب على فيسبوك أقل من 500 حرف.',
            'instagram.max' => 'يجب أن يكون طول اسم الحساب على انستغرام أقل من 500 حرف.',
            'webUrl.url' => 'رابط الموقع الإلكتروني غير صحيح.',
            'webUrl.max' => 'يجب أن يكون طول رابط الموقع الإلكتروني أقل من 500 حرف.',
        ];
    }

}
