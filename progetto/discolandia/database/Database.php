<?php
class Database{

    private $db_host ="localhost";
    private $db_user="porcuClaudia";
    private $db_password="pulcinella90";
    private $db_name="porcuClaudia";
    /**
     * Restituisce una connessione al db
     * @return \mysqli 
     */
    
    
    function avviaDatabase(){
        $mysqli = new mysqli();
        //$mysqli->connect($this->db_host, $this->db_user, $this->db_password, $this->db_name);
        $mysqli->connect("localhost", "porcuClaudia","pulcinella90", "porcuClaudia");
        // verifico la presenza di errori
	if($mysqli->connect_errno!= 0)
		{
	// gestione errore
		$idErrore= $mysqli->connect_errno;
		$msg= $mysqli->connect_error;
		error_log("Errore nella connessione al server $idErrore: $msg", 0);
		echo"Errore nella connessione $msg.";
		}
                return $mysqli;
    }
    
    function lanciaQuery($query, $mysqli){
			// nessun errore
	
	$risultato = $mysqli->query($query);
	if($mysqli->errno> 0)
	{
	// errore nella esecuzione della query(es. sintassi)
		error_log("Errore nella esecuzione della query $mysqli->errno: $mysqli->error", 0);
		echo"La query ha generato un errore";
	}
	else
	{
		// query eseguita correttamente
		return $risultato;
	}
    }
    
    function chiudiDatabase($mysqli){
       mysqli_close($mysqli);	
    }
}    
?>