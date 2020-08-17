<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Traits\UsesUUID;
use Illuminate\Database\Eloquent\SoftDeletes;
class Slider extends Model
{


    use UsesUUID;

    use SoftDeletes;
}
