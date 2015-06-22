<?php

include_once 'BaseController.php';
include_once basename(__DIR__) . '/../model/DiscoFactory.php';

/**
 * Controller che gestisce la modifica dei dati dell'applicazione relativa ai venditori
 */

class VenditoreController extends BaseController {

    /*
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

        if (!$this->loggedIn()) {
            // utente non autenticato, rimando alla home
            $this->showLoginPage($vd);
        } else {
            // utente autenticato
            $user = $session[BaseController::user];

            /*
            * controllo la sottopagina richiesta e imposto il descrittore della
            * vista per caricare la sottopagina corretta.
            * tutte le variabili che vengono create senza essere utilizzate 
            * direttamente in questo switch, sono quelle che vengono poi lette
            * dalla vista, ed utilizzano le classi del modello
            */
            if (isset($request["subpage"])) {
                switch ($request["subpage"]) {
                    
                    // visualizzazione del profilo
                    case 'profilo':
                        $vd->setSottoPagina('profilo');
                        $vd->setTitolo('Venditore - Profilo');
                        break;
                    
                    //visualizzazione della pagina per modificare il profilo
                    case 'modificaProfilo':
                        $vd->setSottoPagina('modificaProfilo');
                        $vd->setTitolo("Modifica Profilo");
                        break; 
                    
                    // pagina per l'aggiunta di un prodotto
                    case 'nuovo_disco':
                        $vd->setSottoPagina('nuovo_disco');
                        $vd->setTitolo('Aggiungi Disco');
                        break;

                    // visualizzazione dell'elenco dei prodotti in vendita per il venditore
                    case 'lista':
                        $catalogo = DiscoFactory::creaCatalogo();
                        $vd->setSottoPagina('lista');
                        $vd->setTitolo('Venditore - Lista Prodotti');
                        break;
                    
                    // visualizzazione della pagina del prodotto generata dinamicamente    
                    case 'disco':
                        
                        $disco = DiscoFactory::getDisco($request['codDisco']);
                        $vd->setSottoPagina('disco');
                        $vd->setTitolo($disco->getTitolo());
                        break;
                    
                    // pagina per modificare i dati di un prodotto
                    case 'modificaDisco':
                        $disco = DiscoFactory::getDisco($request['codDisco']);
                        $vd->setSottoPagina('modifica_disco');
                        $vd->setTitolo('Modifica '.$disco->getTitolo());
                        break;
                    
                   
                    default:
                        $vd->setSottoPagina('home');
                        break;
                }
            }


            // gestione dei comandi inviati dall'utente
            if (isset($request["cmd"])) {

                switch ($request["cmd"]) {

                    // logout
                    case 'logout':
                      
                        $this->logout($vd);
                        break;

                    // salvataggio di un nuovo prodotto
                    case 'aggiungi_disco':
                        $disco=array(); // dati del disco
                        $disco["codDisco"]=$request['codDisco'];
                        $disco["artista"]=$request['artista'];
                        $disco["titolo"]=$request['titolo'];
                        $disco["genere"]=$request['genere'];
                        $disco["descrizione"]=HtmlEntities(addslashes($request['descrizione']));
                        $disco["etichetta"]=$request['etichetta'];
                        $disco["immagine"]=$request['immagine'];
                        $disco["anno"]=$request['anno'];
                        $disco["prezzo"]=$request['prezzo'];
                        $disco["quantita"]=$request['quantita'];
                        $disco["venditore"]=$user->getId();
                        $tracce=  explode("\n", $request['tracce']);
                        
                        
                        
                        // se il prodotto viene correttamente aggiunto viene mostrato un feedback positivo
                        DiscoFactory::aggiungiDisco($disco);
                        TracciaFactory::aggiungiTracce($disco['codDisco'],$tracce);
                        
                        $catalogo = DiscoFactory::creaCatalogo();
                        $vd->setSottoPagina('lista');
                        $vd->setTitolo('Venditore - Lista Prodotti');
                        $this->showHomeUtente($vd);
                        break;
                    
                    // modifica dei dati di un prodotto e dei dettagli di vendita
                    case 'modifica_disco':
                        $disco=array(); // dati del disco
                        $disco["codDisco"]=$request['codDisco'];
                        $disco["artista"]=$request['artista'];
                        $disco["titolo"]=$request['titolo'];
                        $disco["genere"]=$request['genere'];
                        $disco["descrizione"]=HtmlEntities(addslashes($request['descrizione']));
                        $disco["etichetta"]=$request['etichetta'];
                        $disco["immagine"]=$request['immagine'];
                        $disco["anno"]=$request['anno'];
                        $disco["prezzo"]=$request['prezzo'];
                        $disco["quantita"]=$request['quantita'];
                        $disco["oldCodDisco"]=$request['oldCodDisco'];
                        $disco["venditore"]=$user->getId();
                        $tracce=  explode("\n", $request['tracce']);
                        
                        
                        
                        // se il prodotto viene correttamente aggiunto viene mostrato un feedback positivo
                        DiscoFactory::rimuoviDisco($disco['oldCodDisco']);
                        TracciaFactory::rimuoviTracce($disco['oldCodDisco']);
                        
                        DiscoFactory::aggiungiDisco($disco);
                        TracciaFactory::aggiungiTracce($disco['codDisco'], $tracce);
                        
                        $catalogo = DiscoFactory::creaCatalogo();
                        $vd->setSottoPagina('lista');
                        $vd->setTitolo('Venditore - Lista Prodotti');
                        $this->showHomeUtente($vd);
                        break;
                        
                    // cancellazione di un prodotto dalla lista dei prodotti i vendita    
                    case 'rimuoviDisco':
                        
                        DiscoFactory::rimuoviDisco($request['codDisco']);
                        $catalogo = DiscoFactory::creaCatalogo();
                        $vd->setSottoPagina('lista');
                        $vd->setTitolo('Venditore - Lista Prodotti');
                        $this->showHomeUtente($vd);
                        break;

                    // modifica del profilo del cliente
                    case 'modificaProfilo':
                        
                        if(isset($request['pass1']) && ($request['pass1']!='') && ($request['pass1'] == $request['pass2'])){ // controllo che si voglia modificare la pass
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
                        
                        
                        UserFactory::modificaDati($user->getId(), $dati);// aggiorna i dati dal base controller
                        $msg1="Dati aggiornati";
                        $vd->setSottoPagina('profilo');
                        $vd->setTitolo("Profilo");
                        $this->showHomeUtente($vd);
                        break;
                }
            } else {
                // nessun comando, dobbiamo semplicemente visualizzare 
                // la vista
                $user = $session[BaseController::user];
                $this->showHomeUtente($vd);
            }
        }


        // richiamo la vista
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

            // l'utente e' un venditore, consentiamo l'accesso
            case User::Venditore:
                return $_SESSION;

            default:
                return $null;
        }
    }

}

?>