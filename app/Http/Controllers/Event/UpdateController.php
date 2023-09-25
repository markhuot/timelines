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

        if ($name = $request->string('name')->toString()) {
            $event->name = $name;
        }

        $event->save();

        return response()->redirectToRoute('calendar.index');
    }
}
