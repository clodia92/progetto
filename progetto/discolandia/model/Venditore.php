<?php

include_once 'User.php';

//Classe che rappresenta il venditore
class Venditore extends User {

    /**
     * Costruttore
     */
    public function __construct() {
        // richiamiamo il costruttore della superclasse
        parent::__construct();
        $this->setRuolo(User::Venditore);
    }
}
?>
