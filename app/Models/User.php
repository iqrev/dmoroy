<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin' || $this->role === 'admin';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin' || $this->role === 'super_admin' || $this->role === 'operator';
    }

    public function canAccessPanel(Panel $panel): bool
    {
        // Allow all verified users or specific emails to access the panel
        return str_ends_with($this->email, '@websitejambi.com') || 
               str_ends_with($this->email, '@UMKMjambiberkah.com') ||
               str_ends_with($this->email, '@test.com') ||
               $this->email === 'dmoroykreasialamnusantara@gmail.com';
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
