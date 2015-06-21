<?php
include_once 'User.php';
include_once 'Cliente.php';
include_once 'Venditore.php';
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
                $toRet->setId($idUtente);
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
        $query="UPDATE `Utente` SET `credito` = '". $credito . "' WHERE user = '". $user."'";
        //Avvia la procedura di lettura e salva il risultato
        $mysqli = Database::avviaDatabase();
        Database::lanciaQuery($query, $mysqli);
        Database::chiudiDatabase($mysqli);
    }
    
    public function modificaCredito ($idUtente, $credito, $mysqli){
        $query="UPDATE `Utente` SET `credito` = '". $credito . "' WHERE idUtente = '". $idUtente."'";
        Database::lanciaQuery($query, $mysqli);
    }
    
    public function getCreditoById($idUtente, $mysqli){
        $query= "SELECT `credito` FROM `Utente` WHERE `idUtente` = '".$idUtente."'";
        $risultato=  Database::lanciaQuery($query, $mysqli);
        $row = $risultato->fetch_row();
        $credito=$row[0];
        return $credito;
    }
    


    /**
     * Aggiornamento dei dati di un utente
     * @param String $username
     * @param Array
     */
    public function modificaDati($id, $dati){
        
        $query = "UPDATE `Utenti` SET `email`=? , `via`=?, `num`=?, `citta`=?, `provincia`=?, `cap`=? WHERE `idUtente`=?";
  
        $mysqli = Database::avviaDatabase();
        
        $stmt= $mysqli->stmt_init();
        // preparo lo statement per l'esecuzione
        $stmt->prepare($query);
        // collego i parametri della querycon il loro tipo
        $stmt->bind_param('sssssss', $dati['email'], $dati['via'], $dati['num'], $dati['citta'], $dati['provincia'], $dati['cap'], $id);
        // eseguiamo la query
        $stmt->execute();
         // liberiamo le risorse dello statement
        $stmt->close();

        Database::chiudiDatabase($mysqli);
    }
    
    /**
     * Aggiornamento della password di un utente
     * @param String $user
     * @param String $newPass
     */
    public function modificaPassword($id, $newPass){
        
       
    }
}
?>