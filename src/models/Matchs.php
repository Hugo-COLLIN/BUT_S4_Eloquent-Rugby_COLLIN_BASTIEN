<?php
declare(strict_types=1);

namespace rugby\models;

use \Illuminate\Database\Eloquent as Eloq;

class Matchs extends Eloq\Model
{
    protected $table = 'matchs';
    protected $primaryKey = 'numMatch';
    public $timestamps = false;

    public function jouerJoueur(): Eloq\Relations\BelongsToMany
    {
        return $this->belongsToMany("rugby\models\Joueur", "rugby\models\Jouer", "numMatch", "numJoueur");
    }

    public function arbitrerArbitre(): Eloq\Relations\BelongsToMany
    {
        return $this->belongsToMany("rugby\models\Arbitre", "rugby\models\Arbitrer", "numMatch", "numArbitre");
    }

    public function equipe_recoit(): Eloq\Relations\BelongsTo
    {
        return $this->belongsTo("rugby\models\Equipe", "numEquipeR");
    }

    public function equipe_deplace(): Eloq\Relations\BelongsTo
    {
        return $this->belongsTo("rugby\models\Equipe", "numEquipeD");
    }

    public function stade(): Eloq\Relations\BelongsTo
    {
        return $this->belongsTo("rugby\models\Stade", "numStade");
    }
}