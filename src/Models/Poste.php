<?php
declare(strict_types=1);

namespace rugby\models;

use \Illuminate\Database\Eloquent as Eloq;

class Poste extends Eloq\Model
{
    protected $table = 'poste';
    protected $primaryKey = 'numero';
    public $timestamps = false;

    public function association() : mixed {
        return $this->hasMany('rugby\Models\Joueur', 'numPoste',$this->primaryKey);
    }

    public function joueur(): Eloq\Relations\HasMany
    {
        return $this->hasMany("rugby\models\Joueur", "numero");
    }
}