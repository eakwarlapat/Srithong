<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Http\Resources\CustomerShowResource;

class CustomerController extends Controller
{
    public function index() 
    {
        return CustomerShowResource::collection(Customer::paginate(10));
    }

    public function store(Request $request ) 
    {
        $request->validate([
                'cus_name' => 'required',
                'cus_surname' => 'required',
                'cus_tel' => 'required',
                'cus_email' => 'required',
                'cus_add' => 'required',
                'personalid' => 'required',
                'rent_status' => 'required',
                'rooms_id' => 'required',
        ]);
        //create renter

        $renter = Customer::create($request->all());

        return new CustomerShowResource($renter);
    }

    public function update(Request $request, $id): CustomerShowResource
    {
        // update renter
        $renter = Customer::find($id);
        $renter->cus_name = $request->input('cus_name');
        $renter->cus_surname = $request->input('cus_surname');
        $renter->cus_tel = $request->input('cus_tel');
        $renter->cus_email = $request->input('cus_email');
        $renter->cus_add = $request->input('cus_add');
        $renter->personalid = $request->input('personalid');
        $renter->rent_status = $request->input('rent_status');
        $renter->rooms_id = $request->input('rooms_id');

        $renter->save();

        return new CustomerShowResource($renter);
    }

    public function delete(Request $request, $id)
    {
        $renter = Customer::find($id);
        $renter->delete();

        return response()->json($renter);
    }
}
