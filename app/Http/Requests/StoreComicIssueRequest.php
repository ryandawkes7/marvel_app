<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreComicIssueRequest extends FormRequest
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
            'comic_book_id' => 'required|integer',
            'title'         => 'string|nullable',
            'description'   => 'string|nullable',
            'issue_number'  => 'required|integer',
            'volume_number' => 'integer|nullable',
            'release_date'  => 'required|date',
            'comic_covers.cover_url' => 'url',
            'comic_covers.is_variant' => 'required_with:comic_covers.cover_url|boolean',
            'comic_covers.variant_issue' => 'required_with:comic_covers.is_variant'
        ];
    }
}
