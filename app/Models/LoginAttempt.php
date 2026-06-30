<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoginAttempt extends Model
{
    protected $fillable = [
        'email',
        'ip_address',
        'user_agent',
        'status',
    ];

    /**
     * Scope untuk percobaan login gagal.
     */
    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    /**
     * Scope untuk percobaan login sukses.
     */
    public function scopeSuccessful($query)
    {
        return $query->where('status', 'success');
    }

    /**
     * Log percobaan login.
     */
    public static function logAttempt(string $email, string $status, ?string $ip = null, ?string $userAgent = null): self
    {
        return self::create([
            'email' => $email,
            'ip_address' => $ip ?? request()->ip(),
            'user_agent' => $userAgent ?? request()->userAgent(),
            'status' => $status,
        ]);
    }
}
