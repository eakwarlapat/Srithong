<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Water;
use App\Http\Resources\WaterShowResource;

class WaterController extends Controller
{
    public function index() 
    {  
        return Water::first('watermeter');
    }

    public function update(Request $request, $id) 
    {  
        $water = Water::find($id);
        $water->watermeter = $request->input('watermeter');

        $water->save();
        
        return new WaterShowResource($water);
    }
}
