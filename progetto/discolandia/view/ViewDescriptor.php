<?php

/**
 * Struttura dati per popolare la vista generica master.php
 */
class ViewDescriptor {
    /**
     * GET http
     */

    const get = 'get';
    /**
     * Post HTTP
     */
    const post = 'post';

    /**
     * Titolo della finestra del browser
     * @var string
     */
    private $titolo;

    /**
     * File che include la definizione HTML dell'header
     * @var string 
     */
    private $header_file;



    /**
     * File che include la definizione HTML della sidebar sinistra
     * @var string 
     */
    private $leftBar_file;

    /**
     * File che include la definizione HTML della sidebar destra
     * @var string 
     */
    private $rightBar_file;

    /**
     * File che include la definizione HTML del contenuto principale
     * @var string 
     */
    private $content_file;

    /**
     * Messaggio di errore da mostrare dopo un input (nascosto se nullo)
     * @var string 
     */
    private $messaggioErrore;

    /**
     * Messaggio di conferma da mostrare dopo un input (nascosto se nullo)
     * @var string 
     */
    private $messaggioConferma;
    
    /**
     * Pagina della vista corrente 
     * (le funzionalita' sono divise in tre categorie: 
     * amministratore, studente e docente, corrispondenti alle sottocartelle 
     * di view nel progetto)
     * @var string 
     */
    private $pagina;
    /**
     * Sottopagina della vista corrente (una per funzionalita' da supportare)
     * (le funzionalita' sono divise in tre categorie: 
     * amministratore, studente e docente, corrispondenti alle sottocartelle 
     * di view nel progetto)
     * @var string 
     */
    private $sottoPagina;
   

    
    /**
     * Costruttore
     */
    public function __construct() {
        ;
    }

    /**
     * Restituisce il titolo della scheda del browser
     * @return string
     */
    public function getTitolo() {
        return $this->titolo;
    }

    /**
     * Imposta il titolo della scheda del browser
     * @param string $titolo il titolo della scheda del browser
     */
    public function setTitolo($titolo) {
        $this->titolo = $titolo;
    }

    /**
     * Imposta il file che include la definizione HTML dell'header 
     * @param $headerFile il path al file contentente l'header
     */
    public function setHeaderFile($headerFile) {
        $this->header_file = $headerFile;
    }

    /**
     * Restituisce il path al file include la definizione HTML dell' header
     * @return string
     */
    public function getHeaderFile() {
        return $this->header_file;
    }


    /**
     * Restituisce il path al file che include la definizione HTML della sidebar sinistra
     * @return string
     */
    public function getLeftBarFile() {
        return $this->leftBar_file;
    }

    /**
     * Imposta il path al file che include la definizione HTML della sidebar sinistra
     * @param type $leftBar
     */
    public function setLeftBarFile($leftBar) {
        $this->leftBar_file = $leftBar;
    }

    /**
     * Imposta il file che include la definizione HTML della sidebar destra
     * @return string
     */
    public function getRightBarFile() {
        return $this->rightBar_file;
    }
    
    /**
     * Imposta il path al file che include la definizione HTML della sidebar destra
     * @param type $rightBar
     */
    public function setRightBarFile($rightBar) {
        $this->rightBar_file = $rightBar;
    }

     /**
     * Imposta il file che include la definizione HTML del contenuto principale
     * @return string
     */
    public function setContentFile($contentFile) {
        $this->content_file = $contentFile;
    }

    /**
     * Restituisce il path al file che contiene il contenuto principale
     * @return string
     */
    public function getContentFile() {
        return $this->content_file;
    }
    
    /**
     * Restituisce il testo del messaggio di errore
     * @return string
     */
    public function getMessaggioErrore() {
        return $this->messaggioErrore;
    }

      /**
     * Imposta un messaggio di errore
     * @return string
     */
    public function setMessaggioErrore($msg) {
        $this->messaggioErrore = $msg;
    }

    /**
     * Restituisce il nome della sotto-pagina corrente
     * @return string
     */
    public function getSottoPagina() {
        return $this->sottoPagina;
    }

    /**
     * Imposta il nome della sotto-pagina corrente
     * @param string $pag
     */
    public function setSottoPagina($pag) {
        $this->sottoPagina = $pag;
    }

    /**
     * Restituisce il contenuto del messaggio di conferma
     * @return string
     */
    public function getMessaggioConferma() {
        return $this->messaggioConferma;
    }

    /**
     * Imposta il contenuto del messaggio di conferma
     * @param string $msg
     */
    public function setMessaggioConferma($msg) {
        $this->messaggioConferma = $msg;
    }

    /**
     * Restituisce il nome della pagina corrente
     * @return string
     */
    public function getPagina() {
        return $this->pagina;
    }

    /**
     * Imposta il nome della pagina corrente
     * @param string $pagina
     */
    public function setPagina($pagina) {
        $this->pagina = $pagina;
    }

}

?>
