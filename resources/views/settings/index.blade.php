<x-app>
    <div class="p-12 space-y-12 max-w-[1200px] mx-auto">
        <div>
            <p><a href="{{route('calendar.index')}}" class="text-sm text-slate-400">← back</a></p>
            <h1 class="text-4xl font-black">Settings</h1>
        </div>
        <div class="space-y-2">
            <div>
                <h2 class="text-2xl">Calendars</h2>
                <p class="text-slate-400">Authorize calendar services to display calendar events on your timeline.</p>
            </div>
            <p><a href="#">Google Calendar</a></p>
        </div>
        <hr>
        <form action="{{route('sessions.destroy')}}" method="post">
            {{csrf_field()}}
            <p><button class="text-red-500" href="#">Logout</button></p>
        </form>
    </div>
    <x-toolbar/>
</x-app>
