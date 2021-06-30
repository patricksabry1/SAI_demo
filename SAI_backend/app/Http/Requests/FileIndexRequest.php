<?php

namespace App\Http\Requests;

class FileIndexRequest extends ApiRequest
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
            'file_type'    => 'required|string',
            'file_size'    => 'nullable|float',
            'file_name'    => 'nullable|string',
        ];
    }
}
