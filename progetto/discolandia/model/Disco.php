<?php
class Disco {
    private $codDisco;
    
    private $titolo;
    
    private $artista;
    
    private $tracce;
    
    private $genere;
    
    private $descrizione;
    
    private $etichetta;
    
    private $immagine;
    
    private $anno;
    
    private $prezzo;
    
    private $disponibili;


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
    
    public function getTracce() {
        return $this->tracce;
    }

    public function setTracce($tracce) {
        $this->tracce = $tracce;
    } 
    
    public function getArtista() {
        return $this->artista;
    }

    public function setArtista($artista) {
        $this->artista = $artista;
    }
    
    public function getGenere() {
        return $this->genere;
    }

    public function setGenere($genere) {
        $this->genere = $genere;
    }
    
    public function getDescrizione() {
        return $this->descrizione;
    }

    public function setDescrizione($descrizione) {
        $this->descrizione = $descrizione;
    }
    
    public function getEtichetta() {
        return $this->etichetta;
    }

    public function setEtichetta($etichetta) {
        $this->etichetta = $etichetta;
    }
    
    public function getImmagine() {
        return $this->immagine;
    }

    public function setImmagine($immagine) {
        $this->immagine = $immagine;
    }
    
    public function getAnno() {
        return $this->anno;
    }

    public function setAnno($anno) {
        $this->anno = $anno;
    }
    
    public function getPrezzo() {
        return $this->prezzo;
    }

    public function setPrezzo($prezzo) {
        $this->prezzo = $prezzo;
    }
    
    public function getDisponibili() {
        return $this->disponibili;
    }

    public function setDisponibili($disponibili) {
        $this->disponibili = $disponibili;
    }
}
?>
