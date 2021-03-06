<?php

include_once 'BaseController.php';
include_once basename(__DIR__) . '/../model/DiscoFactory.php';
include_once basename(__DIR__) . '/../model/Carrello.php';
include_once basename(__DIR__) . '/../model/Storico.php';
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
                    
                    // visualizzazione dei dischi in vendita
                    case 'catalogo':
                        
                        if(isset($request['mode'])){
                            switch ($request['mode']){
                            case 'ricerca':
                                $catalogo = DiscoFactory::creaCatalogoRicerca($request['param']);
                                break;
                            case 'genere':
                                $catalogo = DiscoFactory::creaCatalogoGenere($request['param']);
                                break;
                            }
                        }
                        else{
                            $catalogo = DiscoFactory::creaCatalogo();
                        }

                        $vd->setSottoPagina('catalogo');
                        $vd->setTitolo("Catalogo Discolandia");
                        break;
                    
                    // visualizzazione della pagina del disco   
                    case 'disco':
                        $disco = DiscoFactory::getDisco($request['codDisco']);
                        $vd->setSottoPagina('disco');
                        $vd->setTitolo($disco->getTitolo());
                        break;
                    
                    // visualizzazione del carrello del cliente
                    case 'carrello':
                        // aggiorno la lista dei dischi nel carrello
                        $carrello = Carrello::getCarrello($user->getUsername()); 
                        $vd->setSottoPagina('carrello');
                        $vd->setTitolo('Carrello');
                        break;
                    
                     // visualizzazione del profilo
                    case 'profilo':
                        $storico=  Storico::getStorico($user->getId());
                        $vd->setSottoPagina('profilo');
                        $vd->setTitolo("Profilo");
                        break;
                    
                    //visualizzazione della pagina per modificare il profilo
                    case 'modificaProfilo':
                        $vd->setSottoPagina('modificaProfilo');
                        $vd->setTitolo("Modifica Profilo");
                        break;    
                    
                    //pagina di riepilogo dopo un pagamento
                    case 'riepilogo':
                        $vd->setSottoPagina('riepilogo');
                        $vd->setTitolo("Riepilogo");
                        break;
                   
                        
                    default:
                        $catalogo = DiscoFactory::creaCatalogo();
                        $vd->setSottoPagina('catalogo');
                        $vd->setTitolo("Catalogo Discolandia");
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
                    
                    // logout
                    case 'logout':
                        $this->logout($vd);
                        break;
                    
                    //aggiunta di un disco al carrello
                    case 'addCart':
                        
                        if(isset($request['codDisco']))
                        {
                            Carrello::addToCart($user->getUsername(), $request['codDisco']);
                        }
                        $carrello = Carrello::getCarrello($user->getUsername()); // aggiorno la lista dei prodotti nel carrello
                        $this->showHomeUtente($vd);    
                        break;
                        
                    //rimozione di un disco dal carrello    
                    case 'removeCart':
                        if(isset($request['codDisco']))
                        {
                            Carrello::removeToCart($user->getUsername(), $request['codDisco']);
                        }
                        // aggiorno la lista dei dischi nel carrello
                        $carrello = Carrello::getCarrello($user->getUsername()); 
                        $this->showHomeUtente($vd);    
                        break;
                    
                        
                    //ricarica il credito del cliente
                    case 'ricarica':
                        if(isset($request['importo'])){
                            $newCredito=($user->getCredito()+$request['importo']);
                            $user->setCredito($newCredito);
                            UserFactory::salvaCredito($user->getUsername(), $newCredito); // salvo il credito nel DataBase
                        }
                        
                        $this->showHomeUtente($vd);
                        break;
                        
                    //Pagamento dei dischi nel carrello    
                    case 'pagamento':
                        
                        $errore=0;
                        
                        if($request['tot']>($user->getCredito())){
                            $errore=1;
                            $msg="Credito insufficiente per completare l'acquisto";
                        }
                        else{
 
                            $carrello =  Carrello::getCarrello($user->getUsername());
                            
                            //Avvio la transazione
                            $mysqli = Database::avviaDatabase(); 
                            $mysqli->autocommit(false);
                            
                      
                            foreach ($carrello as $unita){
                                
                                //Controllo la disponibilita' e rimuovo i dischi acquistati
                                $disp =  DiscoFactory::leggiDisp($unita->getCodDisco(), $mysqli);
                                $qta = $unita->getQuantita();
                                $nuovaDisp = $disp - $qta;
                                DiscoFactory::modificaDisponibilita($unita->getCodDisco(), $nuovaDisp, $mysqli);
                                
                                //Modifico il credito del cliente
                                $credito= $user->getCredito();
                                $prezzo= $unita->getPrezzo()*$unita->getQuantita();
                                $creditoCliente=$credito-$prezzo;
                                
                                $user->setCredito($creditoCliente);
                                UserFactory::modificaCredito($user->getId(), $creditoCliente, $mysqli);
                                    
                                //Modifico il credito del venditore
                                $nuovoCredito=(UserFactory::getCreditoById($unita->getIdVenditore(), $mysqli))+($unita->getPrezzo()*$unita->getQuantita());
                                UserFactory::modificaCredito($unita->getIdVenditore(),$nuovoCredito, $mysqli);
                           
                                //Inserimento nello storico
                                Storico::addTransazione($user->getId(), $unita->getIdVenditore(), $unita->getCodDisco(), date('Y/m/d H:i:s'), $unita->getPrezzo(), $unita->getQuantita());
                                
                                //Elimino elementi dal carrello
                                Carrello::rimuoviElementi($unita->getIdCompratore(), $unita->getCodDisco(), $mysqli);
                     
                            }
                            $mysqli->commit();
                            $mysqli->autocommit(true);
                            Database::chiudiDatabase($mysqli);
                            
                        }
                        $tot=$request['tot'];
                        $vd->setSottoPagina('riepilogo');
                        $vd->setTitolo("Riepilogo");
                        $this->showHomeUtente($vd);
                        break;
                    
                    
                    // modifica del profilo del cliente
                    case 'modificaProfilo':
                        
                        if(isset($request['pass1']) && ($request['pass1']!='') && ($request['pass1'] == $request['pass2'])){ // controllo che si voglia modificare la pass
                            $this->aggiornaPassword($user, $request);
                            UserFactory::modificaPassword($user->getId(), $request['pass1']); // se le password coincidono restituisco un messaggio positivo         
                        }
                        // salvo i nuovi dati in un array
                        $dati=array();
                        $dati['email']=$request['email'];
                        $dati['via']=$request['via'];
                        $dati['civico']=$request['civico'];
                        $dati['citta']=$request['citta'];
                        $dati['provincia']=$request['provincia'];
                        $dati['cap']=$request['cap'];
                        
                        $this->aggiornaDati($user, $dati);//Aggiorna i dati dal base controller
                        UserFactory::modificaDati($user->getId(), $dati);// aggiorna i dati dal base controller
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

            // l'utente e' un cliente, consentiamo l'accesso
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
