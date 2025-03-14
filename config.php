<?php
// Informations de connexion
$host = "localhost";  // Adresse du serveur (ou 127.0.0.1 pour localhost)
$dbname = "plaint";  // Nom de la base de données
$username = "root";   // Nom d'utilisateur
$password = "";       // Mot de passe (laisser vide en local)

// Connexion à la base de données avec PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
