<div class="generi_leftbar">
    <h3>Catalogo</h3>
    <br>
    <h3>Ricerca</h3>
    <form method="post" action="cliente/catalogo">
        <input type="hidden" name="mode" value="ricerca">
        <label for="ricarica">Cerca un disco:</label>
        <input type="text" name="param" value=""/>
        <input type="submit" value="Cerca"/>
    </form>
    <br>
    <h3>Generi</h3>

    <ul>
        <li><a href="cliente/catalogo?mode=genere&param=blues">Blues</a></li>
        <li><a href="cliente/catalogo?mode=genere&param=disco">Disco</a></li>
        <li><a href="cliente/catalogo?mode=genere&param=jazz">Jazz</a></li>
        <li><a href="cliente/catalogo?mode=genere&param=junior">Junior</a></li>
        <li><a href="cliente/catalogo?mode=genere&param=metal">Metal</a></li>
        <li><a href="cliente/catalogo?mode=genere&param=pop">Pop</a></li>
        <li><a href="cliente/catalogo?mode=genere&param=rap">Rap</a></li>
        
    </ul>
</div>