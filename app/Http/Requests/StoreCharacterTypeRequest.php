<?php

namespace App\Http\Requests;

use App\Models\CharacterType;
use App\Rules\Lowercase;
use Illuminate\Validation\Rule;

class StoreCharacterTypeRequest extends ApiFormRequest
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
            'key'   => ['required', 'string', new Lowercase, Rule::unique('character_types', 'key')->ignore($this->key)],
            'type'  => 'required|string'
        ];
    }
}
