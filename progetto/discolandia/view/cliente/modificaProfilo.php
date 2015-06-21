<!--Pagina per modificare il proprio profilo-->

<div class="paginaProfilo contenitore">
    <h2>Modifica dati personali</h2>
    <br/>
    <form name="modificaProfilo" method="post" action="cliente/profilo">
        <input type="hidden" name="cmd" value="modificaProfilo"/>
        <label for="email">Email:</label>
        <input class="textbox" type="text" name="email" id="email" value="<?= $user->getEmail() ?>" required/>
        <br>
        <label for="via">Via o Piazza:</label>
        <input class="textbox" type="text" name="via" id="via" value="<?= $user->getVia() ?>" required/>
        <br>
        <label for="num">Numero Civico</label>
        <input class="textbox" type="text" name="num" id="num" value="<?= $user->getCivico() ?>" required/>
        <br/>
        <label for="citta">Citt&agrave;</label>
        <input class="textbox" type="text" name="citta" id="citta" value="<?= $user->getCitta() ?>" required/>
        <br/>
        <label for="provincia">Provincia</label>
        <input class="textbox" type="text" name="provincia" id="provincia" value="<?= $user->getProvincia() ?>" required/>
        <br/>
        <label for="cap">CAP</label>
        <input class="textbox" type="text" name="cap" id="cap" value="<?= $user->getCap() ?>" required/>
        <br/>
        
        <label for="pass1">Nuova Password:</label>
        <input class="textbox" type="password" name="pass1" id="pass1"/>
        <br/>
        <label for="pass2">Conferma:</label>
        <input class="textbox" type="password" name="pass2" id="pass2"/>
        <br>

        <input class="button" type="submit" value="Salva"/>
    </form>
</div>