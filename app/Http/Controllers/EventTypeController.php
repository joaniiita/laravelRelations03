<?php

namespace App\Http\Controllers;

use App\Models\EventType;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventTypeController extends Controller
{

    public function index(){
        $types = EventType::all();
        return response()->json(['message'=>null,'data'=>$types],200);
    }

    public function show(EventType $type){
        return response()->json(['message'=>null,'data'=>$type],200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        try {
            $eventType = EventType::create([
                'description' => $request->description
            ]);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Error', 'data' => $e->getMessage()], 400);
        }
        return response()->json(['message' => 'Event Type Created', 'data' => $eventType], 200);



    }
    public function listEvents(EventType $type){
        $events = $type->events;
        return response()->json(['message' => null, 'data' => $events], 200);
    }


}
