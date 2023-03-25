<?php
# (c) PremierExpo 2022

namespace App\Http\Requests\API;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
            'lang' => ['in:uk,ru,en'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate() {
        $this->ensureIsNotRateLimited();

        if (! Auth::guard('api')->attempt(array_merge($this->only('email', 'password'),['is_blocked'=>0]), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());
            activity('VisitorAuth')->withProperties(['ip' => request()->ip()])->log('l:'.$this->email.' p:'.$this->password.' | Неудачная попытка входа в систему');
            return false;
        } else {
            RateLimiter::clear($this->throttleKey());
            return true;
        }
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited()
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }
        event(new Lockout($this));
        $seconds = RateLimiter::availableIn($this->throttleKey());
        throw ValidationException::withMessages([
            'email' => trans('API/login.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    public function throttleKey()
    {
        return Str::lower($this->input('email')).'|'.$this->ip();
    }
}
