<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|max:500',
            'discount' => 'numeric|min:0',
            'ratingsQuantity' => 'required|numeric|min:1',
            'price' => 'required|max:500|min:1',
            'brand' => 'max:500',
            'imageCover' => 'required|max:500',
            'description' => 'required',
            'images.*' => 'max:500',
            'stockQuantity' => 'required|numeric', // Add this line for stockQuantity
        ];
    }
    public function messages()
    {
        return [
            'required' => 'هذا الحقل مطلوب.',
            'max' => 'هذا الحقل لا يجب أن يتجاوز :max حرف.',
            'numeric' => 'هذا الحقل يجب أن يكون قيمة رقمية.',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'عنوان المنتج',
            'discount' => 'نسبة الخصم',
            'ratingsQuantity' => 'عدد التقييمات',
            'currency' => 'العملة',
            'brand' => 'البراند',
            'imageCover' => 'صورة المنتج',
            'description' => 'وصف المنتج',
            'images' => 'رابط الصورة',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
