<?php
$host = "localhost"; // Change selon ton serveur
$dbname = "plaint"; // Nom de ta base
$username = "root"; // Ton utilisateur MySQL
$password = ""; // Ton mot de passe MySQL

try {
    // Connexion PDO avec activation des erreurs
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Activer les erreurs PDO
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Mode de récupération par défaut
        PDO::ATTR_EMULATE_PREPARES => false // Sécurisation des requêtes préparées
    ]);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
