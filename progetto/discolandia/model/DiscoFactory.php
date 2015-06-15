<?php
/*
*/
include_once basename(__DIR__) . '/../model/Disco.php';
include_once basename(__DIR__) . '/../model/TracciaFactory.php';
include_once basename(__DIR__) . '/../database/Database.php';
include_once basename(__DIR__) . '/../database/Query.php';

class DiscoFactory{
public function __construct() {
        parent::__construct();
    }



public function creaCatalogo(){
    
    //Avvio il database
    $mysqli=Database::avviaDatabase();
   
    $query=getQuery('catalogo');
    $risultato = Database::lanciaQuery($query, $mysqli);
    Database::chiudiDatabase($mysqli);
	
    /*Il ciclo legge il risultato della query e salva i dati in array*/
	
    while($row = $risultato->fetch_row())
    {
        $disco = new Disco();
        $disco->setCodDisco($row[0]);
        $disco->setTitolo($row[1]);
        $disco->setArtista($row[2]);
        $disco->setGenere($row[3]);
        $disco->setDescrizione($row[4]);
        $disco->setEtichetta($row[5]);
        $disco->setImmagine($row[6]);
        $disco->setAnno($row[7]);
        $disco->setPrezzo($row[8]);
        $disco->setDisponibili($row[9]);
       
        $disco->setTracce(TracciaFactory::listaTracce($row[0]));
        $dischi[] = $disco;
    }
        
        
    return $dischi;
}

/*Restituisce l'oggetto Disco richiesto tramite codice*/
public function getDisco($codDisco){
    
    //Avvio il database
    $mysqli=Database::avviaDatabase();
    $query=getQuery('disco', $codDisco);
    $risultato = Database::lanciaQuery($query, $mysqli);
    Database::chiudiDatabase($mysqli);

    $row = $risultato->fetch_row();

    $disco = new Disco();
    $disco->setCodDisco($row[0]);
    $disco->setTitolo($row[1]);
    $disco->setArtista($row[2]);
    $disco->setGenere($row[3]);
    $disco->setDescrizione($row[4]);
    $disco->setEtichetta($row[5]);
    $disco->setImmagine($row[6]);
    $disco->setAnno($row[7]);
    $disco->setPrezzo($row[8]);
    $disco->setDisponibili($row[9]);
    $disco->setTracce(TracciaFactory::listaTracce($row[0]));
    
    return $disco;
}


}
?>
