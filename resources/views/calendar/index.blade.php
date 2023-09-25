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
                <span class="inline-block rounded-lg text-slate-800 bg-white shadow-lg backdrop-blur-sm border-b-2 border-slate-200 px-6 py-2 font-bold text-center">
                    {{$day->format('M j')}}
                </span>
            </p>
            <div class="relative p-4">
                <div class="absolute top-0 left-1/2 border-l border-l-slate-200 h-full"></div>
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
                            <div class="relative w-[calc(50%-1rem)] {{ !$isLeft ? 'text-right' : 'left-[calc(50%+1rem)]' }}  h-[--height] min-h-[4rem]" style="--height: {{$height}}vh">
                                <div class="sticky top-[5rem] text-sm">
                                    <input type="text"
                                           class="{{!$isLeft ? 'text-right' : ''}} text-{{ $event->color ?? '' }} focus:outline-none"
                                           value="{{$event->name}}"
                                           x-on:change='fetch("{{route('events.update', $event)}}", {"method": "post", "headers": {"Content-Type":"application/json"}, "body": JSON.stringify({"_token": "{{csrf_token()}}", "name": $event.target.value})})'
                                    >
                                    <p class="text-slate-400">
                                        {{collect([
                                            $event->start->format('g:ia'),
                                            !$event->active ? $event->durationForHumans() : null
                                        ])->filter()->join(' • ')}}
                                    </p>
                                    @if ($event->active)
                                        <form action="{{route('events.update', $event)}}" method="post">
                                            {{csrf_field()}}
                                            <input type="hidden" name="stop_at" value="NOW">
                                            <button class="inline-block text-sm text-red-500 bg-red-100 rounded-full py-1 px-3">
                                                {{ $event->durationForHumans() }}
                                                <span class="text-xs">⏯️</span>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                                <div class="rounded-full bg-{{$event->color ?? 'slate-200'}} w-[7px] h-full absolute top-0 {{ !$isLeft ? '-right-[calc(1rem+4px)]' : '-left-[calc(1rem+3px)]' }}"></div>
                            </div>
                        </li>
                        @php
                            $isLeft = !$isLeft;
                        @endphp
                    @endforeach
                    @if ($todaysEvents->count() === 0)
                        <li class="relative z-10 text-center py-48 text-slate-400 font-serif italic">
                            <span class="text-sm inline-block bg-white p-1 z-10">
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
                                <button class="text-red-500 text-2xl bg-white px-2 z-10 relative inline-block">⊕</button>
                                <div class="absolute top-1/2 left-[calc(50%_+_0.75rem)] right-0 border-b-2 border-red-500"></div>
                            </form>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    @endforeach
</x-app>
