<?php

namespace App\Http\Controllers\Auth;

use App\Events\Auth\UserLoginSuccess;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class FallbackLoginController
{
    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $this->ensureIsNotRateLimited($credentials['email'], $request->ip());

        if (! Auth::attempt($credentials + ['status' => 1], $request->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey($credentials['email'], $request->ip()));

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ])->redirectTo(route('login'));
        }

        $user = Auth::user();

        event(new UserLoginSuccess($request, $user));

        RateLimiter::clear($this->throttleKey($credentials['email'], $request->ip()));
        Session::regenerate();

        if (session()->has('url.intended') && str_contains(session('url.intended'), 'login')) {
            session()->forget('url.intended');
        }

        $defaultRoute = $user && $user->can('view_backend')
            ? route('backend.home', absolute: false)
            : route('frontend.index', absolute: false);

        $intendedUrl = $request->session()->pull('url.intended', $defaultRoute);

        if (empty($intendedUrl) || $intendedUrl === route('login')) {
            $intendedUrl = $defaultRoute;
        }

        return redirect()->to($intendedUrl);
    }

    protected function ensureIsNotRateLimited(string $email, string $ip): void
    {
        $key = $this->throttleKey($email, $ip);

        if (! RateLimiter::tooManyAttempts($key, 5)) {
            return;
        }

        $seconds = RateLimiter::availableIn($key);

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ])->redirectTo(route('login'));
    }

    protected function throttleKey(string $email, string $ip): string
    {
        return Str::transliterate(Str::lower($email).'|'.$ip);
    }
}
