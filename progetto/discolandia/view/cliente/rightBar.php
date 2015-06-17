<div class="profilo_rightbar">
    <div class="testo_centrato">
        <img src="../discolandia/images/dj.png" class="immagine_profilo_laterale">
        <a href="cliente/profilo"><h4><?=$user->getNome(); ?></h4></a>
    </div>
    <!--Aggiungi gli altri dati profilo, carrello-->
    <div class="info_profilo_laterale">
        <a href="cliente?cmd=logout">Logout</a>
    </div>
    
    
    
    <h3>
        Credito: <text class=""><?= $user->getCredito() ?> Euro</text>
    </h3>
    <!--Form per ricaricare il credito-->    
    <form method="post" action="cliente/profilo">
        <input type="hidden" name="cmd" value="ricarica"/>
        <label for="ricarica">Quanto vuoi ricaricare?:</label>
        <input type="text" name="ricarica" value=""/>
        <input type="submit" value="Ricarica!"/>
    </form>
    

    
    
</div>
