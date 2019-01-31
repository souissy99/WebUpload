<!DOCTYPE html>
<?php
session_start();

require_once 'dbconnect.php';

if (isset($_POST['Connexion'])) {
    $pseudoco = htmlspecialchars($_POST['pseudo']);
    $passwordco = sha1($_POST['password']);
    if (!empty($pseudoco) && !empty($passwordco)) {
        $requser = $database->prepare("SELECT * FROM users WHERE pseudo = ? && password = ?");
        $requser->execute(array($pseudoco, $passwordco));
        $existuser = $requser->rowCount();
        if ($existuser == 1) {
            $infouser = $requser->fetch();
            $_SESSION['id'] = $infouser['id'];
            $_SESSION['pseudo'] = $infouser['pseudo'];
            $_SESSION['connect'] = 1;
                header("Location: ../index.php?id=" . $_SESSION['id']);
        } else {
            $erreur = "Pseudo/Mot de passe invalide";
        }
    } else {
        $erreur = "Veuillez remplir tous les champs";
    }
}
?>

<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="../assets/styles/inscription.css" type="text/css">

    <title>Space Cook</title>
</head>

<body>
<div>
    <form method="POST">
        Votre Pseudo:
        <input type="text" name="pseudo">
        <br>
        Votre Mot de passe:
        <input type="password" name="password">
        <br>
        <input type="submit" name="Connexion" value="Se connecter">
    </form>
    <?php
    if (isset($erreur)) {
        echo '<p class="err">' . $erreur . "</p>";
    }
    ?>
    <a href="inscription.php">Inscrivez-vous</a>
</div>


</body>

</html>