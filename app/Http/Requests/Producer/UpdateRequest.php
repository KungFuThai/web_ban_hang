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
    public function attributes(): array
    {
        return [
            'name'    => 'tên nhà cung cấp',
            'phone'   => 'số điện thoại nhà cung cấp',
            'address' => 'địa chỉ nhà cung cấp',
        ];
    }
}
