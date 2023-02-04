<?php

namespace rugby\Models;

use Illuminate\Database\Eloquent\Model as Model;

class Equipe extends Model{
    public $table = 'equipe';
    public $primaryKey = 'id';
    public $timestamps = false;
}
