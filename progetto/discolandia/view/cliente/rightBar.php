<div class="profilo_rightbar">
    <div class="testo_centrato">
        <img src="../discolandia/images/dj.png" class="immagine_profilo_laterale">
        <a href="cliente/profilo"><h4><?=$user->getNome(); ?></h4></a>
    </div>
    <!--Aggiungi gli altri dati profilo, carrello-->
    <div class="info_profilo_laterale">
        <a href="cliente/profilo">Profilo</a>
        <br>
        <span>Credito: <?=$user->getCredito(); ?> Euro</span>
        <br>
        <a href="cliente/carrello">Carrello</a>
        <br>
        <a href="cliente?cmd=logout">Logout</a>
    </div>
    

</div>
