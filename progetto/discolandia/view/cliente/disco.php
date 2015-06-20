<div class="pagina_disco">
    
    <div class="add_cart_button">
        <p class="disco_prezzo"><?=$disco->getPrezzo()?> Euro</p>
        <form method="post" action="cliente/carrello">
            <input type="hidden" name="cmd" value="addCart"/>
            <input type="hidden" name='codDisco' value="<?=$disco->getCodDisco()?>">
            <input type="submit" value="Aggiungi al carrello"/>
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
    <br>
    <div class="disco_descrizione">
        <h3>Descrizione:</h3>
        <p><?=$disco->getDescrizione()?></p>
    </div>
    
    <div class="disco_tracce">
        <h3>Tracce:</h3>
        <ol>
        <?php
        if(!(isset($tracce)))
                echo "Non sono presenti tracce per questo disco";
        else
        {
            //Le tracce arrivano già ordinate
            $tracce=$disco->getTracce();
            foreach ($tracce as $traccia) {
                ?>
                <li><?=$traccia->getTitolo()?></li>
                <?php
            }
            
        }
        ?>
        </ol>
    </div>

</div>