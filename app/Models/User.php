<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Exception;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'code',
        'fullname',
        'password',
        'phone_number',
        'day_of_birth',
        'address',
        'level',
        'note',
        'department_id',
    ];
    protected $primaryKey = 'id';

    protected $table = 'users';
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function getDeletedAtAttribute($value)
    {
        return date('d/m/Y', strtotime($value));
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->password = Hash::make('password');
        });
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
    public function packages(): BelongsToMany
    {
        return $this->belongsToMany(Package::class, 'user_package', 'user_id', 'package_id');
    }
    public function apointments(): HasMany
    {
        return $this->hasMany(Apointment::class, 'customer_id', 'id');
    }
    public function staff_apointments(): HasMany
    {
        return $this->hasMany(Apointment::class, 'employee_id', 'id');
    }
}
