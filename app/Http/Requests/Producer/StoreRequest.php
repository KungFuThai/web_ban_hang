<?php

namespace App\Http\Requests\Producer;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'    => [
                'bail',
                'required',
                'string',
                'unique:App\Models\Producer,name',
            ],
            'phone'   => [
                'bail',
                'required',
                'regex:/(0)[0-9]{9}/',
                'min:10',
                'unique:App\Models\Producer,phone',
            ],
            'address' => [
                'bail',
                'required',
                'string',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute bắt buộc phải điền!',
            'unique'   => ':attribute trùng với ai nhà cung cấp nào khác rồi',
            'regex'    => ':attribute số điện thoại gồm 10 chữ số bắt đầu bằng chữ số 0',
            'min'      => ':attribute số điện thoại có tối thiểu 10 số bắt đầu bằng số 0',
        ];
    }

    public function attributes(): array
    {
        return [
            'name'    => 'Tên nhà cung cấp',
            'phone'   => 'Số điện thoại nhà cung cấp',
            'address' => 'Địa chỉ nhà cung cấp',
        ];
    }
}
