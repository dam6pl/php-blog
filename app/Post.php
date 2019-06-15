<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';

    protected $fillable = ['author_id', 'title', 'content', 'image_url'];


    /**
     * Get the author record associated with the post.
     */
    public function author()
    {
        return $this->hasOne('App\User', 'id', 'author_id');
    }
}
