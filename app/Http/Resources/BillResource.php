<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BillResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return  [
            'id' => $this->id,
            'month' => $this->month,
            'status' => $this->status,
            'internet' => $this->internet,
            'electric' => $this->electric,
            'water' => $this->water,
            'rooms' => $this->rooms
        ];
    }
}
