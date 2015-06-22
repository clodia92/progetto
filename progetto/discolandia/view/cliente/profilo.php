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
    </div>
    
    <div class="profilo_destro">
        <h4>Dati per la spedizione:</h4>
        <ul class="none">
            <li><strong>Via:</strong> <?= $user->getVia() ?></li>
            <li><strong>Civico:</strong> <?= $user->getCivico() ?></li>
            <li><strong>Citt&agrave;:</strong> <?= $user->getCitta() ?></li>
            <li><strong>Provincia:</strong> <?= $user->getProvincia() ?></li>
            <li><strong>CAP:</strong> <?= $user->getCap() ?></li>
        </ul>
    </div>
    <span><a href="cliente/modificaProfilo">Modifica</a></span>    
    <h4>
        Credito: <text class=""><?= $user->getCredito() ?> Euro</text>
    </h4>
    <!--Form per ricaricare il credito-->    
    <form method="post" action="cliente/profilo">
        <input type="hidden" name="cmd" value="ricarica"/>
        <label for="ricarica">Quanto vuoi ricaricare?:</label>
        <input type="text" name="importo" value=""/>
        <input type="submit" value="Ricarica!"/>
    </form>
    

    <!--Lista degli acquisti effettuati-->
    <div id="storico" class="contenitore altezza">
        <h3>Ordini effettuati</h3>

    <?php 


    if (count($storico) > 0 && $storico!=0) { ?>
    <div class="storico_spazioTabella">
    <table class="tabella">
        <tr>
            <th class="tabella_prezzo">Data</th>
            <th class="tabella_disco">Disco</th>		
            <th class="tabella_prezzo">Prezzo</th>
            <th class="tabella_prezzo">Quantit&agrave;</th>
               
            
        </tr>
    
        <?php foreach ($storico as $transazione) {?>
        <tr>
            <td><?= $transazione->getData()?></td>
            <td><?= $transazione->getTitolo()?></td>
            <td><?= $transazione->getPrezzo()?></td>
            <td><?= $transazione->getQuantita()?></td>
        </tr>
    <?php

    }
    ?>
    </table>
    <?php } else { ?>
    <p> Nessun acquisto effettuato </p>
    <?php } ?>
    </div>
    </div>
    
</div>