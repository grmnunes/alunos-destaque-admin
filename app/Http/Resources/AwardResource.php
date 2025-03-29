<?php

namespace App\Http\Resources;

use App\Models\School;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class AwardResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'date' => Carbon::parse($this->date)->format('d/m/Y'),
            'items' => collect($this->items)->map(function ($item) {
                return [
                    'school' => School::select('name', 'address', 'map_location')->find($item['school_id']),
                    'students' => StudentResource::collection(Student::with(['grade', 'shift'])->whereIn('id', $item['students'])->get()),
                ];
            }),
        ];
    }
}
