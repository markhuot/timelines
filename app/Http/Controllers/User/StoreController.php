<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
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
    public function __invoke(StoreData $data)
    {
        $user = new User;
        $user->name = $data->name;
        $user->email = $data->email;
        $user->password = $data->password;
        $user->save();

        auth()->login($user);

        return response()->redirectToRoute('calendar.index');
    }
}

class StoreData extends Data
{
    public function __construct(
        #[Required, StringType]
        public string $name,
        #[Required, StringType, Email, Unique('users')]
        public string $email,
        #[Required, StringType]
        public string $password,
    ) {
    }
}
