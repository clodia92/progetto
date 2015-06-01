<?php
/**
 *Restituisce la giusta query
 */

function getQuery($tipo, $parametro){
	
    switch ($tipo){
        case 'catalogo':
            $query = "SELECT * FROM `Dischi` WHERE 1";
            break;
        
        case 'tracce'://ritorna le tracce ordinate per il disco
            $query = "SELECT * FROM `Tracce` WHERE `codDisco`=" . $parametro. " ORDER BY `numero`";
            break;
        
        case 'disco':
            $query = "SELECT * FROM `Dischi` WHERE `codDisco`=" . $parametro;
            break;
    }   
    
    return $query;

}
/*
function queryListaTipo($tipo){
    $QUERY = "SELECT `nome`, `tipo`, `schermo`, `ram`, `cpu`, `hdd`, `so`, `descrizione`, `numDisp`, `prezzo`, `Marca`, `fotoLink` FROM `Prodotti` WHERE `tipo`='".$tipo."'";
    return $QUERY;
}
/*Compara il parametro ricercato con nome, marca, tipo, descrizione*/
/*
function queryListaCerca($cerca){
    $QUERY = "SELECT `nome`, `tipo`, `schermo`, `ram`, `cpu`, `hdd`, `so`, `descrizione`, `numDisp`, `prezzo`, `Marca`, `fotoLink` FROM `Prodotti` WHERE `nome` like '%" . $cerca . "%'OR `marca` like '%" . $cerca . "%'OR `tipo` like '%" . $cerca . "%'OR `descrizione` like '%" . $cerca . "%'";
    return $QUERY;
}
    
function queryPerNome($nome){
	$QUERY = "SELECT `nome`, `tipo`, `schermo`, `ram`, `cpu`, `hdd`, `so`, `descrizione`, `numDisp`, `prezzo`, `Marca`, `fotoLink` FROM `Prodotti` WHERE nome = '" . $nome . "'";
        return $QUERY;
}

function queryAggiungi($lista){
    $QUERY = "INSERT INTO `Prodotti`(`nome`, `tipo`, `schermo`, `ram`, `cpu`, `hdd`, `so`, `descrizione`, `numDisp`, `prezzo`, `Marca`, `fotoLink`) VALUES ('".$lista["modello"]."','".$lista["tipo"]."','".$lista["schermo"]."','".$lista["ram"]."','".$lista["cpu"]."','".$lista["hdd"]."','".$lista["so"]."','".$lista["descrizione"]."','".$lista["numDisp"]."','".$lista["prezzo"]."','".$lista["marca"]."','".$lista["fotoLink"]."')";
    return $QUERY;   
}

function queryCancella($nome){
    $QUERY= "DELETE FROM  `Prodotti` WHERE  `nome` =  '".$nome."'";
    return $QUERY;    
}


function queryModifica($lista){
    $QUERY = "UPDATE `Prodotti` SET `nome`='".$lista["modello"]."', `tipo`='".$lista["tipo"]."', `schermo`='".$lista["schermo"]."', `ram`='".$lista["ram"]."', `cpu`='".$lista["cpu"]."', `hdd`='".$lista["hdd"]."', `so`='".$lista["so"]."', `descrizione`='".$lista["descrizione"]."', `numDisp`='".$lista["numDisp"]."', `prezzo`='".$lista["prezzo"]."', `Marca`='".$lista["marca"]."', `fotoLink`='".$lista["fotoLink"]."' WHERE `nome`='".$lista["originalName"]."'";
    return $QUERY;   
}

function queryQta($nome, $qta){
    $QUERY = "UPDATE `Prodotti` SET `numDisp`='".$qta."' WHERE `nome`='".$nome."'";
    return $QUERY; 
}
 * */
?>

