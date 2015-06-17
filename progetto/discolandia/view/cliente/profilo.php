<!--Visualizzazione del profilo del cliente-->
<div class="profilo">
    <h2>Dati personali</h2>
            
    <ul>
        <li><strong>Nome:</strong> <?= $user->getNome() ?></li>
        <li><strong>Cognome:</strong> <?= $user->getCognome() ?></li>
        <li><strong>E-mail:</strong> <?= $user->getEmail() ?></li>
    </ul>
    
    <h3>Dati per la spedizione:</h3>
    <ul class="none">
        <li><strong>Via:</strong> <?= $user->getVia() ?></li>
        <li><strong>Civico:</strong> <?= $user->getCivico() ?></li>
        <li><strong>Citt&agrave;:</strong> <?= $user->getCitta() ?></li>
        <li><strong>Provincia:</strong> <?= $user->getProvincia() ?></li>
        <li><strong>CAP:</strong> <?= $user->getCap() ?></li>
    </ul>
    
    <h3><strong><a href="cliente/storico">Acquisti effettuati</a></strong></h3>
    
    <h3>
        <strong>Credito:</strong> <text class="prezzo"><?= $user->getCredito() ?> Euro</text>
    </h3>
    <!--Form per ricaricare il credito-->    
    <form method="post" action="cliente/profilo">
        <input type="hidden" name="cmd" value="ricarica"/>
        <label for="ricarica">Quanto vuoi ricaricare?:</label>
        <input type="text" name="ricarica" value=""/>
        <input type="submit" value="Ricarica!"/>
    </form>
    
    <form method="post" action="cliente/modprofilo">
          <input class="button modDati" type="submit" value="Modifica dati"/>
    </form>
</div>