<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Article extends JsonResource
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
            'uid' => $this->slug,
            'header' => $this->headerUrl(),
            'title' => $this->title,
            'content' => $this->body,
            'claps' => $this->claps(),
            'views' => $this->views,
            'by' => $this->user->name,
            'created' => date('d M, Y', strtotime($this->created_at))
        ];
    }
}
