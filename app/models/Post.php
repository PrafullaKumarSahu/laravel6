<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Tag;

class Post extends Model
{
    protected $guarded = ['id'];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function setStatus($status)
    {
        $this->status = $status;
        $this->save();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_post', 'post_id', 'tag_id');
    }
}
