<div id="lista" class="lista">
    <h2 class="catalogo_titolo">I dischi nella tua vetrina</h2>

<?php 


if (count($catalogo) > 0) { ?>

    <?php foreach ($catalogo as $cd) {?>

    
    <div class="catalogo_disco">
        <a href="venditore/disco?cod=<?=$cd->getCodDisco();?>">
            <div class="catalogo_box_immagine">
                <img src="<?=$cd->getImmagine();?>" class="catalogo_immagine">
            </div>
        </a>
        
        <div class="catalogo_dati">
            <p>
                <a href="venditore/disco?cod=<?=$cd->getCodDisco();?>"><strong><?=$cd->getTitolo()?></strong></a>
                <br>
                <?=$cd->getArtista()?>
            </p>
        </div>
        <div class="catalogo_prezzo">
            <span class="spaziato">Disponibili: <?= $cd->getDisponibili()?></span>
            <span class="spaziato"><?= $cd->getPrezzo()?> Euro</span>
            <a class="spaziato" href="venditore/modificaDisco?codDisco=<?=$cd->getCodDisco();?>">
                Modifica
            </a>
            <a class="spaziato" href="venditore/lista?cmd=rimuoviDisco&codDisco=<?=$cd->getCodDisco();?>" onclick="return confirm('Sei sicuro di voler eliminare il disco (<?=$cd->getTitolo()?>)?')">
                Elimina
            </a>
        </div>
        
    </div>

<?php

}
?>

<?php } else { ?>
<p> Nessun disco presente </p>
<?php } ?>

</div>