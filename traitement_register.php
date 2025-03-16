<?php
// Activer l'affichage des erreurs PHP
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inclure le fichier de connexion à la base de données
include "config.php";

$alert = ""; // Variable pour stocker l'alerte

// Vérifier si la connexion PDO existe
if (!isset($pdo)) {
    die("Erreur de connexion à la base de données !");
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer et nettoyer les données du formulaire
    $nom = htmlspecialchars(trim($_POST["nom"]));
    $prenom = htmlspecialchars(trim($_POST["prenom"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $mot_de_passe = $_POST["mot_de_passe"];
    $confirm_mot_de_passe = $_POST["confirm_mot_de_passe"];

    // Vérifier si les mots de passe correspondent
    if ($confirm_mot_de_passe !== $mot_de_passe) {
        $alert = '<div class="alert alert-danger" role="alert">Les mots de passe ne correspondent pas. Veuillez réessayer.</div>';
        echo $alert; // Afficher immédiatement
    } else {
        try {
            // Vérifier si l'email est déjà utilisé
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM plaignant WHERE email = ?");
            $stmt->execute([$email]);
            $count = $stmt->fetchColumn();

            if ($count > 0) {
                $alert = '<div class="alert alert-danger" role="alert">Cet email est déjà enregistré. Veuillez en choisir un autre.</div>';
                echo $alert; // Afficher immédiatement
            } else {
                // Hacher le mot de passe avant l'insertion
                $mdp_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

                // Insérer l'utilisateur dans la base de données
                $stmt = $pdo->prepare("INSERT INTO plaignant (nom, prenom, email, mot_de_passe) VALUES (?, ?, ?, ?)");
                if ($stmt->execute([$nom, $prenom, $email, $mdp_hash])) {
                    header("Location: login.php");
                    exit;
                } else {
                    echo '<div class="alert alert-danger" role="alert">Erreur lors de l\'insertion.</div>';
                }
            }
        } catch (PDOException $e) {
            echo '<div class="alert alert-danger" role="alert">Erreur PDO : ' . $e->getMessage() . '</div>';
        }
    }
}
?>
