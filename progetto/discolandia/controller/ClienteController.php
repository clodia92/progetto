<?php

include_once 'BaseController.php';
include_once basename(__DIR__) . '/../model/DiscoFactory.php';
include_once basename(__DIR__) . '/../model/Carrello.php';

/**
 * Controller che gestisce la modifica dei dati dell'applicazione relativa ai clienti
 */

class ClienteController extends BaseController {

    /**
     * Costruttore
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Metodo per gestire l'input dell'utente. 
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

        if (!$this->loggedIn()) {
            // utente non autenticato, rimando alla home
            $this->showLoginPage($vd);
            
        } else {
            // utente autenticato
            $user = $session[BaseController::user];
            
            //$carrello=new Carrello();

            /**
            * controllo la sottopagina richiesta e imposto il descrittore della
            * vista per caricare la sottopagina corretta.
            * tutte le variabili che vengono create senza essere utilizzate 
            * direttamente in questo switch, sono quelle che vengono poi lette
            * dalla vista, ed utilizzano le classi del modello
            */
            if (isset($request["subpage"])) {
                switch ($request["subpage"]) {
                    
                    // visualizzazione dei prodotti in vendita
                    case 'catalogo':
                    /*
                        // se nella richiesta e' presente il tipo vengono richiesti al DB solo i prodotti di quel tipo
                        if(isset($request['tipo'])){
                            $prodotti = ProdottoFactory::creaListaTipo($request['tipo']);
                        }
                        
                        // se nella richiesta e' presente un parametro vengono richiesti al DB solo i prodotti corrispondenti
                        if(isset($request['cerca'])){
                            $prodotti = ProdottoFactory::creaListaRicerca($request['cerca']);
                        }
                            else{ 
                            // se non e' presente parametro o tipo vengono richiesti al DB tutti i prodotti
                            $prodotti = CatalogoFactory::creaCatalogo();
                            } 
                        }
                     * 
                     */
                
                        $catalogo = DiscoFactory::creaCatalogo();
                        $vd->setSottoPagina('catalogo');
                        $vd->setTitolo("Catalogo Discolandia");
                        break;
                    
                    // visualizzazione della pagina del prodotto generata dinamicamente    
                    case 'disco':
                        
                        $disco = DiscoFactory::getDisco($request['cod']);
                        $vd->setSottoPagina('disco');
                        $vd->setTitolo($disco->getTitolo());
                        break;
                    
                    // visualizzazione del carrello del cliente
                    case 'carrello':
                        
                        $carrello = Carrello::getCarrello($user->getUsername()); // aggiorno la lista dei prodotti nel carrello
                        $vd->setSottoPagina('carrello');
                        $vd->setTitolo('Carrello');
                        break;
                    
                     // visualizzazione del profilo
                    case 'profilo':
                        $vd->setSottoPagina('profilo');
                        $vd->setTitolo("Profilo");
                        break;
                    
                    //visualizzazione della pagina per modificare il profilo
                    case 'modificaprofilo':
                        
                        $vd->setSottoPagina('modificaprofilo');
                        $vd->setTitolo("Modifica Profilo Discolandia");
                        break;
                    /*
                    // visualizzazone di una pagina di conferma dell'acquisto e gestione della transazione  
                    case 'conferma':
                        switch($request['pag'])
                        {
                            // visualizzazione di una pagina con il riepilogo dell'acquisto
                            case 'richiestaConferma':
                            break;
                        
                            // gestione dell'acquisto
                            case 'confermaOk':
                                $mysqli = avviaDatabase(); 
                                $mysqli->autocommit(false);
                                $tot=0;
                                
                                // procedo solo se il carrello non è vuoto
                                if(isset($listaCarrello) && count($listaCarrello)!=0){

                                    foreach ($listaCarrello as $elemento)
                                    {   

                                        $prodottoConferma = ProdottoFactory::getProdottoPerModelloNDB($elemento, $mysqli);
                                        // si procede solo se il prodotto è disponibile
                                        if($prodottoConferma->getDisp()>0){
                                            $prezzo=$prodottoConferma->getPrezzo(); 
                                            $tot+=$prezzo; // aggiungo il prezzo del prodotto al totale
                                            ProdottoFactory::modificaQtaProdottoNDB($prodottoConferma->getModello(), $prodottoConferma->getVenditore(),($prodottoConferma->getDisp()-1), $mysqli); // aggiorno la quantità disponibile del prodotto nel database
                                            $prodottoConferma->setDisp($prodottoConferma->getDisp()-1); // aggiorno la quantità disponibile nell' oggetto
                                            
                                            // salvataggio del nuovo credito del cliente
                                            $user->changeCredito($prezzo, 0); // sottraggo il prezzo del prodotto al credito. Il valore 0 imposta la sottrazione
                                            UserFactory::salvaCredito($user->getUsername(),$user->getCredito()); // salvo il credito nel DataBase
                                            
                                            // salvtaggio del nuovo credito del venditore
                                            $creditoVenditore = UserFactory::recuperaCredito($prodottoConferma->getVenditore()); // recupero l'attuale credito del venditore del prodotto
                                            UserFactory::salvaCredito(($prodottoConferma->getVenditore()), ($creditoVenditore+$prezzo)); //saslvo il nuovo credito del venditore nel database
                                            
                                            // salvataggio della transazione nel DataBase
                                            UserFactory::addTransazione($user->getUsername(), $prodottoConferma->getVenditore(), $prodottoConferma->getMarca(), $prodottoConferma->getModello(), $prodottoConferma->getPrezzo(), date('Y/m/d H:i:s'));
                                        }
                                        
                                    }
                                    // svuoto il carrello
                                    $carrello->svuotaCarrello();
                                    $session[self::carrelloProdotti]=$carrello;
                                    
                                    // salvo le modifiche nel DataBase
                                    $mysqli->commit();
                                    $mysqli->autocommit(true);
                                    chiudiDatabase($mysqli);
                                  
                                    //ACQUISTO TERMINATO
                                }
                            break;
                        }
                        
                        $vd->setSottoPagina('conferma');
                        $vd->setTitolo('conferma');
                        break;
                        */
                        // visualizzazione dei prodotti acquistati in precedenza
                        case 'storico':
                        $storico=UserFactory::creaStorico($user->getUsername());    
                        $vd->setSottoPagina('storico');
                        $vd->setTitolo('storico');
                        break;
                    
                    default:
                        $prodotti = ProdottoFactory::creaLista();
                        $vd->setSottoPagina('vetrina');
                        $vd->setTitolo("AMMazon - Vetrina Prodotti");
                        break;
                }
              
            }
else{
    $vd->setSottoPagina('login');
}


            // gestione dei comandi inviati dall'utente
            if (isset($request["cmd"])) {
                // abbiamo ricevuto un comando
                switch ($request["cmd"]) {
                    
                    //ricarica il credito del cliente
                    case 'ricarica':
                        if(isset($request['importo'])){
                            $user->ricarica($request['importo']);
                            UserFactory::salvaCredito($user->getUsername(), $user->getCredito()); // salvo il credito nel DataBase
                        }
                        $this->showHomeUtente($vd);
                        break;
                    
                    // logout
                    case 'logout':
                        
                        $this->logout($vd);
                        break;

                    case 'add':
                        
                        if(isset($request['codDisco']))
                        {
                            Carrello::addToCart($user->getUsername(), $request['codDisco']);
                        }
                        $this->showHomeUtente($vd);    
                        break;
                    
                    // modifica del profilo del cliente
                    case 'modificaprofilo':
                        
                        if(isset($request['pass1']) && $request['pass1']!=''){ // controllo che si voglia modificare la pass
                            if(isset($request['pass2']) && $request['pass2']!=''){
                                if($this->aggiornaPassword($user, $request)){ // se le password coincidono restituisco un messaggio positivo
                                    $msg2['esito']='positivo';
                                    $msg2['testo']='Password aggiornata';
                                }
                                else{ // se le password non coincidono, messaggio negativo
                                    $msg2['esito']='negativo';
                                    $msg2['testo']='Le password non coincidono';

                                }
                            }
                            else //messaggio negativo se non è stata confermata la password
                            {
                            $msg2['esito']='negativo';
                            $msg2['testo']='Confermare la password prima di salvare'; 
                            }
                        }
                        // salvo i nuovi dati in un array
                        $dati=array();
                        $dati['email']=$request['email'];
                        $dati['via']=$request['via'];
                        $dati['num']=$request['num'];
                        $dati['citta']=$request['citta'];
                        $dati['provincia']=$request['provincia'];
                        $dati['cap']=$request['cap'];
                        
                        
                        $this->aggiornaDati($user, $dati);// aggiorna i dati dal base controller
                        $msg1="Dati aggiornati";
                        $vd->setSottoPagina('profilo');
                        $vd->setTitolo("Profilo");
                        $this->showHomeUtente($vd);
                        break;
                    
                    default : $this->showLoginPage($vd);
                }
            } else {
                // nessun comando
                $user = $session[BaseController::user];
                $this->showHomeUtente($vd);
            }
        }

        // includo la vista
        require basename(__DIR__) . '/../view/master.php';
    }

    /**
     * Restituisce l'array contentente la sessione per l'utente corrente 
     * (vero o impersonato)
     * @return array
     */
    public function &getSessione(&$request) {
        $null = null;
        if (!isset($_SESSION) || !array_key_exists(BaseController::user, $_SESSION)) {
            // la sessione deve essere inizializzata
            return $null;
        }

        // verifico chi sia l'utente correntemente autenticato
        $user = $_SESSION[BaseController::user];

        // controllo degli accessi
        switch ($user->getRuolo()) {

            // l'utente e' uno studente, consentiamo l'accesso
            case User::Cliente:
                return $_SESSION;

            // l'utente è un venditore. Viene rimandato alla pagina di login    
            case User::Venditore:
                $this->showLoginPage($vd);

            default:
                return $null;
        }
    }


}

?>
