<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class ItemsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        
            return [
                'id' => $this->id,
                'type' => $this->type,
                'title' => $this->title,
                'category' => $this->category,
                'description' => $this->description,
                'year' => $this->year,
                'unit' => $this->unit,
                'url' => $this->url,
                'price' => $this->price,
                'thumbnailimage' => $this->thumbnailimage ? URL::to($this->thumbnailimage) : null,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ];
        
    }
}
