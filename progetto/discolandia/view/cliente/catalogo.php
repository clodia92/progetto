<div id="catalogo">
    <h2 class="catalogo_titolo">Catalogo Dischi</h2>

<?php 


if (count($catalogo) > 0) { ?>

    <?foreach ($catalogo as $cd) {?>

    
    <div class="catalogo_disco">
       
        <a href="cliente/disco?cod=<?=$cd->getCodDisco();?>"><img src="<?=$cd->getImmagine();?>" class="catalogo_immagine"></a>
        
        <div class="catalogo_dati">
            <p>
                <a href="cliente/disco?cod=<?=$cd->getCodDisco();?>"><strong><?=$cd->getTitolo()?></strong></a>
                <br>
                <?=$cd->getArtista()?>
            </p>
        </div>
        <div class="catalogo_prezzo"><?= $cd->getPrezzo()?>€</div>
    </div>

<?php

}
?>

<? } else { ?>
<p> Nessun disco presente </p>
<? } ?>

</div>