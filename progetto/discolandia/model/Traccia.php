<?php
class Traccia {
    
    private $codTraccia;
    
    private $numero;
    
    private $titolo;
    
    private $codDisco;


    public function getCodTraccia() {
        return $this->codTraccia;
    }

    public function setCodTraccia($codTraccia) {
        $this->codTraccia = $codTraccia;
    }
    
    public function getNumero() {
        return $this->numero;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }
    
    public function getTitolo() {
        return $this->titolo;
    }

    public function setTitolo($titolo) {
        $this->titolo = $titolo;
    }
    
    public function getCodDisco() {
        return $this-codDisco;
    }

    public function setCodDisco($codDisco) {
        $this->codDisco = $codDisco;
    }
}
   