<?php

include_once 'User.php';
include_once 'Cliente.php';
include_once 'Venditore.php';
include_once basename(__DIR__) . '/../database/Database.php';
include_once basename(__DIR__) . '/../database/Query.php';
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

    public static function caricaUtente($user, $pass) {
    

        $query="SELECT * FROM Utente WHERE user = ? and pass = ?";
        //Avvia la procedura di lettura e salva il risultato
        $mysqli = Database::avviaDatabase();
        
        $stmt= $mysqli->stmt_init();
        // preparo lo statement per l'esecuzione
        $stmt->prepare($query);
        // collego i parametri della querycon il loro tipo
        $stmt->bind_param("ss", $user, $pass);
        // eseguiamo la query
        $stmt->execute();
        // collego i risultati della query con un insieme di variabili
        $stmt->bind_result($idUtente, $username, $password, $nome, $cognome, $ruolo, $email, $via, $civico, $citta, $cap, $provincia, $credito);
        // ciclo sulle righe che la queryha restituito
        if(isset($idUtente)){
            while($stmt->fetch()){
                // ho nelle varibilidei risultati il contenuto delle colonne
                switch ($ruolo){
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
                $toRet->setNome($nome);
                $toRet->setCognome($cognome);
                $toRet->setEmail($email);
                $toRet->setCitta($citta);
                $toRet->setVia($via);
                $toRet->setCivico($civico);
                $toRet->setCap($cap);
                $toRet->setProvincia($provincia);
                $toRet->setCredito($credito);
                return $toRet;

            }
        }
        // liberiamo le risorse dello statement
        $stmt->close();
        
        
        
        
        
        
        Database::chiudiDatabase($mysqli);

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