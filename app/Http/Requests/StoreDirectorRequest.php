<?php

namespace App\Http\Requests;

class StoreDirectorRequest extends ApiFormRequest
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
            'name'  => 'required|string',
            'dob'   => 'required|date',
            'image' => ['regex:/(?:(?:https?)+\:\/\/+[a-zA-Z0-9%\/\._-]{1,})+(?:(?:jpe?g|png|gif))/i']
        ];
    }
}
