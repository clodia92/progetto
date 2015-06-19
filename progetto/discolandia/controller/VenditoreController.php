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
                    
                    // visualizzazione della pagina per la modifica dei dati del venditore
                    case 'modificaprofilo':
                        $vd->setSottoPagina('modificaprofilo');
                        $vd->setTitolo('Modifica Profilo');
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
                    
                    // pagina per modificare i dati di un prodotto
                    case 'modificaProdotto':
                        $nome=$request["id"];
                        $prodottoScelto = ProdottoFactory::getProdottoPerModello($nome);
                        $originalName=$prodottoScelto->getModello();//Salvo il nome originale nel caso questo venga cambiato nella pagina di modifica
                        $vd->setSottoPagina('modificaProdotto');
                        $vd->setTitolo('Venditore - Modifica Prodotto');
                        break;
                    
                    // visualizzazione della pagina del prodotto come la vedrebbe il cliente
                    case 'visualizzaProdotto':
                        $nome=$request["id"];
                        $prodottoScelto = ProdottoFactory::getProdottoPerModello($nome);
                        $vd->setSottoPagina('visualizzaProdotto');
                        $vd->setTitolo('Venditore - Visualizza Prodotto');
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
                    case 'nuovoDisco':
                        $disco=array(); // dati del disco
                        $disco["codDisco"]=$request['codDisco'];
                        $disco["artista"]=$request['artista'];
                        $disco["titolo"]=$request['titolo'];
                        $disco["genere"]=$request['genere'];
                        $disco["descrizione"]=$request['descrizione'];
                        $disco["etichetta"]=$request['etichetta'];
                        $disco["immagine"]=$request['immagine'];
                        $disco["anno"]=$request['anno'];
                        $disco["prezzo"]=$request['prezzo'];
                        $disco["quantita"]=$request['quantita'];
                        $disco["venditore"]=$user->getUsername();
                        $tracce=  explode("\n", $request['tracce']);
                        
                        
                        
                        // se il prodotto viene correttamente aggiunto viene mostrato un feedback positivo
                        if(DiscoFactory::aggiungiDisco($disco))
                        {
                            if(TracciaFactory::aggiungiTracce($disco['codDisco'],$tracce)){
                                $msg="Il disco '" . $disco['titolo'] . "' è stato aggiunto al catalogo";
                            }
                        }

                        $catalogo = DiscoFactory::creaCatalogo();
                        $vd->setSottoPagina('lista');
                        $vd->setTitolo('Venditore - Lista Prodotti');
                        $this->showHomeUtente($vd);
                        break;
                    
                    // modifica dei dati di un prodotto e dei dettagli di vendita
                    case 'p_modifica':
                        $elenco=array();
                        $elenco["marca"]=$request['marca'];
                        $elenco["modello"]=$request['modello'];
                        $elenco["originalModel"]=$request['originalModel'];
                        $elenco["tipo"]=$request['tipo'];
                        $elenco["schermo"]=$request['schermo'];
                        $elenco["ram"]=$request['ram'];
                        $elenco["cpu"]=$request['cpu'];
                        $elenco["hdd"]=$request['hdd'];
                        $elenco["so"]=$request['so'];
                        $elenco["descrizione"]=$request['descrizione'];
                        $elenco["foto"]=$request['foto'];
                        
                     
                        if(ProdottoFactory::modificaProdotto($elenco, $user->getUsername(), $request['prezzo'], $request['disp']))
                        {$conferma="modificato";}

                        $prodotti = ProdottoFactory::creaLista();
                        $vd->setSottoPagina('lista');
                        $vd->setTitolo('Venditore - Lista Prodotti');
                        $this->showHomeUtente($vd);
                        break;
                        
                    // cancellazione di un prodotto dalla lista dei prodotti i vendita    
                    case 'cancella':
                        if(ProdottoFactory::cancellaProdotto($request['id'], $user->getUsername()))
                            $conferma="rimosso";
                       $prodotti = ProdottoFactory::creaLista();
                        $vd->setSottoPagina('lista');
                        $vd->setTitolo('Venditore - Lista Prodotti');
                        $this->showHomeUtente($vd);
                        break;

                    // modifica dei dati del venditore    
                    case 'modprofilo':
                        if(isset($request['pass1']) && $request['pass1']!=''){
                            if(isset($request['pass2']) && $request['pass2']!=''){
                                if($this->aggiornaPassword($user, $request)){ // aggiorna la password e restituisce un feedback
                                    $msg2['esito']='positivo';
                                    $msg2['testo']='Password aggiornata';
                                }
                                else{
                                    $msg2['esito']='negativo';
                                    $msg2['testo']='Le password non coincidono';

                                }
                            }
                            else
                            {
                            $msg2['esito']='negativo';
                            $msg2['testo']='Confermare la password prima di salvare'; 
                            }
                        }
                        
                        $dati=array();
                        $dati['email']=$request['email'];
                        $dati['via']=$request['via'];
                        $dati['num']=$request['num'];
                        $dati['citta']=$request['citta'];
                        $dati['provincia']=$request['provincia'];
                        $dati['cap']=$request['cap'];
                        
                        
                        $this->aggiornaDati($user, $dati);//Aggiorna i dati dal base controller
                        $msg1="Dati aggiornati";
                        $vd->setSottoPagina('profilo');
                        $vd->setTitolo("AMMazon - Profilo");
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