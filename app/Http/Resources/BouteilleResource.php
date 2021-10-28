<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BouteilleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "nom" => $this->nom,
            "description" => $this->description,
            "url_image" => $this->url_image,
            "url_achat" => $this->url_achat,
            "url_infos" => $this->url_infos,
            "conservation" => $this->conservation,
            "notes" => $this->notes,
            "format" => $this->format,
            "pays" => $this->pays->nom,
            "categories" => $this->categorie->nom,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}