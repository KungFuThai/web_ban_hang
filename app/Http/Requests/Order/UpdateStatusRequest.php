<?php

namespace App\Http\Requests\Order;

use App\Enums\OrderStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return isAdmin();
    }

    public function rules(): array
    {
        return [
            'status' => [
                'required',
                Rule::in(OrderStatusEnum::asArray()),
            ],
        ];
    }
}
