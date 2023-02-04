<?php

namespace rugby\Models;

use Illuminate\Database\Eloquent\Model as Model;

class Stade extends Model{
    public $table = 'stade';
    public $primaryKey = 'numStade';
    public $timestamps = false;
}
