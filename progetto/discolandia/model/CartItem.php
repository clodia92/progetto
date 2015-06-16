<?php
class CartItem {
   
    private $idCompratore;
    
    private $codDisco;
    
    private $quantita;


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
}
?>
