<?php
switch ($vd->getSottoPagina()) {
   
    case 'catalogo';
        include_once 'catalogo.php';
        break;
    
    case 'disco':
        include_once 'disco.php';
        break;
    
    case 'carrello':
        include_once 'carrello.php';
        break;

    case 'profilo':
        include_once 'profilo.php';
        break;
    
    case 'modificaProfilo':
        include_once 'modificaProfilo.php';
        break;
    
    case 'riepilogo':
        include_once 'riepilogo.php';
        break;
    
    default:
        
        ?>

    <h2>Pannello di Controllo</h2>
    <p>
        Benvenuto, <?= $user->getNome() ?>
    </p>
    <a href="cliente/catalogo">
        <div class="contenitore_pannello">
            <h3>Catalogo Dischi</h3>
            <img class="immagine_pannello" src= "../discolandia/images/disc.png">
        </div>
    </a>

    <a href="cliente/profilo">
        <div class="contenitore_pannello">
            <h3>Profilo</h3>
            <img class="immagine_pannello" src="../discolandia/images/dj.png">
        </div>
    </a>
        
    <a href="cliente/carrello">
        <div class="contenitore_pannello">
            <h3>Carrello</h3>
            <img class="immagine_pannello" src="../discolandia/images/cart100.png">
        </div>
    </a>
        <?php
        
        break;
}
?>
