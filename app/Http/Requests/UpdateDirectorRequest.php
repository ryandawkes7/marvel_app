<?php

namespace App\Http\Requests;

class UpdateDirectorRequest extends ApiFormRequest
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
            'name'  => 'string',
            'dob'   => 'date',
            'image' => ['regex:/(?:(?:https?)+\:\/\/+[a-zA-Z0-9%\/\._-]{1,})+(?:(?:jpe?g|png|gif))/i']
        ];
    }
}
