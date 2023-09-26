<?php

namespace App\Http\Controllers\Session;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Attributes\Validation\Unique;
use Spatie\LaravelData\Data;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreData $data, Request $request)
    {
        if (Auth::attempt($data->toArray())) {
            $request->session()->regenerate();

            return redirect()->intended('calendar.index');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}

class StoreData extends Data
{
    public function __construct(
        #[Required, StringType, Email]
        public string $email,
        #[Required, StringType]
        public string $password,
    ) {
    }
}
