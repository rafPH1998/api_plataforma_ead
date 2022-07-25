<?php

namespace App\Http\Requests;

use App\Models\Support;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule as ValidationRule;

class StoreSupport extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(Support $suport)
    {
        return [
            'lesson' => ['required', 'exists:lessons,id'],
            'status' => [
                'required',
                ValidationRule::in(array_keys($suport->statusOptions))
            ],
            'description' => ['required', 'min:3', 'max:1000']
        ];
    }
}
