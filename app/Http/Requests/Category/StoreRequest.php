<?php

namespace App\Http\Requests\Category;

use App\Models\Producer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return isAdmin();
    }

    public function rules(): array
    {
        return [
            'name'        => [
                'bail',
                'required',
                'string',
                'unique:App\Models\Category,name',
            ],
            'producer_id' => [
                'required',
                Rule::exists(Producer::class, 'id'),
            ],
        ];
    }

//    public function messages(): array
//    {
//        return [
//            'required'   => ':attribute bắt buộc phải điền!',
//            'unique'     => ':attribute trùng với loại nào khác rồi',
//            'producer_id.exists' => ':attribute không tồn tại',
//        ];
//    }

    public function attributes(): array
    {
        return [
            'name'        => '"tên loại"',
            'producer_id' => '"mã nhà cung cấp"',

        ];
    }
}
