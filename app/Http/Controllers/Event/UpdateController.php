<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function __invoke(Event $event, Request $request)
    {
        if ($request->string('stop_at')->toString() === 'NOW') {
            $event->end_at = now();
        }

        if (($start_at_time=$request->string('start_at_time'))->isNotEmpty()) {
            $event->start_at = $event->start_at->setTimeFromTimeString($start_at_time);
        }

        if (($end_at_time=$request->string('end_at_time'))->isNotEmpty()) {
            $event->end_at = $event->end_at->setTimeFromTimeString($end_at_time);
        }

        if ($name = $request->string('name')->toString()) {
            $event->name = $name;
        }

        $event->save();

        return response()->redirectToRoute('calendar.index');
    }
}
