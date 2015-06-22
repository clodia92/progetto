<!--Pagina per l'aggiunta di un prodotto-->

<div class="modificaDisco">
    
    <h2>Modifica disco:</h2>
    
    <form name="modificaDisco" method="post" action="venditore/disco?codDisco=<?=$disco->getCodDisco()?>">
        <label for="codDisco">Codice Disco</label>
        <input class="textbox" type="text" name="codDisco" <?=$disco->getCodDisco()?> required>
        <br>
        <label for="artista">Artista</label>
        <input class="textbox" type="text" name="artista" value="<?=$disco->getArtista()?>" required>
        <br>
        <label for="titolo">Titolo</label>
        <input id="titolo" class="textbox" type="text" name="titolo" value="<?=$disco->getTitolo()?>" required>
        
        <br>
        <label for="genere">Genere</label>
        <select class="textbox" name="genere">
            <option value="blues" <?php if($disco->getGenere()=="blues")  echo 'selected';?>>Blues</option>
            <option value="disco" <?php if($disco->getGenere()=="disco")  echo 'selected';?>>Disco</option>
            <option value="jazz" <?php if($disco->getGenere()=="jazz")  echo 'selected';?>>Jazz</option>
            <option value="junior" <?php if($disco->getGenere()=="junior")  echo 'selected';?>>Junior</option>
            <option value="metal" <?php if($disco->getGenere()=="metal")  echo 'selected';?>>Metal</option>
            <option value="pop" <?php if($disco->getGenere()=="pop")  echo 'selected';?>>Pop</option>
            <option value="rap" <?php if($disco->getGenere()=="rap")  echo 'selected';?>>Rap</option>
        </select>
        <br>
        <label for="descrizione">Descrizione</label>
        <textarea class="textbox" rows="7" type="text" name="descrizione"/><?=$disco->getDescrizione()?></textarea>
        <br>
        <label for="etichetta">Etichetta</label>
        <input class="textbox" type="text" name="etichetta" value="<?=$disco->getEtichetta()?>"/>
        <br>
        <label for="immagine">Immagine link</label>
        <input class="textbox" type="text" name="immagine" value="<?=$disco->getImmagine()?>"/>
        <br>
        <label for="anno">Anno</label>
        <input class="textbox" type="text" name="anno" value="<?=$disco->getAnno()?>"/>
        <br>
        <label for="prezzo">Prezzo</label>
        <input class="textbox" type="text" name="prezzo" value="<?=$disco->getPrezzo()?>"/>
        <br>
        <label for="disponibili">Quantit&aacute;</label>
        <input class="textbox" type="text" name="quantita" value="<?=$disco->getDisponibili()?>"/>
        <br>
        <label for="tracce">Tracce(Una per riga)</label>
        <textarea class="textbox" rows="7" type="text" name="tracce"/>
        <?php
            $tracce=$disco->getTracce();
            foreach ($tracce as $traccia) {
                
                echo $traccia->getTitolo().'\n';
              }
              ?>
    
        </textarea>
        
        <div class="btn-group">
            <button class="button" type="submit" name="cmd" value="modifica_disco">Salva</button>
        </div>
    </form>
    
    
</div>