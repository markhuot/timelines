<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Models\Event;

class StoreController extends Controller
{
    public function __invoke()
    {
        $event = new Event;
        $event->start_at = now();
        $event->name = 'Untitled';
        $event->save();

        return response()->redirectToRoute('calendar.index');
    }
}
