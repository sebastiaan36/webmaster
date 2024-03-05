<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePagespeedRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'mobile_score' => ['required', 'string'],
            'mobile_speed' =>  ['required', 'string'],
            'desktop_score' => ['required', 'string'],
            'desktop_speed' => ['required', 'string'],
            'domain' => ['required', 'string'],
        ];
    }
}
