<?php

namespace App\Http\Controllers\REST;

use App\Http\Controllers\Controller;
use App\Models\Manufacture;
use Illuminate\Http\Request;

class ManufactureController extends Controller
{
    public function index()
    {
        $manufactures = Manufacture::all();
        return response()->json(compact('manufactures'), 200);
    }


    public function store(Request $request)
    {
        $request->validate([]);
    }
}
