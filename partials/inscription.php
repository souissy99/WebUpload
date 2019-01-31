<!DOCTYPE html>

<?php

require_once 'dbconnect.php';

if (isset($_POST['Envoyer'])) {
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $password = sha1($_POST['password']);
    $password2 = sha1($_POST['password2']);

    if (!empty($_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['password2'])) {
        $verif_pseudo = $database->prepare("SELECT * FROM users WHERE pseudo = ?");
        $verif_pseudo->execute(array($pseudo));
        $exist_pseudo = $verif_pseudo->rowCount();

        if ($exist_pseudo == 0) {
            if ($password == $password2) {
                $reauete = "INSERT INTO `rat-web`.`users` (`ID`, `pseudo`, `password`) VALUES (NULL, ?, ?);";
                $inserto = $database->prepare($reauete);
                $inserto->execute(array($pseudo, $password));
                sleep(0.5);
                $erreur = "Votre compte a été créé";
                header("refresh:1;url=../index.php");
            } else {
                $erreur = "Vos mots de passe ne corespondent pas";
            }
        } else {
            $erreur = "Pseudo indisponible";
        }
    } else {
        $erreur = "Veuillez remplire tout les champs s'il vous plait";
    }
}
?>

<html xmlns="http://www.w3.org/1999/html">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="../assets/styles/inscription.css" type="text/css">

    <title>RAT</title>
</head>

<body>
<div>
    <form method="POST">
        Pseudo:
        <input type="text" name="pseudo">
        <br>
        Mot de passe:
        <input type="password" name="password">
        <br>
        Retapez votre mot de passe:
        <input type="password" name="password2">
        <br>
        <input type="submit" name="Envoyer" value="Envoyer">
        <?php
        if (isset($erreur)) {
            echo '<p class="err">' . $erreur . "</p>";
        }
        ?>
    </form>
</div>


</body>

</html>