<?php

namespace App;

class Chevalier extends Personnage {
    public function __construct(string $nom = null)
    {
        parent::__construct($nom);
        $this->force += 30;
    }
}