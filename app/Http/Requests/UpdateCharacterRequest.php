<?php

namespace App\Http\Requests;

class UpdateCharacterRequest extends ApiFormRequest
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
            'alias'         => 'string',
            'real_name'     => 'string',
            'sex'           => 'string',
            'thumb_url'     => 'string',
            'morality'      => 'string',
            'type_id'       => 'integer',
            'skills'        => 'array',
            'movies'        => 'array',
            'traits'        => 'array'
        ];
    }
}
