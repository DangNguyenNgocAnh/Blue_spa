<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'appicable_level',
        'code',
        'status',
        'types',
        'description'
    ];

    protected $table = 'packages';

    public function getDeletedAtAttribute($value)
    {
        return date('d/m/Y', strtotime($value));
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_package', 'package_id', 'user_id');
    }
}
