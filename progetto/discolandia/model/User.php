<?php
include_once '../database/Database.php';

class User{
    /**
     * Username dell'utente
     * @var String
     */
    private $username;
    
    /**
     * Password dell'utente
     * @var String
     */
    private $password;
    
    /**
     * Nome dell'utente
     * @var String
     */
    private $nome;
    
    /**
     * Cognome dell'utente
     * @var String
     */
    private $cognome;
    
    /**
     * Indirizzo email dell'utente
     * @var String
     */
    private $email;
    
    /**
     * Citta' dell'utente
     * @var String
     */
    private $citta;
    
    /**
     * Via dell'utente
     * @var String
     */
    private $via;
    
    /**
     * Codice di avviamento postale dell'utente
     * @var String
     */
    private $cap;
    
    /**
     * Provincia dell'utente
     * @var String
     */
    private $provincia;
    
    /**
     * Credito disponibile per il Cliente o guadagno per il Venditore
     * @var String
     */
    private $credito;
    
    /**
     * Identificativo dell'utente
     * @var String
     */
    private $id;
    
    /**
     * Ruolo dell'utente
     * @var String
     */
    private $ruolo;

    const Cliente = 1;
    const Venditore = 2;
    
    /**
     * Costruttore
     */
    function __construct() {
        
    }
    
    /**
     * Restituisce lo Username dell'utente
     * @return type
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * Imposta lo username dell'utente
     * @param String $username
     * @return boolean
     */
    public function setUsername($username) {
        $this->username = $username;
        return true;
    }

    /**
     * Restituisce la password
     * @return String
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Imposta la password
     * @param String $password
     * @return boolean
     */
    public function setPassword($password) {
        $this->password = $password;
        return true;
    }
    
    /**
     * Restituisce il nome
     * @return String
     */
    public function getNome() {
        return $this->nome;
    }

    /**
     * Imposta il Nome
     * @param String $nome
     * @return boolean
     */
    public function setNome($nome) {
        $this->nome = $nome;
        return true;
    }

    /**
     * Restituisce il cognome
     * @return String
     */
    public function getCognome() {
        return $this->cognome;
    }

    /**
     * Imposta il cognome
     * @param String $cognome
     * @return boolean
     */
    public function setCognome($cognome) {
        $this->cognome = $cognome;
        return true;
    }
    
    /**
     * Restituisce l'email
     * @return String
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Imposta l'email
     * @param String $email
     * @return boolean
     */
    public function setEmail($email) {
        $this->email = $email;
        return true;
    }
    
    /**
     * Restituisce la citta'
     * @return String
     */
    public function getCitta() {
        return $this->citta;
    }

    /**
     * Imposta la citta'
     * @param String $citta
     * @return boolean
     */
    public function setCitta($citta) {
        $this->citta = $citta;
        return true;
    }

    /**
     * Restituisce la via
     * @return String
     */
    public function getVia() {
        return $this->via;
    }

    /**
     * Imposta la via
     * @param String $via
     * @return boolean
     */
    public function setVia($via) {
        $this->via = $via;
        return true;
    }
    
    /**
     * Restituisce il civico
     * @return String
     */
    public function getCivico() {
        return $this->civico;
    }

    /**
     * Imposta il civico
     * @param String $civico
     * @return boolean
     */
    public function setCivico($civico) {
        $this->civico = $civico;
        return true;
    }

    /**
     * Restituisce la provincia
     * @return String
     */
    public function getProvincia() {
        return $this->provincia;
    }

    /**
     * Imposta la provincia
     * @param String $provincia
     * @return boolean
     */
    public function setProvincia($provincia) {
        $this->provincia = $provincia;
        return true;
    }
    
    /**
     * Restituisce il cap
     * @return String
     */
    public function getCap() {
        return $this->cap;
    }

    /**
     * Imposta il cap
     * @param String $cap
     * @return boolean
     */
    public function setCap($cap) {
        if (!filter_var($cap, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/[0-9]{5}/')))) {
            return false;
        }
        $this->cap = $cap;
        return true;
    }

    /**
     * Restituisce l'id
     * @return type
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Imposta l'id
     * @param int $id
     * @return boolean
     */
    public function setId($id) {
        $intVal = filter_var($id, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if(isset($intVal)){
            $this->id = $intVal;
            return true;
        }
        
        return false;
    }
    
    /**
     * Restituisce il credito
     * @return Decimal
     */
    public function getCredito() {
        return $this->credito;
    }
    
    /**
     * Esegue operazioni sul credito
     * @param Decimal $valore Quantita' da sommare o detrarre
     * @param int $op identifica l'operazione da eseguire(1 per ricaricare - 0 per sotrarre)
     */
    public function changeCredito($valore, $op){
           
        if($op)// 1Ricarica - 0Sottrae
            $this->credito =  $this->credito + $valore;
        else
            $this->credito =  $this->credito - $valore;
    }

    /**
     * Imposta il credito
     * @param Decimal $credito
     * @return boolean
     */
    public function setCredito($credito){
        $this->credito = $credito;
        return true;
    }
    
    /**
     * Restituisce il ruolo
     * @return Int
     */
    public function getRuolo() {
        return $this->ruolo;
    }

    /**
     * Imposta un ruolo per un dato utente
     * @param int $ruolo
     * @return boolean true se il valore e' ammissibile ed e' stato impostato,
     * false altrimenti
     */
    public function setRuolo($ruolo) {
        switch ($ruolo) {
            case self::Cliente:
            case self::Venditore:
                $this->ruolo = $ruolo;
                return true;
            default:
                return false;
        }
    }
    
}

?>