<div class="pagina_carrello">
    <h3>Il tuo carrello</h3>
        
    <?php
    if(!(isset($carrello) && count($carrello)>0))
        echo "Nessun elemento nel carrello";
    else
    {
    $tot=0;    
    ?>
    <table class="tabella">
        <tr>
            <th class="tabella_disco">Disco</th>
            <th class="tabella_qta">Quantit&agrave;</th>
            <th class="tabella_prezzo">Prezzo</th>
            <th class="tabella_remove">Comandi</th>
        </tr>

        <?php foreach ($carrello as $cartItem){ ?>
        <tr>
            <td><?=$cartItem->getTitolo()?></td>
            <td><?=$cartItem->getQuantita()?></td>
            <td><?=$cartItem->getPrezzo(); $tot=$tot+($cartItem->getPrezzo()*$cartItem->getQuantita());?></td>
            <td>
                <a href="cliente/carrello?cmd=removeCart&codDisco=<?=$cartItem->getCodDisco()?>">
                    Rimuovi</a>
            </td>    
        </tr>
        <?php } ?>
    </table>
    <div class="allineaDestra">
        <p><b>Totale: <?=$tot?> Euro</b></p>

        <form method="post" action="cliente/riepilogo">
            <input type="hidden" name="tot" value="<?=$tot?>"/>
            <input type="hidden" name="cmd" value="pagamento">
            <input class="button btn_pagamento" type="submit" <?php if($user->getCredito()<$tot)echo'disabled';?> value="Procedi al pagamento" onclick="return confirm('Sei sicuro di voler effettuare il pagamento di <?=$tot?> Euro?')"/>
            <?php if($user->getCredito()<$tot)echo '<br>Credito insufficiente per completare l\'acquisto';?>
        </form>
    </div>
    <?php
    
    }
    ?>

</div>

