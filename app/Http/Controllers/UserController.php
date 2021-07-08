<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
    ]);

        $receipt = Receipt::create($request->all());

        return new ReceiptShowResource($receipt);
    }
}
