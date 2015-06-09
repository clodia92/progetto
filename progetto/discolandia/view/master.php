<?php
include_once 'ViewDescriptor.php';
include_once basename(__DIR__) . '/../Settings.php'; 
?>
<!DOCTYPE html>
<!-- 
     pagina master, contiene tutto il layout della applicazione 
     le varie pagine vengono caricate a "pezzi" a seconda della zona
     del layout:
     - logo (header)
     - leftBar (sidebar sinistra)
     - content (la parte centrale con il contenuto)
     - rightBar (sidebar destra)

      Queste informazioni sono manentute in una struttura dati, chiamata ViewDescriptor
      la classe contiene anche le stringhe per i messaggi di feedback per 
      l'utente (errori e conferme delle operazioni)
-->
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title><?= $vd->getTitolo() ?></title>
        <base href="<?= Settings::getApplicationPath() ?>"/>
        <meta name="keywords" content="Discolandia" />
        <meta name="description" content="Una pagina per l'acquisto di cd" />
        <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
        <link href="../discolandia/css/grafica.css" rel="stylesheet" type="text/css" media="screen" />
       

    </head>
    <body>
        <div id="page">
            <!--  header -->
            <div id="header">
                <?php
                    $header = $vd->getHeaderFile();
                    require "$header";
                    ?>
            </div>

            <!-- start page -->
            <!--  sidebar 1 -->
            <div id="leftBar">
               
                        <?php
                        $left = $vd->getLeftBarFile();
                        require "$left";
                        ?>
                   
            </div>

            <div id="rightBar">
                <?php
                $right = $vd->getRightBarFile();
                require "$right";
                ?>

            </div>

            <!-- contenuto -->
            <div id="content">
                <?php
                if ($vd->getMessaggioErrore() != null) {
                    ?>
                    <div>
                        <div>
                            <?=
                            $vd->getMessaggioErrore();
                            ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <?php
                if ($vd->getMessaggioConferma() != null) {
                    ?>
                    <div>
                        <div>
                            <?=
                            $vd->getMessaggioConferma();
                            ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <?php
                $content = $vd->getContentFile();
                require "$content";
                ?>


            </div>

        </div>
    </body>
</html>
