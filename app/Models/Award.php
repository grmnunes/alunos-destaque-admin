<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Award extends Model
{
    use HasUlids;
    use SoftDeletes;

    protected $fillable = [
        'date',
        'title',
        'description',
        'items'
    ];

    protected $casts = [
        'items' => 'array'
    ];
}
