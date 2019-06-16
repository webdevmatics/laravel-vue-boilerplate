<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
    
        $newData= [
            'published_at'=> !empty($this->published_at)? Carbon::parse($this->published_at)->diffForHumans(): null
        ];

        return array_merge( parent::toArray($request), $newData);
    }
}
