<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectValidation extends FormRequest
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
            'title' => [Rule::requiredIf($this->title), 'max:255', 'min:3', 'string'],
            'description' => [Rule::requiredIf($this->description), 'max:1000', 'min:10', 'string'],
            'notes' => ['nullable', 'max:5000', 'string']
        ];
    }
}
