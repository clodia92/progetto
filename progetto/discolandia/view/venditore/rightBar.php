<div class="profilo_rightbar">
    <div class="testo_centrato">
        <img src="../discolandia/images/dj.png" class="immagine_profilo_laterale">
        <a href="venditore/profilo"><h4><?=$user->getNome(); ?></h4></a>
    </div>
    <!--Aggiungi gli altri dati profilo, carrello-->
    <div class="info_profilo_laterale">
        <a href="venditore?cmd=logout">Logout</a>
        <a href="venditore/profilo">Profilo</a>
        <span>Credito: <?=$user->getCredito(); ?></span>
    </div>
    

</div>
