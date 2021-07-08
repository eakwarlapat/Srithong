<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Receipt;
use App\Http\Resources\ReceiptShowResource;

class ReceiptController extends Controller
{
    public function show($id)
    {
        return Receipt::findOrFail($id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'status' => 'required',
            'electric' => 'required',
            'water' => 'required',
            'rooms_id' => 'required',
    ]);

        $receipt = Receipt::create($request->all());

        return new ReceiptShowResource($receipt);
    }

    public function update(Request $request, $id): ReceiptShowResource
    {
        // update renter
        $receipt = Receipt::find($id);
        $receipt->date = $request->input('date');
        $receipt->status = $request->input('status');
        $receipt->electric = $request->input('electric');
        $receipt->water = $request->input('water');

        $receipt->save();

        return new ReceiptShowResource($receipt);
    }
}
