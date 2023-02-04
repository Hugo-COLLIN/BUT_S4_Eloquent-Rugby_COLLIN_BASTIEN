<?php

namespace rugby\Models;

use Illuminate\Database\Eloquent\Model as Model;

class Arbitre extends Model{
    public $table = 'arbitre';
    public $primaryKey = 'numArbitre';
    public $timestamps = false;
}
