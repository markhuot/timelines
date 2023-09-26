<x-app>
    <form action="{{route('sessions.create')}}" method="post">
        {{csrf_field()}}
        <p>
            <label>
                Email
                <input type="text" name="email" value="{{old('email')}}">
            </label>
        @error('email')<div class="text-red-500">{{ $message }}</div>@enderror
        </p>
        <p>
            <label>
                Password
                <input type="password" name="password">
            </label>
        @error('password')<div class="text-red-500">{{ $message }}</div>@enderror
        </p>
        <p>
            <button>Log in</button>
        </p>
    </form>
    <p><a href="{{route('users.register')}}">or register</a> instead.</p>
</x-app>
