<?php
include_once basename(__DIR__) . '/../model/CartItem.php';
include_once basename(__DIR__) . '/../database/Database.php';

//Classe carrello che comunica con il Database
class Carrello{
public function __construct() {
        parent::__construct();
    }


//Funzione che recupera i dati dal Database e restituisce
//un array di "CartItem"
public function getCarrello($idCliente){
    //Avvio il database
    $mysqli=Database::avviaDatabase();
    
    $query="SELECT `idCompratore`, `Carrello`.`codDisco`, "
            . "`Carrello`.`quantita`, `titolo`, `prezzo`, `idVenditore` "
            . "FROM `Carrello` JOIN `Disco` ON `Disco`.`codDisco` = `Carrello`.`codDisco` "
            . "JOIN `Catalogo` ON `Catalogo`.`codDisco` = `Carrello`.`CodDisco` "
            . "WHERE `idCompratore`='" . $idCliente."'";
    
    $risultato = Database::lanciaQuery($query, $mysqli);
    Database::chiudiDatabase($mysqli);

    $carrello = array();
    
    /*Il ciclo legge il risultato della query e salva i dati in array*/
	
    while($row = $risultato->fetch_row())
    {
        $cartItem = new CartItem();
        $cartItem->setIdCompratore($row[0]);
        $cartItem->setCodDisco($row[1]);
        $cartItem->setQuantita($row[2]);
        $cartItem->setTitolo($row[3]);
        $cartItem->setPrezzo($row[4]);
        $cartItem->setIdVenditore($row[5]);
        $carrello[] = $cartItem;
    }
        
        
    return $carrello;
}

//Controlla se il disco è già presente nel carrello. In caso di esito positivo restituisce la qta
public function exist($idCliente, $codDisco){
     //Avvio il database
    $mysqli=Database::avviaDatabase();
   
    $query="SELECT `quantita` FROM `Carrello` WHERE `idCompratore`='" . $idCliente . "' AND `codDisco`='" . $codDisco ."'";
    $risultato = Database::lanciaQuery($query, $mysqli);
    Database::chiudiDatabase($mysqli);
    
    if(isset($risultato) && count($risultato)>0)
    {
        $row = $risultato->fetch_row();
         return ($row[0]);
    }
    else 
        return 0;
}

//Funzione per l'aggiunta di un disco al carrello
public function addToCart($idCliente, $codDisco){

    //controllo se l'elemento è già nel carrello
    $qta = Carrello::exist($idCliente, $codDisco);
    if($qta>0)
    {
        $query="UPDATE `Carrello` SET `quantita`='". ($qta+1) ."' WHERE `codDisco` = '".$codDisco."'";
    }
    else
    {
        $qta=1;
        $query="INSERT INTO `Carrello`(`idCompratore`,`codDisco`,`quantita`) VALUES ('".$idCliente."','".$codDisco."','".$qta."')";
    }
    
    $mysqli=Database::avviaDatabase();
    Database::lanciaQuery($query, $mysqli);
    Database::chiudiDatabase($mysqli);
    
}

//Funzione per la rimozione di un disco dal carrello
public function removeToCart($idCliente, $codDisco){

    $query = "DELETE FROM `Carrello` WHERE `idCompratore` ='". $idCliente . "' AND `codDisco` = '" . $codDisco ."'";
    $mysqli=Database::avviaDatabase();
    Database::lanciaQuery($query, $mysqli);
    Database::chiudiDatabase($mysqli);
    
}

//Svuota il carrello per un Cliente
//Le operazioni di apertura e chiusura del database sono all'interno della transazione
public function rimuoviElementi($idCliente, $codDisco, $mysqli){

    $query = "DELETE FROM `Carrello` WHERE `idCompratore` ='". $idCliente . "' AND `codDisco` = '" . $codDisco ."'";

    Database::lanciaQuery($query, $mysqli);

    
}

}