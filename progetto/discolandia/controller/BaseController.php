<?php

include_once basename(__DIR__) . '/../view/ViewDescriptor.php';
include_once basename(__DIR__) . '/../model/User.php';
include_once basename(__DIR__) . '/../model/UserFactory.php';

/**
 * Controller che gestisce gli utenti non autenticati e fornisce funzionalita'
 * comuni agli altri controller.
 */

class BaseController {

    const user = 'user';

    /**
     * Costruttore 
     */
    public function __construct() {
        
    }

    /**
     * Metodo per gestire l'input dell'utente. Le sottoclassi lo sovrascrivono
     * @param type $request la richiesta da gestire
     * @param type $session array con le variabili di sessione
     */
    public function handleInput(&$request, &$session) {
        // creo il descrittore della vista
        $vd = new ViewDescriptor();

        // imposto la pagina
        $vd->setPagina($request['page']);

        /**
         * gestione dei comandi
         *
         * tutte le variabili che vengono create senza essere utilizzate 
         * direttamente in questo switch, sono quelle che vengono poi lette
         * dalla vista, ed utilizzano le classi del modello
        */
        if (isset($request["cmd"])) { // se viene ricevuto un comando
            
            switch ($request["cmd"]) {
                case 'login':
                    $username = isset($request['user']) ? $request['user'] : '';
                    $password = isset($request['password']) ? $request['password'] : '';
                    $this->login($vd, $username, $password);
                    // questa variabile viene poi utilizzata dalla vista
                    if ($this->loggedIn())
                        $user = $_SESSION[self::user];
                    break;
                default : $this->showLoginPage();
            }
        } else {
            if ($this->loggedIn()) {
                // utente autenticato
                // questa variabile viene poi utilizzata dalla vista
                $user = $_SESSION[self::user];
                $this->showHomeUtente($vd);
            } else {
                // utente non autenticato
                $this->showLoginPage($vd);
            }
        }

        // richiamo la vista
        require basename(__DIR__) . '/../view/master.php';
    }

    /**
     * Restituisce l'array contentente la sessione per l'utente corrente 
     * Le sottoclassi lo sovrascrivono
     * @return array
     */
    public function &getSessione() {
        return $_SESSION;
    }

    /**
     * Verifica se l'utente sia correttamente autenticato
     * @return boolean true se l'utente era gia' autenticato, false altrimenti
     */
    protected function loggedIn() {
        return isset($_SESSION) && array_key_exists(self::user, $_SESSION);
    }

    /**
     * Imposta la vista master.php per visualizzare la pagina di login
     * @param ViewDescriptor $vd il descrittore della vista
     */
    protected function showLoginPage($vd) {
        // mostro la pagina di login
        $vd->setTitolo("Login");
        $vd->setHeaderFile(basename(__DIR__) . '/../view/login/header.php');
        $vd->setLeftBarFile(basename(__DIR__) . '/../view/login/leftBar.php');
        $vd->setRightBarFile(basename(__DIR__) . '/../view/login/rightBar.php');
        $vd->setContentFile(basename(__DIR__) . '/../view/login/content.php');
    }

    /**
     * Imposta la vista master.php per visualizzare la pagina home del cliente
     * @param ViewDescriptor $vd il descrittore della vista
     */
    protected function showHomeCliente($vd) {
        // mostro la home del cliente
        $vd->setTitolo("Pannello Cliente");
        $vd->setHeaderFile(basename(__DIR__) . '/../view/cliente/header.php');
        $vd->setLeftBarFile(basename(__DIR__) . '/../view/cliente/leftBar.php');
        $vd->setRightBarFile(basename(__DIR__) . '/../view/cliente/rightBar.php');
        $vd->setContentFile(basename(__DIR__) . '/../view/cliente/content.php');
    }

     /**
     * Imposta la vista master.php per visualizzare la pagina home del venditore
     * @param ViewDescriptor $vd il descrittore della vista
     */
    protected function showHomeVenditore($vd) {
        // mostro la home del venditore
        $vd->setTitolo("Pannello Venditore");
        $vd->setHeaderFile(basename(__DIR__) . '/../view/venditore/header.php');
        $vd->setLeftBarFile(basename(__DIR__) . '/../view/venditore/leftBar.php');
        $vd->setRightBarFile(basename(__DIR__) . '/../view/venditore/rightBar.php');
        $vd->setContentFile(basename(__DIR__) . '/../view/venditore/content.php');
    }

    
    
    
     /**
     * Seleziona quale pagina mostrare in base al ruolo dell'utente corrente
     * @param ViewDescriptor $vd il descrittore della vista
     */
    protected function showHomeUtente($vd) {
        $user = $_SESSION[self::user];
        switch ($user->getRuolo()) {
            case User::Cliente:
                $this->showHomeCliente($vd);
                break;

            case User::Venditore:
                $this->showHomeVenditore($vd);
                break;
        }
    }

    /**
     * Procedura di autenticazione 
     * @param ViewDescriptor $vd descrittore della vista
     * @param string $username lo username specificato
     * @param string $password la password specificata
     */
    protected function login($vd, $username, $password) {
        // carichiamo i dati dell'utente

        $user = UserFactory::loadUser($username, $password); // carica i dati dell'utente solo se questo è presente nel DB
        if (isset($user)) {
            // utente autenticato
            $_SESSION[self::user] = $user;
            $this->showHomeUtente($vd);
        } else {
            $vd->setMessaggioErrore("Utente sconosciuto o password errata");
            $this->showLoginPage($vd);
        }
    }

    /**
     * Procedura di logout dal sistema 
     * @param type $vd il descrittore della pagina
     */
    protected function logout($vd) {
        // reset array $_SESSION
        $_SESSION = array();
        // termino la validita' del cookie di sessione
        if (session_id() != '' || isset($_COOKIE[session_name()])) {
            // imposto il termine di validita' al mese scorso
            setcookie(session_name(), '', time() - 2592000, '/');
        }
        // distruggo il file di sessione
        session_destroy();
        $this->showLoginPage($vd);
    }

    /**
     * Aggiorno indirizze e e-mail di un utente
     * @param User $user l'utente da aggiornare
     * @param array $dati i nuovi dati dell'utente
     */
    protected function aggiornaIndirizzo($user, &$request, &$msg) {

        if (isset($request['via'])) {
            if (!$user->setVia($request['via'])) {
                $msg[] = '<li>La via specificata non &egrave; corretta</li>';
            }
        }
        if (isset($request['civico'])) {
            if (!$user->setNumeroCivico($request['civico'])) {
                $msg[] = '<li>Il formato del numero civico non &egrave; corretto</li>';
            }
        }
        if (isset($request['citta'])) {
            if (!$user->setCitta($request['citta'])) {
                $msg[] = '<li>La citt&agrave; specificata non &egrave; corretta</li>';
            }
        }
        if (isset($request['provincia'])) {
            if (!$user->setProvincia($request['provincia'])) {
                $msg[] = '<li>La provincia specificata &egrave; corretta</li>';
            }
        }
        if (isset($request['cap'])) {
            if (!$user->setCap($request['cap'])) {
                $msg[] = '<li>Il CAP specificato non &egrave; corretto</li>';
            }
        }
        UserFactory::aggiornaIndirizzo($user->getUsername(), $dati); // aggiorna i dati nel DataBase
    }
    
    /**
     * Aggiorno l'indirizzo email di un utente
     * @param User $user l'utente da aggiornare
     * @param array $request la richiesta http da gestire
     * @param array $msg riferimento ad un array da riempire con eventuali
     * messaggi d'errore
     */
    protected function aggiornaEmail($user, &$request, &$msg) {
        if (isset($request['email'])) {
            if (!$user->setEmail($request['email'])) {
                $msg[] = '<li>L\'indirizzo email specificato non &egrave; corretto</li>';
            }
            else
            {
                UserFactory::aggiornaEmail($user->getUsername(), $email); // aggiorna email nel db
            }
        }
    }    
    


    /**
     * Aggiorno la password di un utente
     * @param User $user l'utente da aggiornare
     * @param array $request la richiesta http da gestire
     * @return boolean Vero se l'aggiornamento è andato a buon fine,
     * Falso altrimenti
     */
    protected function aggiornaPassword($user, &$request) {
        if (isset($request['pass1']) && isset($request['pass2'])) {
            if ($request['pass1'] == $request['pass2']) {
                UserFactory::aggiornaPassword($user->getUsername(), $request['pass1']); // aggiorna la password nel DataBase
                $user->setPassword($request['pass1']); // aggiorna i dati nella classe
                return TRUE;
            }
            else
            return FALSE;
                
        }
    }

    /**
     * Crea un messaggio di feedback per l'utente 
     * @param array $msg lista di messaggi di errore
     * @param ViewDescriptor $vd il descrittore della pagina
     * @param string $okMsg il messaggio da mostrare nel caso non ci siano errori
     */
    protected function creaFeedbackUtente(&$msg, $vd, $okMsg) {
        if (count($msg) > 0) {
            // ci sono messaggi di errore nell'array,
            // qualcosa e' andato storto...
            $error = "Si sono verificati i seguenti errori \n<ul>\n";
            foreach ($msg as $m) {
                $error = $error . $m . "\n";
            }
            // imposto il messaggio di errore
            $vd->setMessaggioErrore($error);
        } else {
            // non ci sono messaggi di errore, la procedura e' andata
            // quindi a buon fine, mostro un messaggio di conferma
            $vd->setMessaggioConferma($okMsg);
        }
    }

}
