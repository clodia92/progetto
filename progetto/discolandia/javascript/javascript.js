/* 
 * Funzione per controllare che un venditore non cerchi di inserire un prodotto gia' esistente
 * Viene effettuata una chiamata ajax al file Validazione.php che effettua il controllo sul database
 */
function suggerimento(){   
    $.ajax({
        url: "model/Suggerimenti.php",
        
        data: {
            valore: $("#param").attr("value")
        },
        dataType: 'json',
        success: function(data, state) {
            $( "#ricerca" ).autocomplete({
            source: data
          });
            
        },
        error: function(data, state) { 
            $("#infoDoppione").show();
            document.getElementById('infoDoppione').innerHTML="errore";
        }
        
    });
} 