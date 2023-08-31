<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class handel_id_number extends JsonResource
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
            "identification"=>$this['id']?? null,
            "name_person"=> $this['name']?? null,
            "name_father"=>$this['father'] ?? null,
            "name_grand_father"=>$this['gfather'] ?? null,
            "name_family"=> $this['family'] ?? null,
            "location"=>$this['hae'] ?? null,
            "age"=>$this['numage'] ?? null,
            "birth"=>date('d-m-Y', strtotime($this['birth']) ) ?? null,
        ];
    }
}
