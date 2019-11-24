<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static paginate()
 * @method static latest()
 */
class Status extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function like()
    {
        $this->likes()->firstOrCreate([
            'user_id' => auth()->id()
        ]);
    }
}
