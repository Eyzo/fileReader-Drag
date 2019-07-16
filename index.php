<?php
    if (isset($_POST['envoyer'])) {
        $file = $_FILES['fichier'];
        $fileName = $file['name'];
        $fileTmp = $file['tmp_name'];
        $fileType = $file['type'];
        $fileSize = $file['size'];

        $fileDestination = __DIR__ . '/index.php';

        $upload = move_uploaded_file($fileTmp, $fileDestination);
        $lineCSV = [];

        if ($upload) {
            $file = fopen($fileDestination, "r");
            while (($data = fgetcsv($file, 2000, '|')) !== FALSE) {
                $linesCSV[] = $data;
            }
            fclose($file);

            $formatedArray = [];

            //on parcours le tableau de données pour le formater
            foreach ($linesCSV as $singleLineArray) {
                foreach ($singleLineArray as $singleLine) {
                    $line = strtolower($singleLine);
                    $formatedArray[] = explode(";",$line);
                }
            }

            $requete1 = '';
            $requete2 = '';

            for ($i = 0;$i < count($formatedArray);$i++) {

                $id = $formatedArray[$i][0];
                $tarifp = $formatedArray[$i][1];
                $qte = $formatedArray[$i][2];

                if ($i != 0) {
                     $requete1 .= "UPDATE datagroup.article SET tarifFP= $tarifp WHERE id= $id;"."\n";
                     $requete1 .=  "UPDATE datagroup.stock SET qte= $qte WHERE id_article = $id;"."\n";
                }
            }

            echo $requete1;
            echo $requete2;
        }
    }
?>

<html>
<head>
    <title>Je suis une page train jquery-ui</title>
    <link rel="stylesheet" href="jquery-ui-1.12.1.custom/jquery-ui.min.css">
    <link rel="stylesheet" href="asset/style.css">
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="fichier">
        <input type="submit" name="envoyer" value="envoyer">
    </form>

    <div class="container">

        <div class="text-container">
        <h4 class="title">Mini-TP</h4><h5 class="sub-title">Petit panier</h5>
        </div>

        <div class="big-container">
            <div class="article-container">
                <div class="article draggable">Ours en Peluche</div>
                <div class="article draggable">Ordinateur Portable</div>
               <div class="article draggable">Ecran Plasma</div>
                <div class="article draggable">Guitare Electrique</div>
                <div class="article draggable">Bureau en bois</div>
            </div>

            <div class="cart-container">
                <p>Votre panier contient les articles suivants :</p>
            </div>
        </div>

    </div>



    <script src="node_modules/jquery/dist/jquery.js"></script>
    <script src="jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="asset/drag&drop.js"></script>
</body>
</html>