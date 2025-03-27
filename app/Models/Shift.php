<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shift extends Model
{
    use HasUlids;
    use SoftDeletes;
    
    protected $fillable = [
        'name'
    ];

    public function schools()
    {
        return $this->belongsToMany(School::class);
    }
}
