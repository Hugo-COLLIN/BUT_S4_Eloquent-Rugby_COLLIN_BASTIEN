<?php

namespace rugby\Models;

use Illuminate\Database\Eloquent\Model as Model;

class Poste extends Model{
    public $table = 'poste';
    public $primaryKey = 'numero';
    public $timestamps = false;


    public function association() : mixed{
        return $this->hasMany('rugby\Models\Joueur', 'numPoste',$this->primaryKey);
    }
}
