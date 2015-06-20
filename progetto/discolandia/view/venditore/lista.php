<div id="lista" class="lista">
    <h2 class="catalogo_titolo">I dischi nella tua vetrina</h2>

<?php 


if (count($catalogo) > 0) { ?>

    <?php foreach ($catalogo as $cd) {?>

    
    <div class="catalogo_disco">
       
        <a href="venditore/disco?cod=<?=$cd->getCodDisco();?>"><img src="<?=$cd->getImmagine();?>" class="catalogo_immagine"></a>
        
        <div class="catalogo_dati">
            <p>
                <a href="venditore/disco?cod=<?=$cd->getCodDisco();?>"><strong><?=$cd->getTitolo()?></strong></a>
                <br>
                <?=$cd->getArtista()?>
            </p>
        </div>
        <p><?= $cd->getDisponibili()?></p>
        <div class="catalogo_prezzo"><p><?= $cd->getPrezzo()?> Euro</p></div>
    </div>

<?php

}
?>

<?php } else { ?>
<p> Nessun disco presente </p>
<?php } ?>

</div>