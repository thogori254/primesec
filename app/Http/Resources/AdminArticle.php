<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminArticle extends JsonResource
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
            'header' => $this->headerUrl(),
            'title' => $this->title,
            'content' => $this->body,
            'claps' => $this->claps(),
            'views' => $this->views,
            'categoryId' => $this->master_category_id,
            'published' => $this->published,
            'by' => $this->user->name,
            'created' => date('d M, Y', strtotime($this->created_at))
        ];
    }
}
