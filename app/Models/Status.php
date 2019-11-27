<?php

namespace App\Models;

use App\Traits\HasLikes;
use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static paginate()
 * @method static latest()
 * @method static truncate()
 */
class Status extends Model
{
    use HasLikes;

    protected $guarded = [];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
