<?php

namespace App\Modules\Project\Interface\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the project model into an array for API response.
     *
     * @param \Illuminate\Http\Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'image' => $this->image,
            'description' => $this->description,
            'url' => $this->url,
            'github_url' => $this->github_url,
            'status' => $this->status,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'completed_at' => $this->completed_at,
            'is_featured' => (bool) $this->is_featured,
            'order' => (int) $this->order,
            'technologies' => $this->technologies
                ? explode(',', $this->technologies) // convert text to array
                : [],

            // Audit fields
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'deleted_by' => $this->deleted_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
