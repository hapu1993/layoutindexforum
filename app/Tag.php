<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    //
    use SoftDeletes;
    protected $table = 'tags';

    protected $fillable = ['name','status'];

    public function posttags()
    {
      return $this->hasMany('App\Tagpost','tag_id', 'id');
    }

    public function getConnectedPostCount($post_id)
    {
    	return $this->posttags->where('post_id','!=',$post_id)->count();
    }
}
