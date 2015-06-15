<?php
/*
*/

include_once basename(__DIR__) . '/../model/Traccia.php';

class TracciaFactory{
public function __construct() {
        parent::__construct();
    }



public function listaTracce($codDisco){
    
    //Ho cancellato la definizione di trecce=array();

    //Avvio il database
    $mysqli=Database::avviaDatabase();
    $queryTraccia = "SELECT * FROM `Traccia` WHERE `codDisco`=" . $codDisco. " ORDER BY `numero`";
    $risultato = Database::lanciaQuery($queryTraccia, $mysqli);
    Database::chiudiDatabase($mysqli);
	
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
}
?>