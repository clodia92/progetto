<!--Visualizzazione del profilo del cliente-->
<div class="profilo">
    <div class="profilo_sinistro">
        <h2>Dati personali</h2><span>Modifica</span>

        <ul>
            <li><strong>Nome:</strong> <?= $user->getNome() ?></li>
            <li><strong>Cognome:</strong> <?= $user->getCognome() ?></li>
            <li><strong>E-mail:</strong> <?= $user->getEmail() ?></li>
            <li><strong>Credito:</strong> <span class=""><?= $user->getCredito() ?> Euro</span></li>
        </ul>
    </div>
    
    <div class="profilo_destro">
        <h3>Dati per la spedizione:</h3>
        <ul class="none">
            <li><strong>Via:</strong> <?= $user->getVia() ?></li>
            <li><strong>Civico:</strong> <?= $user->getCivico() ?></li>
            <li><strong>Citt&agrave;:</strong> <?= $user->getCitta() ?></li>
            <li><strong>Provincia:</strong> <?= $user->getProvincia() ?></li>
            <li><strong>CAP:</strong> <?= $user->getCap() ?></li>
        </ul>
    </div>
    
    
    
    
    <h3><strong><a href="cliente/storico">Acquisti effettuati</a></strong></h3>
    
    
</div>