<?php

namespace App\Http\Requests;

class StoreTvShowRequest extends ApiFormRequest
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
            'episode_count' => 'required|integer',
            'season_count'  => 'required|integer',
            'logo_url'      => 'required|url',
            'description'   => 'string|nullable',
            'in_mcu'        => 'required|bool',
            'mcu_phase_id'  => 'integer|nullable',
            'release_date'  => 'required|date'
        ];
    }
}
