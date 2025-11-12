<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    public function index(){
        $addresses = Address::all();
        return response()->json(['message'=>null,'data'=>$addresses],200);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'country' => 'required|string|max:255',
            'zipcode' => 'required|numeric|min:5',
            'user_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        $user = User::find($request->get('user_id'));

        if ($user){
            $address = Address::create([
                'country' => $request->get('country'),
                'zipcode' => $request->get('zipcode'),
                'user_id' => $user->id,
            ]);
        } else {
            return response()->json(['message' => 'User not found', 'data' => null], 404);
        }

        if ($user->address){
            return response()->json(['message' => 'User already has an address', 'data' => null], 400);
        }

        /*
         * $addres = new Address($addressValidator->validate());
         * if ($user->address()->save($addres)){
         *      return response()->json(['message' => 'Address Created', 'data' => $addres], 200);
         *  }
         */
        return response()->json(['message' => 'Address Created', 'data' => $address], 200);
    }

    public function show(Address $address)
    {
        return response()->json(['message' => '', 'data' => $address], 200);

    }

    public function show_user(Address $address)
    {
        return response()->json(['message' => '', 'data' => $address->user], 200);
    }
}
