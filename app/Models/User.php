<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'zip',
        'avatar',
        'latitude',
        'longitude',
        'type',
        'company',
        'owner',
        'tax_id',
        'otp',
        'status',
        'busy_start_time',
        'busy_end_time',
        'email_verified_at',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function vendor_products() {
        return $this->hasMany(VendorProduct::class);
    }
    public function notifications() {
        return $this->hasMany(Notification::class);
    }
    public static function boot() {
        parent::boot();

        static::deleting(function($user) { // before delete() method call this
             $user->vendor_products()->delete();
             // do the rest of the cleanup...
        });
    }
}
