<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image ? asset("storage/{$this->image}") : null,
            'grade' => [
                'name' => $this->grade->name,
            ],
            'shift' => [
                'name' => $this->shift->name,
            ],
        ];
    }
}
