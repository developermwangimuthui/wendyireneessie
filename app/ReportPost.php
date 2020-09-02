<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesUUID;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Post;
class ReportPost extends Model
{

    use SoftDeletes, UsesUUID;

    public function posts(){
        return $this->belongsTo(Post::class);
    }
}
