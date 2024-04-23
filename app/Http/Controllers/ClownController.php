<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClownRequest;
use App\Http\Resources\ClownResource;
use App\Models\Clown;
use Illuminate\Http\Request;

class ClownController extends Controller {

    public function all() {
        return ClownResource::collection(Clown::all());
    }

    public function create(StoreClownRequest $request) {
        $clown = Clown::create($request->validated());
        $clown->save();

        return ClownResource::make($clown);
    }

    public function update(Request $request, Clown $clown) {
        $clown->fill($request->all());
        $clown->save();

        return ClownResource::make($clown);
    }

    public function delete(Clown $clown) {
        $clown?->delete();

        return response()->noContent();
    }

}
