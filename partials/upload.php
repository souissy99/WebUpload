<!DOCTYPE html>

<?php

session_start();
require_once 'dbconnect.php';

$extensions_image = array('jpg', 'jpeg', 'gif', 'png');
$extensions_document = array('pdf', 'doc', 'docx');

if (isset ($_POST['submit'])) {
    if ($_FILES['fichier']['error'] > 0) {
        echo "Erreur lors du tranfert";
    } else {
        $extension_upload = strtolower(substr(strrchr($_FILES['fichier']['name'], '.'), 1));
        $nom = $_FILES['fichier']['name'];
        $chemin = $_FILES['fichier']['tmp_name'];

        if (in_array($extension_upload, $extensions_image)) {
            $type = "Image";
        } elseif (in_array($extension_upload, $extensions_document)) {
            $type = "Document";
        } else {
            $type = "Autre";
        }
        $reauete = "INSERT INTO `rat-web`.`file` (`ID`, `nom`, `type`, `chemin`) VALUES (NULL, ?, ?, ?);";
        $inserto = $database->prepare($reauete);
        $inserto->execute(array($nom, $type, $chemin));
    }
}

?>

<html>

<head>
    <link rel="stylesheet" href="../assets/styles/inscription.css" type="text/css">
</head>

<body>

<div>
    <form method="post" enctype="multipart/form-data">
        Votre fichier :
        <input type="file" name="fichier">
        <input type="submit" name="submit" value="Envoyer">
    </form>
</div>

</body>

</html>