<?php

namespace App\Http\Requests\Dashboard\MyOrder;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Order;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\Rule;

class UpdateMyOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'buyer_id' => [
                'required', 'integer',
            ],
            'freelancer_id' => [
                'required', 'string',
            ],
            'service_id' => [
                'nullable', 'integer',
            ],
            'file' => [
                'required', 'mimes:zip', 'max:1024',
            ],
            'note' => [
                'nullable', 'date',
            ],
            'order_status_id' => [
                'nullable', 'integer',
            ],
        ];
    }
}
