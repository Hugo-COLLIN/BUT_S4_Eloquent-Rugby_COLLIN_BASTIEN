<?php
declare(strict_types=1);

namespace rugby\models;

use \Illuminate\Database\Eloquent as Eloq;

class Joueur extends Eloq\Model
{
    protected $table = 'joueur';
    protected $primaryKey = 'numJoueur';
    public $timestamps = false;

    public function joueur(): Eloq\Relations\BelongsTo
    {
        return $this->belongsTo("rugby\models\Equipe", "codeEquipe");
    }

    public function poste(): Eloq\Relations\BelongsTo
    {
        return $this->belongsTo("rugby\models\Poste", "numPoste");
    }

    public function jouerMatch(): Eloq\Relations\BelongsToMany
    {
        return $this->belongsToMany("rugby\models\Match", "rugby\models\Jouer", "numJoueur", "numMatch");
    }

}