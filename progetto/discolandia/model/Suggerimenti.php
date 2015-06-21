<?php
/**

 */

include_once '../Database.php';
$valore=$_GET['valore'];
$dischi=  array();
//Avvia la procedura di lettura e salva il risultato
    $mysqli = avviaDatabase();
    $query="SELECT `titolo`, `artista` FROM `Disco` WHERE `artista` LIKE ? OR `titolo` LIKE ? LIMIT 5";
    
    $stmt= $mysqli->stmt_init();
    // preparo lo statement per l'esecuzione
    $stmt->prepare($query);
    // collego i parametri della querycon il loro tipo
    $stmt->bind_param("ss", $valore, $valore);
    // eseguiamo la query
    $stmt->execute();
    // collego i risultati della query con un insieme di variabili
    $stmt->bind_result($titolo, $artista);
    // ciclo sulle righe che la query ha restituito

    while($stmt->fetch()){
        // ho nelle varibilidei risultati il contenuto delle colonne
        
        $dischi[] = $titolo . " - " . $artista;
    }

    // liberiamo le risorse dello statement
    $stmt->close();


Database::chiudiDatabase($mysqli);
    
    
    echo json_encode($dischi);
?>