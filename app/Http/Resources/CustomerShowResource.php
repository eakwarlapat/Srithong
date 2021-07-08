<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerShowResource extends JsonResource
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
        'cus_name' => $this->cus_name,
        'cus_surname' => $this->cus_surname,
        'cus_tel' => $this->cus_tel,
        'cus_email' => $this->cus_email,
        'cus_add' => $this->cus_add,
        'personalid' => $this->personalid,
        'rent_status' => $this->rent_status,
        'room' => $this->rooms
        ];
    }
}
