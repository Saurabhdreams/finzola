<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\MultiTenant;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Laracasts\Flash\Flash;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
                'regex:/^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/i',
                function ($attribute, $value, $fail) {
                    $parts = explode('@', $value);
                    if (count($parts) === 2 && preg_match('/\d/', $parts[1])) {
                        $fail(__('The :attribute should not contain numbers after the @ symbol.'));
                    }
                },
            ],
            'password' => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,16}$/|same:password_confirmation|min:6',
        ], [
            'email.regex' => 'The email format is invalid.',
            'password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
        ]);

        $input = $request->all();

        try {
            DB::beginTransaction();

            /** @var User $user */
            $tenant = MultiTenant::create(['tenant_username' => $request->first_name]);

            /** @var UserRepository $userRepository */
            $userRepository = App::make(UserRepository::class);
            $user = $userRepository->createUser($input, $tenant);

            event(new Registered($user));

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($exception->getMessage());
        }

        Flash::success(__('messages.flash.you_have_registered'));

        return redirect(route('login'));
    }
}
