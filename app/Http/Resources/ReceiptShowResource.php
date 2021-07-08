<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReceiptShowResource extends JsonResource
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
            'date' => $this->date,
            'status' => $this->status,
            'electric' => $this->electric,
            'water' => $this->water,
            'rooms_id' => $this->rooms_id,
            ];
    }
}
