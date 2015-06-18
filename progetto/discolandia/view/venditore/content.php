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
        
    default:
        
        ?>

    <h2>Pannello di Controllo</h2>
    <p>
        Benvenuto, <?= $user->getNome() ?>
    </p>
    <a href="venditore/lista">
        <div class="contenitore_pannello">
            <h3>Catalogo Dischi</h3>
            <img class="immagine_pannello" src= "../discolandia/images/disc.png">
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
