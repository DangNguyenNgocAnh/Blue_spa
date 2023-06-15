<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'code',
        'status',
        'types',
        'description',
        'price',
        'category_id'
    ];

    protected $table = 'packages';

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
        return $this->belongsToMany(User::class, 'user_package', 'package_id', 'user_id');
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
