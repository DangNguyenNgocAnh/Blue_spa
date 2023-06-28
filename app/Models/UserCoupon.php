<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCoupon extends Model
{
    use HasFactory;
    protected $table = 'user_coupon';
    protected $fillable = [
        'user_id',
        'coupon_id',
        'timeExpiredAt',
        'status',
        'created_at'
    ];
    public function getTimeExpiredAt($value)
    {
        return date('d/m/Y', strtotime($value));
    }
    public function getCreatedAt($value)
    {
        return date('d/m/Y', strtotime($value));
    }
}
