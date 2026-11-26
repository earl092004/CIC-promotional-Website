<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements FilamentUser
{
    public const ROLE_ADMINISTRATOR = 'administrator';

    public const ROLE_CONTRIBUTOR = 'contributor';

    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

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

    public function canAccessPanel(Panel $panel): bool
    {
        return in_array($this->role, [
            self::ROLE_ADMINISTRATOR,
            self::ROLE_CONTRIBUTOR,
        ], true);
    }

    public function isAdministrator(): bool
    {
        return $this->role === self::ROLE_ADMINISTRATOR;
    }

    public function isContributor(): bool
    {
        return $this->role === self::ROLE_CONTRIBUTOR;
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'author_id');
    }
}
