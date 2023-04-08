<?php

namespace App;
use App\Inventaire\Arme;

class Personnage {
    public string $nom;
    public int $force = 20;
    public int $vie = 100;
    public Arme $arme;

    public function __construct(string $nom = null)
    {
        $this->nom = $nom;
        $this->arme = new Arme();
    }

    public function attaque(Personnage $personnage)
    {
        $personnage->vie -= $this->force - $this->arme->degat;
    }

}