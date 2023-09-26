<x-app>
    <form action="{{route('users.store')}}" method="post">
        {{csrf_field()}}
        <p>
            <label>
                Name
                <input type="text" name="name" value="{{old('name')}}">
            </label>
            @error('name')<div class="text-red-500">{{ $message }}</div>@enderror
        </p>
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
            <button>Register</button>
        </p>
    </form>
    <p><a href="{{route('users.login')}}">or log in</a> instead.</p>
</x-app>
