<div id="disco">
    
    <div class="disco_bottone">
        <form method="post" action="cliente/carrello">
            <input type="hidden" name="act" value="add"/>
            <input type="submit" value="Compra a <?=$disco->getPrezzo()?> €"/>
        </form>
    </div>    
    
    <img class="disco_immagine" src="<?=$disco->getImmagine()?>">

    <div class="disco_dati">
        <h2><?=$disco->getTitolo()?></h2>
        <h3><?=$disco->getArtista()?></h3>
        <p>Etichetta: <?=$disco->getEtichetta()?>
        <br>Anno: <?=$disco->getAnno()?>
        <br>Genere: <?=$disco->getGenere()?>
        </p>
    </div>
    
    <div class="disco_descrizione">
        <h3>Descrizione:</h3>
        <p><?=$disco->getDescrizione()?></p>
    </div>
    
    <div class="disco_tracce">
        <h3>Tracce:</h3>
        <ol>
        <?//Le tracce arrivano già ordinate
        $tracce=$disco->getTracce();
        foreach ($tracce as $traccia) {
            ?>
            <li><?=$traccia->getTitolo()?></li>
            <?
        }
        ?>
        </ol>
    </div>

</div>