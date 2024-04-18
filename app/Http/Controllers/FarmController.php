<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use App\Models\Plant;

class FarmController extends Controller {

    public function allPlants() {
        return Plant::all();
    }

    public function findBySlug(string $slug) {
        return Plant::where('slug', '=', $slug)
            ->first();
    }

    public function allFarms() {
        return Farm::with('plant')
            ->get();
    }

}
