<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'price'
    ];

    protected $table = 'coupons';

    public function getDeletedAtAttribute($value)
    {
        return date('d/m/Y', strtotime($value));
    }
    public function getPriceAttribute($value)
    {
        return number_format($value);
    }
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_coupon', 'coupon_id', 'user_id');
    }
}
