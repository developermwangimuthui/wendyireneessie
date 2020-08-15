<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Traits\UsesUUID;
use Illuminate\Database\Eloquent\SoftDeletes;
class Report extends Model
{
 
    use SoftDeletes, UsesUUID;
}
