<?php

use App\Chevalier;
use App\Personnage;
use App\Sorcier;

require './vendor/autoload.php';


$chevalier = new Personnage('Arthur');
$chevalier2 = new Chevalier('Lancelot le vrai chevalier');
$sorcier = new Sorcier('Merlin');
$sorcier2 = new Sorcier('Gandalf', 150);

$chevalier->attaque($sorcier);

echo $chevalier2->arme->degat;
dd($chevalier,$chevalier2, $sorcier, $sorcier2);



