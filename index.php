<?php

require './vendor/autoload.php';
use Illuminate\Database\Capsule\Manager as DB;
use rugby\Models\Matchs as matchs;
use rugby\Models\Joueur as joueur;

//connection a la base de donnée
$db = new DB();
$db->addConnection(parse_ini_file('./src/conf/conf.ini'));
$db->setAsGlobal();
$db->bootEloquent();


echo "<h1>Etude de Cas Eloquent Rugby</h1>";

//question 4-a
echo "<h2>question 4.a : </h2>";
echo "<h4>Les equipes</h4>";
$qa = \rugby\Models\Equipe::get();
foreach ($qa as $item){
    echo "{$item->id}. {$item->codeEquipe} {$item->pays} {$item->couleur} {$item->entraineur} </br>";
}

echo "<h4>Les arbitres</h4>";
$qa = \rugby\Models\Arbitre::get();
foreach ($qa as $item){
    echo "{$item->numArbitre}. {$item->nomArbitre} {$item->nationnalite} </br>";
}

echo "<h4>Les Joueurs</h4>";
$qa = \rugby\Models\Joueur::get();
foreach ($qa as $item){
    echo "{$item->numJoueur}. {$item->prenom} {$item->nom} {$item->numPoste} {$item->numEquipe} </br>";
}

echo "<h4>Les postes</h4>";
$qa = \rugby\Models\Poste::get();
foreach ($qa as $item){
    echo "{$item->numero}. {$item->libelle}</br>";
}

echo "<h4>Les stades</h4>";
$qa = \rugby\Models\Stade::get();
foreach ($qa as $item){
    echo "{$item->numStade}. {$item->ville} {$item->pays} {$item->nomStade} {$item->capacite} </br>";
}

echo "<h4>Les Matchs</h4>";
$qa = matchs::get();
foreach ($qa as $item){
    echo "{$item->numMatch}. date : {$item->dateMatch} nbSpec : {$item->nbSpect} stade : {$item->numStade} equipeR : {$item->numEquipeR} score: {$item->scoreR} nbessai: {$item->nbEssaisR} equipeD: {$item->numEquipeD} score: {$item->scoreD} score: {$item->nbEssaisD} </br>";
}

//question 4-b
echo "<h2>Question 4.b</h2>";

echo "<h4>Les Matchs du 2007-09-22 avec un score de plus de 30</h4>";
$qb = matchs::where('dateMatch', '=', '2007-09-22', 'and', 'scoreR','>', 30, 'or', 'scoreD','>', 30)
              ->get();
foreach ($qb as $item){
    echo "{$item->numMatch}. date : {$item->dateMatch} nbSpec : {$item->nbSpect} stade : {$item->numStade} equipeR : {$item->numEquipeR} score: {$item->scoreR} nbessai: {$item->nbEssaisR} equipeD: {$item->numEquipeD} score: {$item->scoreD} score: {$item->nbEssaisD} </br>";
}

//question 4-c
echo "<h2>Question 4.c</h2>";
$qc = \rugby\Models\Poste::where('libelle', 'like', 'Troisieme ligne%')
                            ->get();
foreach ($qc as $item){
    echo "{$item->numero}. {$item->libelle}</br>";
}

//question 4-d
echo "<h2>Question 4.d</h2>";
$qd = \rugby\Models\Stade::where('capacite','>', 45000)
                            ->get();
foreach ($qd as $item){
    echo "{$item->numStade}. {$item->ville} {$item->pays} {$item->nomStade} {$item->capacite} </br>";
}

//question 4-e
echo "<h2>Question 4.e</h2>";
$qe =\rugby\Models\Poste::where('libelle', 'like', 'Premiere ligne%gauche')
                        ->first()
                        ->joueur()
                        ->get();
foreach ($qe as $item){
    echo "{$item->numJoueur}. {$item->prenom} {$item->nom} {$item->numPoste} {$item->numEquipe} </br>";
}

//question 4-f
echo "<h2>Question 4.f</h2>";

$qf = \rugby\Models\Joueur::where('nom', '=', 'Woodcock')
    ->first()
    ->poste()
    ->get();


foreach ($qf as $item)
{
    echo $item->libelle . "</br>";
}

//question 4-g
echo "<h2>Question 4.g</h2>";

$qg = \rugby\Models\Joueur::join('poste', 'joueur.numPoste', '=', 'poste.numero')
    ->get();

foreach ($qg as $value){
    echo "{$value->prenom} {$value->nom} {$value->numPoste} {$value->numEquipe} {$value->libelle} </br>";
}

//question 4-h
echo "<h2>Question 4.h</h2>";
$qh = new \rugby\models\Matchs();
$qh->dateMatch = 2022-12-12;
$qh->numStade =\rugby\models\Stade::where("nomStade","=","Stade de France")
                    ->first()
                    ->numStade;
$qh->numEquipeR = \rugby\models\Equipe::where("pays","=","France")
                    ->first()
                    ->numEquipe;
$qh->scoreR = 10;
$qh->nbEssaisR = 2;
$qh->numEquipeD = \rugby\models\Equipe::where("pays","=","Angleterre")
                    ->first()
                    ->numEquipe;
$qh->scoreD = 5;
$qh->nbEssaisD = 1;

$qh->save();
echo "Match ajouté";

//question 4-i
echo "<h2>Question 4.i</h2>";

$qi = \rugby\Models\Arbitre::where('nomArbitre', '=', 'Marius Jonker')
    ->first()
    ->arbitrerMatchs()
    ->get();

foreach ($qi as $value) {
    $nStade = \rugby\models\Stade::select("nomStade")
        ->where("numStade","=",$value->numStade)
        ->first();
    echo "{$value->numMatch} {$value->dateMatch} $nStade->nomStade</br>";
}

//question 4-j
echo "<h2>Question 4.j</h2>";

$qj = \rugby\Models\Arbitre::where('nomArbitre', '=', 'Wayne Barnes')
    ->first()
    ->arbitrerMatchs()
    ->get();

foreach ($qj as $item){
    $res = $item->equipe_recoit()->first();
    echo "{$res->id} {$res->codeEquipe} {$res->pays} {$res->couleur} {$res->entraineur} </br>";
}

//question 4-k
echo "<h2>Question 4.k</h2>";
//1
$equipeNz = \rugby\Models\Equipe::where('pays', '=', "Nouvelle-Zelande")
    ->first();

//2
$matchD = \rugby\Models\Matchs::where([
    ['dateMatch', '=', '2007-09-23'],
    ['numEquipeD', '=', $equipeNz->id]
])
    ->get();

$matchR = \rugby\Models\Matchs::where([
    ['dateMatch', '=', '2007-09-23'],
    ['numEquipeR', '=', $equipeNz->id]
])
    ->get();

//3
function afficherJoueur4k($match, $equipe){
    foreach ($match as $m){
        $res = $m->jouerJoueur()
            ->where('numEquipe', '=', $equipe->id)
            ->get();
        foreach ($res as $r){
            echo "{$r->prenom} {$r->nom} {$r->numEquipe} </br>";
        }
    }
}

afficherJoueur4k($matchD, $equipeNz);
afficherJoueur4k($matchR, $equipeNz);


//question 4-l
echo "<h2>Question 4.l</h2>";
//on réutilise $equipeNz de la question 4k contenant l'id de l'équipe Néo-Zelandaise
//2
$match = \rugby\Models\Matchs::get();

//3
foreach ($match as $m){
    $res = $m
        ->jouerJoueur()
        ->distinct()
        ->where([
            ['numEquipe', '=', $equipeNz->id],
            ['titulaire', '=', 0]
        ])
        ->get();
    foreach ($res as $r){
        echo "{$r->prenom} {$r->nom} {$r->numEquipe} </br>";
    }
}


//question 4-m
echo "<h2>Question 4.m</h2>";
echo "<h4>Les matchs de l'équipe Néo-Zelandaise contre l'Italie ou le Portugal</h4>";
//on réutilise $equipeNz de la question 4k contenant l'id de l'équipe Néo-Zelandaise
//1
$equipeIt = \rugby\Models\Equipe::where('pays', '=', "Italie")
    ->first();

$equipePg = \rugby\Models\Equipe::where('pays', '=', "Portugal")
    ->first();

//2
$matchs = \rugby\Models\Matchs::where([
    ['numEquipeD', '=', $equipeNz->id],
    ['numEquipeR', '=', $equipeIt->id]
])
    ->orWhere([
        ['numEquipeD', '=', $equipeIt->id],
        ['numEquipeR', '=', $equipeNz->id]
    ])
    ->orWhere([
        ['numEquipeD', '=', $equipeNz->id],
        ['numEquipeR', '=', $equipePg->id]
    ])
    ->orWhere([
        ['numEquipeD', '=', $equipePg->id],
        ['numEquipeR', '=', $equipeNz->id]
    ])
    ->get();

//3
foreach ($matchs as $match) {
    $res = $match->jouerJoueur()
        //->where('numEquipe', '=', $equipe->id)
        ->get();
    foreach ($res as $r){
        echo "{$r->prenom} {$r->nom} {$r->numEquipe} </br>";
    }
}

//question 4-n
echo "<h2>Question 4.n</h2>";
$equipeFr = \rugby\Models\Equipe::where('pays', '=', "France")
    ->first();

$qn1 = \rugby\Models\Joueur::where('numEquipe', '=', $equipeFr->id)
    ->get();

$qn2 = \rugby\Models\Joueur::where('numEquipe', '=', $equipeFr->id)
    ->join('jouer', 'jouer.numJoueur', '=', 'joueur.numJoueur')
    ->join('matchs', 'matchs.numMatch', '=', 'jouer.numMatch')
    /*->jouerMatch()*/ //erreur non-résolue
    ->get();

$qn = $qn1->diff($qn2);

foreach ($qn as $value) {
    echo "{$value->nom} {$value->prenom} </br>";
}

//question 4-o
echo "<h2>Question 4.o</h2>";
