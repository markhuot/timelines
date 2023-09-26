@php
$now = now('America/New_York')->toImmutable();
$start = $now->toImmutable()->subDays(2);
$end = $now->toImmutable()->addDays(2);
$events = \App\Models\Event::all();
//$events = collect([
//    (object)[
//        'start' => now()->toImmutable()->subMinutes(37),
//        'end' => now()->toImmutable(),
//        'period' => now()->toImmutable()->subMinutes(37)->toPeriod(now()->toImmutable()),
//        'title' => 'active event',
//        'active' => true,
//        'color' => 'red-500',
//    ],
//    (object)[
//        'start' => now()->toImmutable()->setTime(14, 0, 0),
//        'end' => now()->toImmutable()->setTime(15, 0, 0),
//        'period' => now()->toImmutable()->setTime(14, 0, 0)->toPeriod(now()->toImmutable()->setTime(15, 0, 0)),
//        'title' => 'PLAYR-302',
//        'color' => 'yellow-400',
//    ],
//    (object)[
//        'start' => now()->toImmutable()->setTime(10, 0, 0),
//        'end' => now()->toImmutable()->setTime(12, 0, 0),
//        'period' => now()->toImmutable()->setTime(10, 0, 0)->toPeriod(now()->toImmutable()->setTime(12, 0, 0)),
//        'title' => 'morning event',
//    ],
//    (object)[
//        'start' => now()->toImmutable()->setTime(10, 0, 0),
//        'end' => now()->toImmutable()->setTime(12, 0, 0),
//        'period' => now()->toImmutable()->setTime(10, 0, 0)->toPeriod(now()->toImmutable()->setTime(12, 0, 0)),
//        'title' => 'second morning event',
//    ]
//]);
$isLeft = true;
@endphp
<x-app>
    @foreach($start->toPeriod($end) as $day)
        <div class="relative">
            <p class="sticky top-[1rem] text-center z-30">
                <span class="inline-block rounded-lg text-slate-800 dark:text-slate-300 bg-white dark:bg-slate-700 shadow-lg backdrop-blur-sm border-b-2 border-slate-200 dark:border-slate-900 px-6 py-2 font-bold text-center">
                    {{$day->format('M j')}}
                </span>
            </p>
            <div class="relative p-4">
                @if ($day->isFuture())
                    <div class="absolute top-0 left-1/2 w-[1px] dark:w-[0.5px] bg-gradient-dash to-slate-300 dark:to-slate-700 to-40% dash-lg bg-[length:2px_30px] h-full"></div>
                @else
                    <div class="absolute top-0 left-1/2 border-l border-slate-200 dark:border-slate-700 h-full"></div>
                @endif
                <ul class="flex flex-col space-y-4">
                    @php
                        $todaysEvents = $events->filter(fn ($event) => $day->startOfDay()->toPeriod($day->endOfDay())->contains($event->period))
                    @endphp
                    @foreach ($todaysEvents as $event)
                        @php
                            $heightOfOneHour = 10;
                            $secondsInEvent = $event->period->end->timestamp - $event->period->start->timestamp;
                            $hoursInEvent = $secondsInEvent / 60 / 60;
                            $height = $hoursInEvent * $heightOfOneHour;
                        @endphp
                        <li>
                            <div class="relative w-[calc(50%-1rem)] {{ !$isLeft ? 'text-right' : 'left-[calc(50%+1rem)]' }} h-[--height] min-h-[4rem] flex flex-col justify-between" style="--height: {{$height}}vh">
                                <div class="relative text-sm flex-grow">
                                    <div class="sticky top-[4rem]">
                                        <input type="text"
                                               class="{{!$isLeft ? 'text-right' : ''}} text-{{ $event->color ?? '' }} focus:outline-none bg-transparent text-inherit"
                                               value="{{$event->name}}"
                                               x-on:change='fetch("{{route('events.update', $event)}}", {"method": "post", "headers": {"Content-Type":"application/json"}, "body": JSON.stringify({"_token": "{{csrf_token()}}", "name": $event.target.value})})'
                                        >
                                        <p class="text-slate-400">
                                            <input type="time"
                                                   class="bg-transparent"
                                                   value="{{$event->start_at->format('H:i')}}"
                                                   x-on:change='fetch("{{route('events.update', $event)}}", {"method": "post", "headers": {"Content-Type":"application/json"}, "body": JSON.stringify({"_token": "{{csrf_token()}}", "start_at_time": $event.target.value})})'
                                            >@if(!$event->active)&mdash;<input type="time"
                                                   class="bg-transparent"
                                                   value="{{$event->end_at?->format('H:i')}}"
                                                   x-on:change='fetch("{{route('events.update', $event)}}", {"method": "post", "headers": {"Content-Type":"application/json"}, "body": JSON.stringify({"_token": "{{csrf_token()}}", "end_at_time": $event.target.value})})'
                                            >@endif
                                            @if (!$event->active)
                                                <span class="text-slate-300 dark:text-slate-600">•</span> <span>{{$event->durationForHumans()}}</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="rounded-full bg-{{$event->color ?? 'slate-200'}} dark:bg-{{$event->color ?? 'slate-700'}} w-[7px] h-full absolute top-0 {{ !$isLeft ? '-right-[calc(1rem+4px)]' : '-left-[calc(1rem+3px)]' }}"></div>
                                @if ($event->active)
                                    <form action="{{route('events.update', $event)}}" method="post">
                                        {{csrf_field()}}
                                        <input type="hidden" name="stop_at" value="NOW">
                                        <button class="inline-block text-sm text-red-500 bg-red-100 rounded-full py-1 pl-2 pr-4 space-x-2">
                                            <span class="text-xs border-2 border-red-500 rounded-full w-[1rem] h-[1rem] inline-flex items-center justify-center relative top-[-1px]">⏹</span>
                                            <span class="tabular-nums" x-init='setInterval(() => $el.innerHTML = timeago(new Date("{{$event->start_at->toIso8601String()}}")), 1000)'>
                                                {{ $event->durationForHumans() }}
                                            </span>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </li>
                        @php
                            $isLeft = !$isLeft;
                        @endphp
                    @endforeach
                    @if ($todaysEvents->count() === 0)
                        <li class="relative z-10 text-center py-48 text-slate-400 dark:text-slate-600 font-serif italic">
                            <span class="text-sm inline-block bg-[--bg] p-1 z-10">
                                {{ collect([
                                    'A quiet day',
                                    'Nothing to see here',
                                    'Silence is golden',
                                    'The calm before the storm',
                                ])->random() }}
                            </span>
                        </li>
                    @endif
                    @if ($day->isToday())
                        <li class="w-full text-center relative">
                            <form action="{{ route('events.store') }}" method="post">
                                {{ csrf_field() }}
                                <div class="absolute top-1/2 left-0 border-b-2 border-red-500 w-[calc(50%_-_0.75rem)]"></div>
                                <button class="text-red-500 text-2xl bg-[--bg] px-2 z-10 relative inline-block">⊕</button>
                                <div class="absolute top-1/2 left-[calc(50%_+_0.75rem)] right-0 border-b-2 border-red-500"></div>
                            </form>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    @endforeach
    <x-toolbar/>
</x-app>
