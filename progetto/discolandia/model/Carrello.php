<?php
include_once basename(__DIR__) . '/../model/CartItem.php';
include_once basename(__DIR__) . '/../database/Database.php';

class Carrello{
public function __construct() {
        parent::__construct();
    }



public function getCarrello($idCliente){
    //Avvio il database
    $mysqli=Database::avviaDatabase();
   
    $query="SELECT * FROM `Carrello` WHERE `idCompratore`=" . $idCliente;
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

        $carrello[] = $cartItem;
    }
        
        
    return $carrello;
}

public function exist($idCliente, $codDisco){}
public function addToCart($idCliente, $codDisco){}
public function removeToTheCart($idCliente, $codDisco){}
public function itemPlus($idCliente, $codDisco){}




}