<div class="pagina_carrello">
    <h3>Il tuo carrello</h3>
        
    <?php
    if(!(isset($carrello) && count($carrello)>0))
        echo "Nessun elemento nel carrello";
    else
    {
    $tot=0;    
    ?>
    <table>
        <tr>
            <th class="tabella_disco">Disco</th>
            <th class="tabella_qta">Quantit&agrave;</th>
            <th class="tabella_prezzo">Prezzo</th>
            <th class="tabella_remove">Comandi</th>
        </tr>

        <?php foreach ($carrello as $cartItem){ ?>
        <tr>
            <td><?=$cartItem->getTitolo?></td>
            <td><?=$cartItem->getQuantita?></td>
            <td><?=$cartItem->getPrezzo; $tot=$tot+$cartItem->getPrezzo;?></td>
            <td>Remove<?php $cartItem->getCodDisco?></td>
        </tr>
        <?php } ?>
    </table>
    <p>Totale: <?=$tot?></p>
    <?php
    }
    ?>

    
    
    <p>Manca il bottone di conferma</p>

</div>