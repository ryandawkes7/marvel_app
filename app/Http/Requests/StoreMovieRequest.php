<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMovieRequest extends FormRequest
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
            'title'         => 'required|string',
            'director'      => 'string|nullable',
            'release_date'  => 'date|nullable',
            'in_mcu'        => 'boolean',
            'mcu_phase_id'  => 'integer|nullable'
        ];
    }
}
