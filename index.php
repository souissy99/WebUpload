<!DOCTYPE html>

<?php

session_start();

?>

<html>
<head>

</head>

<body>


<?php
if (isset($_SESSION['connect'])) {
    ?>
    <a href="partials/gestion.php">GESTION</a>
    <a href="partials/upload.php">UPLOAD</a>
    <a href="partials/deconnexion.php">Déconnexion</a>
    <?php
} else {
    ?>
    <a href="partials/connexion.php">Connecter vous</a>
    <?php
}
?>
</body>


</html>