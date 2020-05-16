<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                return [];
            case 'POST':
                return [
                    'title' => ['required', 'max:255', 'min:3', 'string'],
                    'description' => ['required', 'max:1000', 'min:10', 'string']
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'notes' => ['nullable', 'max:5000', 'string']
                ];
            default:
                break;
        }
    }
}
