<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tagpost extends Model
{
    //
    use SoftDeletes;
    protected $table = 'tag_posts';

    protected $fillable = ['post_id','tag_id'];

    public function posts()
    {
      return $this->belongsTo('App\Post','post_id', 'id');
    }

    public function tags()
    {
      return $this->belongsTo('App\Tag','tag_id', 'id');
    }
}
