<?php

namespace App\Http\Requests\Producer;

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
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'bail',
                'required',
                'string',
                Rule::unique(Producer::class)->ignore($this->producer), //lọc trùng và loại trừ thằng đang sửa
            ],
            'phone'   => [
                'bail',
                'required',
                'regex:/(0)[0-9]{9}/',
                'min:10',
                Rule::unique(Producer::class)->ignore($this->producer),
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
