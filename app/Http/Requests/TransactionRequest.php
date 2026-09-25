<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class TransactionRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['required', 'string', 'min:3', 'max:150'],
            'amount'      => ['required', 'numeric', 'min:0.01'],
            'type'        => ['required', 'in:income,expense'],
            'date'        => ['required','date','date_format:YYYY-MM-DD'],
        ];
    }

    #[Override]
    public function messages(): array
    {
        return [
            'category_id.required' => 'O campo categoria é obrigatório.',
            'description.required' => 'O campo descrição é obrigatório.',
            'amount.required'      => 'O campo valor é obrigatório.',
            'type.required'        => 'O campo tipo é obrigatório',
            'date.required'        => 'O campo data é obrigatório.',
        ];
    }
}
