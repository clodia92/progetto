<?php
include_once 'Transazione.php';
class Storico {

    /**
     * Costruttore
     */
    private function __construct() {
        
    }

/**
     * Aggiunge una transazione all'elenco degli acquisti effetuati
     * @param String $cliente Il cliente che ha effettuato l'acquisto
     * @param String $venditore Il proprietario del prodotto venduto
     * @param String $marca Marca del prodotto
     * @param String $modello Modello del prodotto
     * @param Decimal $prezzo 
     * @param DateTime $data
     */
    public function addTransazione($idCompratore, $idVenditore, $codDisco, $data, $prezzo){
        $query = "INSERT INTO `Storico`(`idCompratore`, `idVenditore`, `codDisco`, `data`, `prezzo`) "
                . "VALUES ('".$idCompratore."','".$idVenditore."','".$codDisco."','".$data."','".$prezzo."')";
                
        $mysqli = Database::avviaDatabase();
        Database::lanciaQuery($query, $mysqli);
        Database::chiudiDatabase($mysqli);
    }
    
    /**
     * Recupera la lista delle transazioni per un determinato utente
     * @param String $user
     * @return Array
     */
    public function getStorico($id){
        $storico = array(); //Array che conterrà la lista delle transazioni
        $query = "SELECT * FROM `Storico` WHERE `idCompratore`='".$id."'";
  
        //Avvia la procedura di lettura e salva il risultato
        $mysqli = Database::avviaDatabase();
        $result = Database::lanciaQuery($query, $mysqli);
        Database::chiudiDatabase($mysqli);	
	
        /*Il ciclo legge il risultato della query e salva i dati in array*/
        while($row = $result->fetch_row())
        {
            $transazione = new Transazione();
            $transazione->setIdCompratore($row[0]);
            $transazione->setIdVenditore($row[1]);
            $transazione->setCodDisco($row[2]);
            $transazione->setData($row[3]);
            $transazione->setPrezzo($row[4]);

            $storico[] = $transazione;
        }
        if(isset($storico))
            return $storico;
        else
            return 0;
    }
}
