<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Models\Bill;
use App\Http\Resources\BillResource;

class BillController extends Controller
{
    public function index() 
    {  
        // return BookableIndexResource::collection(Bookable::paginate(9));
        return Bill::all();
    }

    public function show($id)
    {
        return new BillResource(Bill::findOrFail($id));
    }

    public function store(Request $request)
    {
        $request->validate([
            'month' => 'required',
            'status' => 'required',
            'internet' => 'required',
            'water' => 'required',
            'electric' => 'required',
            'rooms_id' => 'required',
            'room_price' => 'required'
    ]);

        $receipt = Bill::create($request->all());

        return $receipt;
    }

    public function update(Request $request, $id)
    {
        // update renter
        $bill = Bill::find($id);
        $bill->month = $request->input('month');
        $bill->status = $request->input('status');
        $bill->internet = $request->input('internet');
        $bill->electric = $request->input('electric');
        $bill->water = $request->input('water');
        $bill->room_price = $request->input('room_price');

        $bill->save();

        return ($bill);
    }
}
