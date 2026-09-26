<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;

class LoginToken extends Model
{
    protected $fillable = ['user_id', 'token', 'expires_at', 'status'];

    protected function casts(): array {
        return [
            'expires_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function isValid(): bool {
        return $this->expires_at->isFuture();
    }

    public function scopePending(Builder $query): void {
        $query->where('status', 'pending');
    }

    public static function generateForUser(User $user): self {
        static::where('created_at', '<=', now()->subMinutes(5))->delete();

        $token = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        return static::create([
            'user_id' => $user->id,
            'token' => $token,
            'expires_at' => now()->addMinutes(5),
        ]);
    
    }

    // Para QR (no terminado)
    // public static functio generateForQr(): self {
    //     static::where('created_at', '<=', now()->subMinutes(5))->delete();

    //     $token = substr(bin2hex(random_bytes(3)), 0, 6);

    //     return static::create([
    //         'user_id' => null,
    //         'token' => $token,
    //         'expires_at' => now()->addMinutes(5),
    //         'status' => 'pending',
    //     ]);
    // }
}
