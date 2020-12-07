<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Response;
class CalendarController extends Controller
{
    public function getevent() {
        $eventdetails = Event::orderby('id', 'desc')->first();

        return Response::json(array(
            'details' => $eventdetails,
            'dow' => explode(",", $eventdetails['dow'])
        ),200);
    }
    public function addevent(Request $request) {
        $event = new Event([
            'title' => $request->get('title'),
            'start' => $request->get('start'),
            'end' => $request->get('end'),
            'dow' => implode(",", $request->get('dow'))
        ]);

        $event->save();
        return Response::json(array(
            'message' => "Event successfully saved",
            'data' => $event
        ),200);
    }
}
