<?php

namespace App\Http\Requests;

class UpdateComicBookRequest extends ApiFormRequest
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
            'title'         => 'string',
            'description'   => 'string|nullable',
            'release_date'  => 'date|nullable',

            'writers'       => 'array|nullable',
            'writers.*.id'  => 'integer|nullable|required_with:writers',

            'comic_issues'                  => 'array',
            'comic_issues.*.title'          => 'string|nullable',
            'comic_issues.*.description'    => 'string|nullable',
            'comic_issues.*.issue_number'   => 'integer|required_with:comic_issues',
            'comic_issues.*.volume_number'  => 'integer|nullable',
            'comic_issues.*.release_date'   => 'date|nullable',
            
            'comic_issues.*.covers'                 => 'array',
            'comic_issues.*.covers.*.cover_url'     => 'url|required_with:comic_issues.covers',
            'comic_issues.*.covers.*.is_variant'    => 'bool|nullable',
            'comic_issues.*.covers.*.variant_issue' => 'integer|nullable',


            'comic_issues.*.characters'       => 'array',
            'comic_issues.*.characters.id'    => 'integer|required_with:comic_issues.characters',
        ];
    }
}
