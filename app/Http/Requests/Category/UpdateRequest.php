<?php

namespace App\Http\Requests\Category;

use App\Models\Category;
use App\Models\Producer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() : bool
    {
        return true;
    }

    public function rules() : array
    {
        return [
            'name' => [
                'bail',
                'required',
                'string',
                Rule::unique(Category::class)->ignore($this->category), //lọc trùng và loại trừ thằng đang sửa
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
