<?php

namespace App\Http\Requests;

class StoreCharacterRequest extends ApiFormRequest
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
            'alias'         => 'required|string',
            'real_name'     => 'string',
            'sex'           => 'required|string',
            'thumb_url'     => 'string',
            'morality'      => 'required',
            'type_id'       => 'integer',
            'skills'        => 'required|array',
            'movies'        => 'array',
            'traits'        => 'array'
        ];
    }
}
