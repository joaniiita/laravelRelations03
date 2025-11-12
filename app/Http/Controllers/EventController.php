<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
        return response()->json(['message'=>null,'data'=>$events],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'event_name'=>'required|string|max:255',
            'event_detail'=>'required|string|max:255',
            'event_type_id'=>'required|numeric'
        ]);

        if ($validator->fails()){
            return response()->json($validator->messages(),400);
        }

        try {

            $eventType = EventType::find($request->get('event_type_id'));

            if (!$eventType){
                return response()->json(['message'=>'Event Type not found','data'=>null],404);
            }

            $event = Event::create([
                'event_name' => $request->get('event_name'),
                'event_detail' => $request->get('event_detail'),
                'event_type_id' => $eventType->id,
            ]);


        } catch (\Exception $e) {
            return response()->json(['message'=>'Error','data'=>$e->getMessage()],400);
        }
        return response()->json(['message'=>'Event Created','data'=>$event],200);

        /*
         * $validator = Validator::make($request->all(), [
         *  'event_name'=>'required|string|max:255',
         *  'event_detail'=>'required|string|max:255',
         *  'event_type_id'=>'required|numeric|exists:event_types,id'
         * ]);
         *
         * if ($validator->fails()){
         *      return response()->json($validator->messages(),400);
         * }
         *
         * $event = Event::create($validator->validate());
         * return response()->json(['message'=>'Event Created','data'=>$event],200);
       */
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $event = Event::find($id);
        //$event = Event::findOrFail($id);

        if (!$event){
            return response()->json(['message'=>'Event not found','data'=>null],404);
        }

        return response()->json(['message'=>null,'data'=>$event],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function listUsers(Event $event){
        $users = $event->users;
        return response()->json(['message'=>null,'data'=>$users],200);
    }
}
