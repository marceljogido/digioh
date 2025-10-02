<?php

namespace App\Livewire\Auth;

use App\Events\Auth\UserLoginSuccess;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Title('Login')]
#[Layout('components.layouts.auth')]
class Login extends Component
{
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password, 'status' => 1], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        $user = Auth::user();

        event(new UserLoginSuccess(request(), $user));

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        // Hapus session URL intended jika berisi URL login untuk mencegah redirect loop
        if (session()->has('url.intended') && str_contains(session('url.intended'), 'login')) {
            session()->forget('url.intended');
        }

        $defaultRoute = $user && $user->can('view_backend')
            ? route('backend.home', absolute: false)
            : route('frontend.index', absolute: false);

        // Get the intended URL, but avoid redirecting back to login
        $intendedUrl = request()->session()->pull('url.intended', $defaultRoute);
        
        // If the intended URL is the login page or empty, use the default route instead
        if (empty($intendedUrl) || $intendedUrl === route('login')) {
            $intendedUrl = $defaultRoute;
        }
        
        $this->redirect($intendedUrl, navigate: true);
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }
}
