<?php
switch ($vd->getSottoPagina()) {
   
    case 'lista';
        include_once 'lista.php';
        break;
    
    case 'disco':
        include_once 'disco.php';
        break;
    
    case 'profilo':
        include_once 'profilo.php';
        break;
    
    case 'modificaProfilo':
        include_once 'modificaProfilo.php';
        break;
    
    case 'nuovo_disco':
        include_once 'newDisco.php';
        break;
    
    case 'modifica_disco':
        include_once 'modificaDisco.php';
        break;
        
    default:
        
        ?>

    <h2>Home</h2>
    <p>
        Benvenuto, <?= $user->getNome() ?>
    </p>
    <br>
    <a href="venditore/lista">
        <div class="contenitore_pannello">
            <h3>I tuoi dischi</h3>
            <img class="immagine_pannello" src= "../discolandia/images/disc.png">
        </div>
    </a>

    <a href="venditore/nuovo_disco">
        <div class="contenitore_pannello">
            <h3>Aggiungi un nuovo disco</h3>
            <img class="immagine_pannello" src= "../discolandia/images/plus.png">
        </div>
    </a>
    
    <a href="venditore/profilo">
        <div class="contenitore_pannello">
            <h3>Profilo</h3>
            <img class="immagine_pannello" src="../discolandia/images/dj.png">
        </div>
    </a>
        
        <?php
        
        break;
}
?>
