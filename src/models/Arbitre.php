<?php
declare(strict_types=1);

namespace rugby\models;

use \Illuminate\Database\Eloquent as Eloq;

class Arbitre extends Eloq\Model
{
    protected $table = 'arbitre';
    protected $primaryKey = 'numArbitre';
    public $timestamps = false;

    public function arbitrerMatchs(): Eloq\Relations\BelongsToMany
    {
        return $this->belongsToMany("rugby\models\Matchs", "rugby\models\Arbitrer", "numArbitre", "numMatch");
    }
}