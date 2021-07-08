<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rooms;
use App\Http\Resources\RoomShowResource;

class RoomController extends Controller
{
    public function index() 
    {  
        // return BookableIndexResource::collection(Bookable::paginate(9));
        return RoomShowResource::collection(Rooms::paginate(8));
    }

    public function showall() 
    {  
        // return BookableIndexResource::collection(Bookable::paginate(9));
        return RoomShowResource::collection(Rooms::all());
    }

    public function show($id)
    {
        return new RoomShowResource(Rooms::findOrFail($id));
    }

    public function update(Request $request, $id): RoomShowResource
    {
        // update renter
        $room = Rooms::find($id);
        $room->room_status = $request->input('room_status');
        $room->room_type = $request->input('room_type');
        $room->price = $request->input('price');
        $room->internet = $request->input('internet');

        $room->save();

        return new RoomShowResource($room);
    }
}
