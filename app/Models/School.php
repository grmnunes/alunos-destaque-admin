<?php

namespace App\Models;

use App\Casts\EnumToArrayCast;
use App\Enums\SchoolGrade;
use App\Enums\SchoolSessions;
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
        'grades'
    ];

    protected $casts = [
        'sessions' => EnumToArrayCast::class . ':' . SchoolSessions::class,
        'grades' => EnumToArrayCast::class . ':' . SchoolGrade::class
    ];
}
