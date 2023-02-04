<?php

namespace rugby\Models;

use Illuminate\Database\Eloquent\Model as Model;

class Joueur extends Model{
    public $table = 'joueur';
    public $primaryKey = 'numJoueur';
    public $timestamps = false;
}
