<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class School extends Model
{
    use HasUlids;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'address',
        'map_location',
        'contact',
        'sessions',
        'grades',
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function shifts()
    {
        return $this->belongsToMany(Shift::class);
    }

    public function grades()
    {
        return $this->belongsToMany(Grade::class);
    }
}
