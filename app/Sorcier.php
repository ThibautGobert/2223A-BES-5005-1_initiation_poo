<?php

namespace App;
class Sorcier extends Personnage {
    public int $magie = 50;

    public function __construct(string $nom = null, int $magie = null)
    {
        parent::__construct($nom);
        if($magie) {
            $this->magie = $magie;
        }
        $this->force /=2;

    }
}