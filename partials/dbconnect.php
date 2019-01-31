<?php

try {
    $database = new PDO('mysql:host=localhost;dbname=rat-web', 'root', 'root');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}