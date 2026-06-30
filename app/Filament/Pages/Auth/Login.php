<?php

namespace App\Filament\Pages\Auth;

use App\Models\LoginAttempt;
use Filament\Auth\Http\Responses\Contracts\LoginResponse;
use Filament\Auth\Pages\Login as BaseLogin;
use Filament\Forms\Components\Checkbox;
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
        
        // Improved Honeypot Check: Menggunakan Checkbox agar tidak di-autofill oleh Password Manager
        // Bot biasanya akan mencentang semua checkbox (seperti 'I agree to terms' atau 'Subscribe')
        $honeypot = $data['terms_and_conditions_99'] ?? false;

        if ($honeypot === true) {
            Log::warning('Login honeypot (checkbox) triggered', [
                'ip' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);

            LoginAttempt::logAttempt(
                email: $data['email'] ?? 'bot-detected',
                status: 'failed',
            );

            throw ValidationException::withMessages([
                'data.email' => __('filament-panels::auth/pages/login.messages.failed'),
            ]);
        }

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
                $this->getHoneypotFormComponent(),
            ]);
    }

    /**
     * Honeypot field (Checkbox)
     * Bot spammer cenderung mencentang semua checkbox. 
     * Password manager/Browser autofill TIDAK akan mencentangnya.
     */
    protected function getHoneypotFormComponent(): Component
    {
        return Checkbox::make('terms_and_conditions_99')
            ->label('I agree to the terms and conditions')
            ->extraAttributes([
                'tabindex' => '-1',
                'style' => 'opacity: 0; position: absolute; top: -9999px; left: -9999px; z-index: -1;',
            ]);
    }
}
