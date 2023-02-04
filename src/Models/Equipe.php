<?php
declare(strict_types=1);

namespace rugby\models;

use \Illuminate\Database\Eloquent as Eloq;

class Equipe extends Eloq\Model
{
    protected $table = 'equipe';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function joueur(): Eloq\Relations\HasMany
    {
        return $this->hasMany("rugby\models\Joueur", "codeEquipe");
    }

    public function matchRecoit(): Eloq\Relations\HasMany
    {
        return $this->hasMany("rugby\models\Match", "codeEquipe_recoit");
    }

    public function matchDeplace(): Eloq\Relations\HasMany
    {
        return $this->hasMany("rugby\models\Match", "codeEquipe_deplace");
    }
}