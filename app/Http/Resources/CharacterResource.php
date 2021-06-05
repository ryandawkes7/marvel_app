<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CharacterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'alias' => $this->alias,
            'real_name' => $this->real_name,
            'sex' => $this->sex,
            'character_thumb_url' => $this->character_thumb_url,
            'morality' => $this->morality,
            'type_id' => $this->type_id,
            'created_at' => $this->created_at ? $this->created_at : null
        ];
    }
}
