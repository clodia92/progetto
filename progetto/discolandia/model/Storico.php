<?php
include_once 'Transazione.php';

//Classe che comunica con il database per la gestione degli ordini effettuati
class Storico {

    /**
     * Costruttore
     */
    private function __construct() {
        
    }

    //Aggiunge una nuova transazione
    public function addTransazione($idCompratore, $idVenditore, $codDisco, $data, $prezzo, $quantita){
        $query = "INSERT INTO `Storico`(`idCompratore`, `idVenditore`, `codDisco`, `data`, `prezzo`, `quantita`) "
                . "VALUES ('".$idCompratore."','".$idVenditore."','".$codDisco."','".$data."','".$prezzo."','".$quantita."')";
                
        $mysqli = Database::avviaDatabase();
        Database::lanciaQuery($query, $mysqli);
        Database::chiudiDatabase($mysqli);
    }
    
    //Recupera le transazioni per un determinato utente
    public function getStorico($id){
        $storico = array(); //Array che conterrà la lista delle transazioni
        $query = "SELECT `idCompratore`,`idVenditore`,`Storico`.`codDisco`,"
                . "`Disco`.`titolo`,`data`,`prezzo`, `quantita` "
                . "FROM `Storico` JOIN `Disco` ON `Disco`.`codDisco` = `Storico`.`codDisco` "
                . "WHERE `idCompratore`='".$id."'";
  
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
            $transazione->setTitolo($row[3]);
            $transazione->setData($row[4]);
            $transazione->setPrezzo($row[5]);
            $transazione->setQuantita($row[6]);
            $storico[] = $transazione;
        }
        if(isset($storico))
            return $storico;
        else
            return 0;
    }
}
