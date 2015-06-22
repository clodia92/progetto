<div class="profilo_rightbar">
    <div class="testo_centrato">
        <img src="../discolandia/images/dj.png" class="immagine_profilo_laterale">
        <a href="cliente/profilo">
            <h4 class="nome_profilo"><?=$user->getNome(); ?></h4>
        </a>
        <br>
        <a href="cliente/profilo">Credito: <?=$user->getCredito(); ?> Euro</a>
        <br>
        <a href="cliente/profilo">Profilo</a>
        <br>
        <a href="cliente/carrello">Carrello</a>
        <br>
        <a href="cliente?cmd=logout">Logout</a>
    </div>
</div>
