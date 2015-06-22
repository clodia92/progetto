<?php
include_once 'User.php';
include_once 'Cliente.php';
include_once 'Venditore.php';

//Classe che comunica cn il Database per la gestione degli utenti
class UserFactory {

    /**
     * Costruttore
     */
    private function __construct() {
        
    }

    //Carica un utente tramite User e Pass
    //Utilizzo i Prepared Statements per evitare problemi di SQL injection
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
    
    //Salva il credito di un utente
    public function salvaCredito ($user, $credito){
        $query="UPDATE `Utente` SET `credito` = '". $credito . "' WHERE user = '". $user."'";
        //Avvia la procedura di lettura e salva il risultato
        $mysqli = Database::avviaDatabase();
        Database::lanciaQuery($query, $mysqli);
        Database::chiudiDatabase($mysqli);
    }
    
    //Salva il credito di un utente(Dentro una transazione)
    public function modificaCredito ($idUtente, $credito, $mysqli){
        $query="UPDATE `Utente` SET `credito` = '". $credito . "' WHERE idUtente = '". $idUtente."'";
        Database::lanciaQuery($query, $mysqli);
    }
    
    //Restituisce il credito di un utente
    public function getCreditoById($idUtente, $mysqli){
        $query= "SELECT `credito` FROM `Utente` WHERE `idUtente` = '".$idUtente."'";
        $risultato=  Database::lanciaQuery($query, $mysqli);
        $row = $risultato->fetch_row();
        $credito=$row[0];
        return $credito;
    }
    

    //modifica i dati di un utente
    //Utilizzo i Prepared Statements per evitare problemi di SQL injection
    public function modificaDati($id, $dati){
       
        $query = "UPDATE `Utente` SET `email`= ? , `via`= ?, `civico`= ?, `citta`= ?, `provincia`= ?, `cap`= ? WHERE `idUtente`=?";
  
        $mysqli = Database::avviaDatabase();
        
        $stmt= $mysqli->stmt_init();
        // preparo lo statement per l'esecuzione
        $stmt->prepare($query);
       
        // collego i parametri della querycon il loro tipo
        $stmt->bind_param('ssisssi', $dati['email'], $dati['via'], $dati['civico'], $dati['citta'], $dati['provincia'], $dati['cap'], $id);
        // eseguiamo la query
        $stmt->execute();
         // liberiamo le risorse dello statement
        $stmt->close();

        Database::chiudiDatabase($mysqli);
    }
    
    //Modifica della password di un utente
    //Utilizzo i Prepared Statements per evitare problemi di SQL injection
    public function modificaPassword($id, $newPass){
        
       $query = "UPDATE `Utente` SET `pass`= ? WHERE `idUtente`=?";
  
        $mysqli = Database::avviaDatabase();
        
        $stmt= $mysqli->stmt_init();
        // preparo lo statement per l'esecuzione
        $stmt->prepare($query);
        // collego i parametri della querycon il loro tipo
        $stmt->bind_param('si', $newPass, $id);
        // eseguiamo la query
        $stmt->execute();
         // liberiamo le risorse dello statement
        $stmt->close();

        Database::chiudiDatabase($mysqli);
    }
}
?>