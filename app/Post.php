<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    //
    use SoftDeletes;
    protected $table = 'posts';

    protected $fillable = ['subject','description','status','user_id'];

    public function posttags()
    {
      return $this->hasMany('App\Tagpost','post_id', 'id');
    }

     public function user()
    {
      return $this->hasOne('App\User', 'id','user_id')->withTrashed();
    }
}
