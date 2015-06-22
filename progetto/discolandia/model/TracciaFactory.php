<?php
include_once basename(__DIR__) . '/../model/Traccia.php';

//Classe che comunica con il Database per la gestione delle tracce
class TracciaFactory{
public function __construct() {
        parent::__construct();
    }


//Recuoera la lista delle tracce per un determinato disco
public function listaTracce($codDisco){
    
    //Avvio il database
    $mysqli=Database::avviaDatabase();
    $query = "SELECT * FROM `Traccia` WHERE `codDisco`=" . $codDisco. " ORDER BY `numero`";
    $risultato = Database::lanciaQuery($query, $mysqli);
    Database::chiudiDatabase($mysqli);
    $tracce = array();
	
    /*Il ciclo legge il risultato della query e salva i dati in array*/
           
        while($row = $risultato->fetch_row())
        {
            $traccia = new Traccia();
            $traccia->setCodTraccia($row[0]);
            $traccia->setNumero($row[1]);
            $traccia->setTitolo($row[2]);
            $traccia->setCodDisco($row[3]);

            $tracce[] = $traccia;
        }
        
        
    return $tracce;
}

//Aggiunta di una nuova traccia
public function aggiungiTracce($codDisco, $tracce){
    $i=1;
    $mysqli=Database::avviaDatabase();
    foreach ($tracce as $traccia){
        
        $query = "INSERT INTO `Traccia` (`numero`,`titolo`,`codDisco`) "
                . "VALUES ('".$i."','".$traccia."','".$codDisco."')";
        Database::lanciaQuery($query, $mysqli);
        $i=$i+1;
    }
    Database::chiudiDatabase($mysqli);
    return TRUE;
}

//Rimazione di tutte le tracce di un disco
public function rimuoviTracce($codDisco){
    $mysqli=Database::avviaDatabase(); 
    $query = "DELETE FROM `Traccia` WHERE `codDisco` = '" . $codDisco ."'"; 
    Database::lanciaQuery($query, $mysqli);
    Database::chiudiDatabase($mysqli);
}

}
?>