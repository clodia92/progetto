<!--Pagina per l'aggiunta di un prodotto-->

<div id="aggiungiDisco" class="aggiungiDisco">
    
    <h2>Aggiungi un nuovo disco:</h2>
    
    <form name="newDisco" method="post" action="venditore/lista">
        
        
        <label for="artista">Artista</label>
        <input class="textbox" type="text" name="artista" required>
        <br>
        <label for="titolo">Titolo</label>
        <input id="titolo" class="textbox" type="text" name="titolo" value="" required>
        
        <br>
        <label for="genere">Genere</label>
        <select class="textbox" name="genere">
            <option value="blues">Blues</option>
            <option value="disco">Disco</option>
            <option value="jazz">Jazz</option>
            <option value="junior">Junior</option>
            <option value="metal">Metal</option>
            <option value="pop">Pop</option>
            <option value="rap">Rap</option>
        </select>
        <br>
        <label for="descrizione">Descrizione</label>
        <textarea class="textbox"type="text" name="descrizione" /></textarea>
        <br>
        <label for="etichetta">Etichetta</label>
        <input class="textbox" type="text" name="etichetta"/>
        <br>
        <label for="immagine">Immagine</label>
        <input class="textbox" type="text" name="immagine"/>
        <br>
        <label for="anno">Anno</label>
        <input class="textbox" type="text" name="anno"/>
        <br>
        <label for="prezzo">Prezzo</label>
        <input class="textbox" type="text" name="prezzo"/>
        <br>
        <label for="disponibili">Qauntit&aacute;</label>
        <input class="textbox" type="text" name="quantita"/>
        <br>
        <label for="tracce">Anno</label>
        <textarea class="textbox" type="text" name="tracce"/></textarea><p>Una per riga</p>
        
        <div class="btn-group">
            <button id="btn_aggiungiProdotto" class="button" type="submit" name="cmd" value="aggiungi_disco">Aggiungi</button>
        </div>
    </form>
    
    
</div>