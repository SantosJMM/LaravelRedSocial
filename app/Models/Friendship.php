<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static where(array $array)
 * @method static firstOrCreate(array $array)
 * @method static betweenUsers($sender, $recipient)
 */
class Friendship extends Model
{
    protected $guarded = [];

    public function sender()
    {
        return $this->belongsTo(User::class);
    }

    public function recipient()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param Builder $query
     * @param User $sender
     * @param User $recipient
     * @return Builder
     */
    public function scopeBetweenUsers($query, $sender, $recipient)
    {
        return  $query->where([
            ['sender_id', $sender->id],
            ['recipient_id', $recipient->id],
        ])->orWhere([
            ['sender_id', '=', $recipient->id],
            ['recipient_id', '=', $sender->id],
        ]);
    }
}
