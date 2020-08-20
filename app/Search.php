<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Traits\UsesUUID;
use Illuminate\Database\Eloquent\SoftDeletes;
class Search extends Model
{
    //
    use SoftDeletes, UsesUUID;

}
