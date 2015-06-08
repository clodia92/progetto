<?php

include_once 'User.php';
include_once 'Cliente.php';
include_once 'Venditore.php';
include_once basename(__DIR__) . '/../database/Database.php';
//include_once 'Transazione.php';


class UserFactory {

    /**
     * Costruttore
     */
    private function __construct() {
        
    }

    /**
     * Carica un utente tramite username e password
     * @param string $username
     * @param string $password
     * @return Cliente/Venditore
     */

    public static function loadUser($username, $password) {
    
        $query=queryCercaUtente($username, $password);
        //Avvia la procedura di lettura e salva il risultato
        $mysqli = avviaDatabase();
        $result = avviaQuery($query, $mysqli);
        chiudiDatabase($mysqli);

        $row = $result->fetch_row();

        if(isset($row[0])){ // questo controllo serve a verificare se l'utente è stato realmente trovato nel database

            switch ($row[2]){
                case "cliente":
                    $toRet = new Cliente();
                    $toRet->setRuolo(User::Cliente);
                    break;
                case "venditore":
                    $toRet = new Venditore();
                    $toRet->setRuolo(User::Venditore);
                    break;
            }
            $toRet->setUsername($username);
            $toRet->setPassword($password);
            $toRet->setNome($row[3]);
            $toRet->setCognome($row[4]);
            $toRet->setEmail($row[5]);
            $toRet->setCitta($row[6]);
            $toRet->setVia($row[7]);
            $toRet->setCivico($row[8]);
            $toRet->setCap($row[9]);
            $toRet->setProvincia($row[10]);
            $toRet->setCredito($row[11]);
            return $toRet;

        }
        

    }
    
    /**
     * Imposta il credito per un determinato utente
     * @param String $user
     * @param Decimal $credito
     */
    public function salvaCredito ($user, $credito){
        $query=querySetCredito($user, $credito);
        //Avvia la procedura di lettura e salva il risultato
        $mysqli = avviaDatabase();
        avviaQuery($query, $mysqli);
        chiudiDatabase($mysqli);
    }
    
    /**
     * Recupera il credito di un determinato utente
     * @param String $user
     * @return Decimal
     */
    public function recuperaCredito($user) {
        $query=queryGetCredito($user);
        $mysqli = avviaDatabase();
        $result = avviaQuery($query, $mysqli);
        $row = $result->fetch_row();
        $credito=$row[0];
        chiudiDatabase($mysqli);
        return $credito;
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
    public function addTransazione($cliente, $venditore, $marca, $modello, $prezzo, $data){
        $query = queryAddTransazione($cliente, $venditore, $marca, $modello, $prezzo, $data);
        $mysqli = avviaDatabase();
        avviaQuery($query, $mysqli);
        chiudiDatabase($mysqli);
    }
    
    /**
     * Recupera la lista delle transazioni per un determinato utente
     * @param String $user
     * @return Array
     */
    public function creaStorico($user){
        $storico = array(); //Array che conterrà la lista delle transazioni
        $query = queryStorico($user); 
  
        //Avvia la procedura di lettura e salva il risultato
        $mysqli = avviaDatabase();
        $result = avviaQuery($query, $mysqli);
        chiudiDatabase($mysqli);	
	
        /*Il ciclo legge il risultato della query e salva i dati in array*/
	
  	
        while($row = $result->fetch_row())
        {
            $transazione = new Transazione();
            $transazione->setCliente($row[0]);
            $transazione->setVenditore($row[1]);
            $transazione->setMarca($row[2]);
            $transazione->setModello($row[3]);
            $transazione->setPrezzo($row[4]);
            $transazione->setData($row[5]);

            $storico[] = $transazione;
        }

        return $storico;
    }
    
    /**
     * Aggiornamento dei dati di un utente
     * @param String $username
     * @param Array
     */
    public function aggiornaDatiUser($username, $dati){
        $query = queryAggiornaDati($username, $dati); 
  
        //Avvia la procedura di lettura e salva il risultato
        $mysqli = avviaDatabase();
        avviaQuery($query, $mysqli);
        chiudiDatabase($mysqli);	
    }
    
    /**
     * Aggiornamento della password di un utente
     * @param String $user
     * @param String $newPass
     */
    public function aggiornaPassword($user, $newPass){
        $query = queryAggiornaPassword($user, $newPass); 
  
        //Avvia la procedura di lettura e salva il risultato
        $mysqli = avviaDatabase();
        avviaQuery($query, $mysqli);
        chiudiDatabase($mysqli);
    }
}
?>