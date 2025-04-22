<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AwardResource;
use App\Models\Award;

class AwardController extends Controller
{
    public function index()
    {
        $awards = Award::orderBy('date', 'ASC')->get();

        return AwardResource::collection($awards);
    }
}
