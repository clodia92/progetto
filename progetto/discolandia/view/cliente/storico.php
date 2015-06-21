<!--Lista degli acquisti effettuati-->
<div >
    <h2>Ordini effettuati</h2>

    <?php 


    if (count($storico) > 0 && $storico!=0) { ?>
    <div class="storico_spazioTabella">
    <table class="storico_tabella">
        <tr>
            <th>Data</th>
            <th>Disco</th>		
            <th>Prezzo</th>
            <th>Venditore</th>
        </tr>
    
        <?php foreach ($storico as $transazione) {?>
        <tr>
            <td><?= $transazione->getData()?></td>
            <td><?= $transazione->getTitolo()?></td>
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