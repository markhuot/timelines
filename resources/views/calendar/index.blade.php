@php
$now = now('America/New_York')->toImmutable();
$start = $now->toImmutable()->subDay();
$end = $now->toImmutable()->addDay();
$events = [
    (object)[
        'start' => now()->toImmutable()->subMinutes(37),
        'end' => now()->toImmutable(),
        'period' => now()->toImmutable()->subMinutes(37)->toPeriod(now()->toImmutable()),
        'title' => 'active event',
        'active' => true,
    ],
    (object)[
        'start' => now()->toImmutable()->setTime(14, 0, 0),
        'end' => now()->toImmutable()->setTime(15, 0, 0),
        'period' => now()->toImmutable()->setTime(14, 0, 0)->toPeriod(now()->toImmutable()->setTime(15, 0, 0)),
        'title' => 'PLAYR-302',
        'color' => 'text-orange-500'
    ],
    (object)[
        'start' => now()->toImmutable()->setTime(10, 0, 0),
        'end' => now()->toImmutable()->setTime(12, 0, 0),
        'period' => now()->toImmutable()->setTime(10, 0, 0)->toPeriod(now()->toImmutable()->setTime(12, 0, 0)),
        'title' => 'morning event',
    ],
    (object)[
        'start' => now()->toImmutable()->setTime(10, 0, 0),
        'end' => now()->toImmutable()->setTime(12, 0, 0),
        'period' => now()->toImmutable()->setTime(10, 0, 0)->toPeriod(now()->toImmutable()->setTime(12, 0, 0)),
        'title' => 'second morning event',
    ]
]
@endphp
<x-app>
    @foreach($start->toPeriod($end) as $day)
        <div class="relative border-l-2 border-slate-200 ml-12">
            <p class="sticky top-0 bg-white backdrop-blur-sm -ml-12 pl-12 border-b-2 border-slate-200 p-2 font-bold">{{$day->format('M j')}}</p>
            <div class="relative">
                @if ($day->isToday())
                    @php
                        $percent = floor(($now->timestamp - $now->startOfDay()->timestamp) / (60 * 60 * 24) * 100);
                    @endphp
                    <div class="w-full absolute left-0 top-[--top] z-20" style="--top: {{$percent}}%">
                        <div class="absolute left-0 top-0 -translate-x-full -ml-2 -translate-y-1/2 text-red-500">→</div>
                        <div class="absolute top-0 left-0 border-b-2 border-red-500 w-[calc(50%_-_0.75rem)]"></div>
                        <button class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 text-red-500 text-2xl">⊕</button>
                        <div class="absolute top-0 left-[calc(50%_+_0.75rem)] right-0 border-b-2 border-red-500"></div>
                    </div>
                @endif
                <ul class="min-h-[--height] flex flex-col divide-y divide-slate-100" style="--height: 200vh">
                    @foreach ($day->startOfDay()->toPeriod($day->endOfDay(), '1 hour') as $hour)
                        <li class="flex-grow relative">
                            <div class="text-xs text-slate-400 pt-2 pl-2 inline-block font-light absolute top-0 left-0 -translate-x-full -translate-y-1/2 -ml-1">{{$hour->format('ga')}}</div>
                            @foreach ($events as $event)
                                @if ($hour->startOfHour()->toPeriod($hour->endOfHour())->contains($event->period))
                                    @php
                                        $top = floor(($event->start->timestamp - $hour->timestamp) / (60 * 60) * 100);
                                        $height = floor(($event->end->timestamp - $event->start->timestamp) / (60 * 60) * 100);
                                    @endphp
                                    <div class="absolute z-10 top-[--top] left-0 w-full h-[--height]" style="--height: {{$height}}%; --top: {{$top}}%">
                                        <div class="sticky top-0 text-sm p-2 -translate-y-1/2 {{ ($event->active ?? false) ? 'text-red-500' : '' }}">
                                            <span class="{{ $event->color ?? '' }}">⏺</span>
                                            {{$event->title}}
                                        </div>
                                        <div class="absolute top-0 left-[0.72rem] w-[--corner-size] border-l-2 border-b-2 {{ ($event->active ?? false) ? 'border-red-500' : 'border-gray-400' }} h-full rounded-bl-[--corner-size]" style="--corner-size: 8px"></div>
                                        @if (@$event->active)
                                            <div class="absolute bottom-0 left-0 ml-6 text-sm text-red-500">
                                                {{ $event->start->diffAsCarbonInterval($event->end)->forHumans() }}
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endforeach
</x-app>
