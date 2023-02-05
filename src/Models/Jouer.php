<?php
declare(strict_types=1);

namespace rugby\models;

use \Illuminate\Database\Eloquent as Eloq;

class Jouer extends Eloq\Model
{
    protected $table = 'jouer';
    protected $primaryKey = ['numMatch', 'numJoueur'];
    public $timestamps = false;
}