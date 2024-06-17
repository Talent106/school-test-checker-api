<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SchoolController extends Controller
{
    public function index(): ResourceCollection
    {
        return new ResourceCollection(School::all());
    }
}
