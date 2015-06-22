<div class="profilo_rightbar">
    <div class="testo_centrato">
        <img src="../discolandia/images/dj.png" class="immagine_profilo_laterale">
        <a href="venditore/profilo">
            <h4 class="nome_profilo"><?=$user->getNome(); ?></h4>
        </a>
        <br>
        <a href="venditore/profilo">Credito: <?=$user->getCredito(); ?> Euro</a>
    </div>
    <!--Aggiungi gli altri dati profilo, carrello-->
    <div class="info_profilo_laterale">
        <a href="venditore/profilo">Profilo</a>
        <br>
        <a href="venditore?cmd=logout">Logout</a>
    </div>
</div>
