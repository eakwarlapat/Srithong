<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoomShowResource extends JsonResource
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
            'room_number' => $this->room_number,
            'room_status' => $this->room_status,
            'room_type' => $this->room_type,
            'price' => $this->price,
            'internet' => $this->internet,
            'customer' => $this->customer,
            'bill' => $this->bill
        ];
    }
}
