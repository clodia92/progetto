<?php
class Transazione {
    private $idCompratore;
    
    private $idVenditore;
    
    private $codDisco;
    
    private $titolo;

    private $data;
    
    private $prezzo;
    
    private $quantita;
    

    public function getIdCompratore() {
        return $this->idCompratore;
    }

    public function setIdCompratore($idCompratore) {
        $this->idCompratore = $idCompratore;
    } 
    
    public function getIdVenditore() {
        return $this->idVenditore;
    }

    public function setIdVenditore($idVenditore) {
        $this->idVenditore = $idVenditore;
    } 
    
    public function getCodDisco() {
        return $this->codDisco;
    }

    public function setCodDisco($codDisco) {
        $this->codDisco = $codDisco;
    }
   
    public function getTitolo() {
        return $this->titolo;
    }

    public function setTitolo($titolo) {
        $this->titolo = $titolo;
    }
    
    
    
    public function getData() {
        return $this->data;
    }

    public function setData($data) {
        $this->data = $data;
    }
    
    public function getPrezzo() {
        return $this->prezzo;
    }

    public function setPrezzo($prezzo) {
        $this->prezzo = $prezzo;
    }
    
    public function getQuantita() {
        return $this->quantita;
    }

    public function setQuantita($quantita) {
        $this->quantita = $quantita;
    }
    
}
?>
