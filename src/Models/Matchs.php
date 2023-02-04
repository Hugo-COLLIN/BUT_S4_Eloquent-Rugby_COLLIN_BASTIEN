<?php

namespace rugby\Models;

use Illuminate\Database\Eloquent\Model as Model;

class Matchs extends Model{
    public $table = 'matchs';
    public $primaryKey = 'numMatch';
    public $timestamps = false;
}
