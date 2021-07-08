<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Electric;
use App\Http\Resources\ElectricShowResource;

class ElectricController extends Controller
{
    public function index() 
    {  
        return Electric::first('electricmeter');
    }

    public function update(Request $request, $id) 
    {  
        $electric = Electric::find($id);
        $electric->electricmeter = $request->input('electricmeter');

        $electric->save();
        
        return new ElectricShowResource($electric);
    }
}
