<?php

namespace App\Modules\Education\Interface\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EducationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'school_name' => $this->school_name,
            'major'       => $this->major,
            'degree'      => $this->degree,
            'description' => $this->description,
            'start_date'  => $this->start_date?->format('Y-m-d H:i:s'),
            'end_date'    => $this->end_date?->format('Y-m-d H:i:s'),
            'is_current'  => $this->is_current,
            'order'       => $this->order,
            'created_by'  => $this->created_by,
            'updated_by'  => $this->updated_by,
            'deleted_by'  => $this->deleted_by,
            'created_at'  => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at'  => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
