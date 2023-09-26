<div class="fixed bottom-0 left-1/2 mb-4 bg-black rounded-full py-2 px-5 -translate-x-1/2 font-thin space-x-4 z-50 shadow-lg shadow-slate-500 text-slate-100">
    <span>{{auth()->user()->name}}</span>
    <a href="{{route('settings.index')}}" class="">⋯</a>
</div>
