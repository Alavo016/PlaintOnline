<?php
session_start(); // Démarrer la session

// Détruire toutes les sessions
session_unset();
session_destroy();

// Rediriger vers la page de connexion
header("Location: ../login.php"); 
exit();
?>
