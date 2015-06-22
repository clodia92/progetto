<div class="profilo_rightbar">
    <div class="testo_centrato">
        <img src="../discolandia/images/dj.png" class="immagine_profilo_laterale">
        <a href="venditore/profilo">
            <h4 class="nome_profilo"><?=$user->getNome(); ?></h4>
        </a>
        <br>
        Credito: <?=$user->getCredito(); ?> Euro
        <br>
        <a href="venditore/profilo">Profilo</a>
        <br>
        <a href="venditore?cmd=logout">Logout</a>
    </div>
</div>
