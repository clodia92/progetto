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
    
    

    <!--Lista degli acquisti effettuati-->
<div id="storico" class="contenitore altezza">
    <h2>Storico acquisti</h2>

    <?php 


    if (isset($storico) && (count($storico) > 0)) { ?>
    <div class="storico_spazioTabella">
    <table class="storico_tabella">
        <tr>
            <th>Data</th>
            <th>Prodotto</th>		
            <th>Prezzo</th>
            <th>Venditore</th>
        </tr>
    
        <?php foreach ($storico as $transazione) {?>
        <tr>
            <td><?= $transazione->getData()?></td>
            <td><?= $transazione->getMarca()?> - <?= $transazione->getModello()?></td>
            <td><?= $transazione->getPrezzo()?></td>
            <td><?= $transazione->getVenditore()?></td>
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