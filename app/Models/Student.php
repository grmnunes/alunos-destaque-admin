<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasUlids;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'registration_number',
        'school_id',
        'shift_id',
        'grade_id'
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
}
