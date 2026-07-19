<?php

namespace App\Http\Controllers\REST;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Manufacture;
use Illuminate\Http\Request;

class ManufactureController extends Controller
{
    public function index()
    {
        $manufactures = Manufacture::all();
        $countries = Country::all();
        return response()->json(compact('manufactures', 'countries'), 200);
    }


    public function store(Request $request)
    {
        $request->validate([]);
    }

    public function destroy(Manufacture $manufacture)
    {
        $manufacture->delete();
        return response()->json(['Deleted' => 'OK'], 200);
    }
}
