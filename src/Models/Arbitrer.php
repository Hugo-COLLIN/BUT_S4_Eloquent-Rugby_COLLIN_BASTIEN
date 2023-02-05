<?php
declare(strict_types=1);

namespace rugby\models;


use \Illuminate\Database\Eloquent as Eloq;

class Arbitrer extends Eloq\Model
{
    protected $table = 'arbitrer';
    protected $primaryKey = ['numMatch', 'numArbitre'];
    public $timestamps = false;
}