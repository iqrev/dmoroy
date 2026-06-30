<?php

namespace App\Filament\Pages\Auth;

use App\Models\LoginAttempt;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Auth\Http\Responses\Contracts\LoginResponse;
use Filament\Auth\Pages\Login as BaseLogin;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class Login extends BaseLogin
{
    /**
     * Override authenticate untuk menambahkan logging dan honeypot check.
     */
    public function authenticate(): ?LoginResponse
    {
        $data = $this->form->getState();

        try {
            $response = parent::authenticate();

            // Login sukses — log dan reset rate limiter
            if ($response !== null) {
                $email = $data['email'] ?? 'unknown';

                LoginAttempt::logAttempt(
                    email: $email,
                    status: 'success',
                );

                Log::info('Login berhasil', [
                    'email' => $email,
                    'ip' => request()->ip(),
                ]);

                // Reset rate limiter setelah login berhasil
                $key = 'login-attempt:' . request()->ip();
                app(\Illuminate\Cache\RateLimiter::class)->clear($key);
            }

            return $response;

        } catch (ValidationException $e) {
            // Login gagal — log percobaan
            $email = $data['email'] ?? 'unknown';

            LoginAttempt::logAttempt(
                email: $email,
                status: 'failed',
            );

            Log::warning('Login gagal', [
                'email' => $email,
                'ip' => request()->ip(),
            ]);

            throw $e;
        }
    }

    /**
     * Override form
     */
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getRememberFormComponent(),
            ]);
    }
}
