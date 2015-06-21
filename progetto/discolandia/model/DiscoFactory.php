<?php
/*
*/
include_once basename(__DIR__) . '/../model/Disco.php';
include_once basename(__DIR__) . '/../model/TracciaFactory.php';
include_once basename(__DIR__) . '/../database/Database.php';


class DiscoFactory{
public function __construct() {
        parent::__construct();
    }



public function creaCatalogo(){
    
    //Avvio il database
    $mysqli=Database::avviaDatabase();
   
    $query="SELECT * FROM `Disco` JOIN `Catalogo` ON `Disco`.`codDisco` = `Catalogo`.`codDisco` WHERE 1";
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
        $disco->setPrezzo($row[10]);
        $disco->setDisponibili($row[11]);
       
        $disco->setTracce(TracciaFactory::listaTracce($row[0]));
        $dischi[] = $disco;
    }
        
    if(isset($dischi))
        return $dischi;
    else
        return 0;
}

/*Restituisce l'oggetto Disco richiesto tramite codice*/
public function getDisco($codDisco){
    
    //Avvio il database
    $mysqli=Database::avviaDatabase();
    $query="SELECT * FROM `Disco` JOIN `Catalogo` ON `Disco`.`codDisco` = `Catalogo`.`codDisco` WHERE `Catalogo`.`codDisco`=" . $codDisco;
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
    $disco->setPrezzo($row[10]);
    $disco->setDisponibili($row[11]);
    $disco->setTracce(TracciaFactory::listaTracce($row[0]));
    
    return $disco;
}


public function aggiungiDisco($disco){
    //Avvio il database
    $mysqli=Database::avviaDatabase();
    
    
    $query="INSERT INTO `Disco`(`codDisco`,`titolo`,"
            . "`artista`,`genere`,`descrizione`,`etichetta`,`immagine`,`anno`) "
            . "VALUES ('".$disco['codDisco']."','".$disco['titolo']."',"
            . "'".$disco['artista']."','".$disco['genere']."',"
            . "'".$disco['descrizione']."','".$disco['etichetta']."',"
            . "'".$disco['immagine']."','".$disco['anno']."')";
    
    Database::lanciaQuery($query, $mysqli);
    
    $query="INSERT INTO `Catalogo` (`idVenditore`,`codDisco`,`prezzo`,`quantita`) "
            . "VALUES ('".$disco['venditore']."','".$disco['codDisco']."',"
            . "'".$disco['prezzo']."','".$disco['quantita']."')";
    Database::lanciaQuery($query, $mysqli);
    
    Database::chiudiDatabase($mysqli);
    
    return TRUE;
}


public function modificaDisponibilita($codDisco, $disponibilita, $mysqli){
    
    $query="UPDATE `Catalogo` SET `quantita`='". $disponibilita ."' WHERE `codDisco` = '".$codDisco."'";
    Database::lanciaQuery($query, $mysqli);
    
}

public function leggiDisp($codDisco, $mysqli){
    $query="SELECT `quantita` FROM `Catalogo` WHERE `codDisco` = '".$codDisco."'";
    $risultato=Database::lanciaQuery($query, $mysqli);
    $row = $risultato->fetch_row();
    return ($row[0]);
}


public function creaCatalogoRicerca($param){
    $parametro= "%".$param."%";
    //Avvio il database
    $mysqli=Database::avviaDatabase();
   
    $query="SELECT * FROM `Disco` JOIN `Catalogo` "
            . "ON `Disco`.`codDisco` = `Catalogo`.`codDisco` "
            . "WHERE `titolo` LIKE ? OR `artista` LIKE ?";
   
    $stmt= $mysqli->stmt_init();
        // preparo lo statement per l'esecuzione
        $stmt->prepare($query);
        // collego i parametri della querycon il loro tipo
        $stmt->bind_param("ss", $parametro, $parametro);
        // eseguiamo la query
        $stmt->execute();
        // collego i risultati della query con un insieme di variabili
        $stmt->bind_result($codDisco, $titolo, $artista, $genere, $descrizione, $etichetta, $immagine, $anno, $idVenditore, $codDisco2, $prezzo, $disponibili);
        // ciclo sulle righe che la queryha restituito
        //if(isset($codDisco)){
            while($stmt->fetch()){
                // ho nelle varibilidei risultati il contenuto delle colonne
                $disco = new Disco();
                $disco->setCodDisco($codDisco);
                $disco->setTitolo($titolo);
                $disco->setArtista($artista);
                $disco->setGenere($genere);
                $disco->setDescrizione($descrizione);
                $disco->setEtichetta($etichetta);
                $disco->setImmagine($immagine);
                $disco->setAnno($anno);
                $disco->setPrezzo($prezzo);
                $disco->setDisponibili($disponibili);

                $disco->setTracce(TracciaFactory::listaTracce($codDisco));
                $dischi[] = $disco;
                
               
            }
        //}
        // liberiamo le risorse dello statement
        $stmt->close();
    
    
    Database::chiudiDatabase($mysqli);
	
  
    if(isset($dischi))
        return $dischi;
    else
        return 0;
}

public function creaCatalogoGenere($param){
    
    //Avvio il database
    $mysqli=Database::avviaDatabase();
   
    $query="SELECT * FROM `Disco` JOIN `Catalogo` "
            . "ON `Disco`.`codDisco` = `Catalogo`.`codDisco` "
            . "WHERE `genere` = '".$param."'";
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
            $disco->setPrezzo($row[10]);
            $disco->setDisponibili($row[11]);

            $disco->setTracce(TracciaFactory::listaTracce($row[0]));
            $dischi[] = $disco;
        }

        if(isset($dischi))
            return $dischi;
        else
            return 0;
    
}


}
?>
