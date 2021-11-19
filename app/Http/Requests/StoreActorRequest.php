<?php

namespace App\Http\Requests;

class StoreActorRequest extends ApiFormRequest
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
            'name'      => 'required|string',
            'dob'       => 'required|date',
            'image_url' => 'required|url'
        ];
    }
}
