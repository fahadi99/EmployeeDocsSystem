<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDocumentPriorityRequest extends FormRequest
{
    public function authorize()
    {
        return true; // You can set authorization logic here if needed
    }

    public function rules()
    {
        return [
            'document_priority_name' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'document_priority_name.required' => 'Please provide a document priority name',
        ];
    }
}
