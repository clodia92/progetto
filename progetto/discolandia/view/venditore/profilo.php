<!--Visualizzazione del profilo del cliente-->
<div class="profilo">
    <h3>Profilo</h3>
    <div class="profilo_sinistro">
        <h4>Dati personali</h4>

        <ul>
            <li><strong>Nome:</strong> <?= $user->getNome() ?></li>
            <li><strong>Cognome:</strong> <?= $user->getCognome() ?></li>
            <li><strong>E-mail:</strong> <?= $user->getEmail() ?></li>
            <li><strong>Credito:</strong> <span class=""><?= $user->getCredito() ?> Euro</span></li>
        </ul>
        <br>
         <span><a href="venditore/modificaProfilo">Modifica</a></span>
    </div>
    
    <div class="profilo_destro">
        <h4>Dati per il ritiro pacchi:</h4>
        <ul class="none">
            <li><strong>Via:</strong> <?= $user->getVia() ?></li>
            <li><strong>Civico:</strong> <?= $user->getCivico() ?></li>
            <li><strong>Citt&agrave;:</strong> <?= $user->getCitta() ?></li>
            <li><strong>Provincia:</strong> <?= $user->getProvincia() ?></li>
            <li><strong>CAP:</strong> <?= $user->getCap() ?></li>
        </ul>
    </div>
    <br><br><br>   
    <h4>
        Credito: <text><?= $user->getCredito() ?> Euro</text>
    </h4>
  
</div>