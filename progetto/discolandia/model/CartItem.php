<?php
class CartItem {
   
    private $idCompratore;
    
    private $codDisco;
    
    private $quantita;
    
    private $titolo;
    
    private $prezzo;


    public function getIdCompratore() {
        return $this->idCompratore;
    }

    public function setIdCompratore($idCompratore) {
        $this->idCompratore = $idCompratore;
    }
   
    public function getCodDisco() {
        return $this->codDisco;
    }

    public function setCodDisco($codDisco) {
        $this->codDisco = $codDisco;
    }
  
    public function getQuantita() {
        return $this-> quantita;
    }

    public function setQuantita($quantita) {
        $this->quantita = $quantita;
    }
    
    public function getTitolo() {
        return $this-> titolo;
    }

    public function setTitolo($titolo) {
        $this->titolo = $titolo;
    }
    
    public function getPrezzo() {
        return $this-> prezzo;
    }

    public function setPrezzo($prezzo) {
        $this->prezzo = $prezzo;
    }
}
?>
