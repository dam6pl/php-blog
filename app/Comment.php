<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'comments';
    protected $fillable = ['post_id', 'author', 'content', "created_at"];

    public function post()
    {
        return $this->hasOne('App\Post', 'id', 'post_id');
    }
}
