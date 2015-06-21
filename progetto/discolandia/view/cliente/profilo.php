<!--Visualizzazione del profilo del cliente-->
<div class="profilo">
    <h2 class="titolo">Profilo</h2>
    <div class="profilo_sinistro">
        <h3>Dati personali</h3><span>Modifica</span>

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
    
    <h3>
        Credito: <text class=""><?= $user->getCredito() ?> Euro</text>
    </h3>
    <!--Form per ricaricare il credito-->    
    <form method="post" action="cliente/profilo">
        <input type="hidden" name="cmd" value="ricarica"/>
        <label for="ricarica">Quanto vuoi ricaricare?:</label>
        <input type="text" name="importo" value=""/>
        <input type="submit" value="Ricarica!"/>
    </form>
    

    <!--Lista degli acquisti effettuati-->
    <div id="storico" class="contenitore altezza">
        <h2>Ordini effettuati</h2>

    <?php 


    if (count($storico) > 0 && $storico!=0) { ?>
    <div class="storico_spazioTabella">
    <table class="storico_tabella">
        <tr>
            <th>Data</th>
            <th>Disco</th>		
            <th>Prezzo</th>
            <th>Quantit&agrave;</th>
               
            
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