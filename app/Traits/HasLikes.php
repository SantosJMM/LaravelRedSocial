<?php

namespace App\Traits;

use App\Models\Like;

trait HasLikes
{
    /**
     * This method is the polymorphic relationship.
     * @return mixed
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    /**
     * Method to assign like to a related object.
     */
    public function like()
    {
        $this->likes()->firstOrCreate(['user_id' => auth()->id()]);
    }

    /**
     * Method to remove like a related object.
     */
    public function unlike()
    {
        $this->likes()->where(['user_id' => auth()->id()])->delete();
    }

    /**
     * This method indicates if the authenticated user already gave like.
     * @return bool
     */
    public function isLiked()
    {
        return $this->likes()->where('user_id', auth()->id())->exists();
    }

    /**
     * This method the number of likes that the related object has.
     * @return int
     */
    public function likesCount()
    {
        return $this->likes()->count();
    }
}
