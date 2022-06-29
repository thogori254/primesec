<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Ticket extends JsonResource
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
            'uid' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->message,
            'seen' => $this->seen,
            'created' => date('d M, Y', strtotime($this->created_at))
        ];
    }
}
