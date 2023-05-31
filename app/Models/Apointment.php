<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apointment extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'apointments';
    protected $fillable = [
        'code',
        'customer_id',
        'employee_id',
        'appointment_time',
        'status',
        'message'
    ];
    public function getAppointmentTimeAttribute($value)
    {
        return date('H:i d/m/Y', strtotime($value));
    }
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }
    public function employee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'employee_id', 'id');
    }
}
