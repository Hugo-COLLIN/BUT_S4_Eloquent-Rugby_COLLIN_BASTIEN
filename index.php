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

//QUESTION EN COURS
echo "<h1>QUESTION EN COURS</h1>";

//question 4-f
echo "<h2>Question 4.g</h2>";


echo "<br><hr>";

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
$qb = matchs::where('dateMatch', '=', '2007-09-22', 'and', 'scoreR','>', 31, 'or', 'scoreD','>', 31)
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

echo "<h2>Question 4.f</h2>";

$qf = \rugby\Models\Joueur::where('nom', '=', 'Woodcock')
    ->first()
    ->poste()
    ->get();

//$qf = \rugby\Models\Poste::joueur()->get();

foreach ($qf as $item)
{
    echo $item->libelle . "</br>";
}


