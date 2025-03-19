<?php
// Activer l'affichage des erreurs PHP
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inclure le fichier de connexion à la base de données
include "config.php";
require 'vendor/autoload.php'; // Charger PHPMailer via Composer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
        $alert = '<div class="alert alert-danger">Les mots de passe ne correspondent pas.</div>';
    } else {
        try {
            // Vérifier si l'email est déjà utilisé
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM plaignant WHERE email = ?");
            $stmt->execute([$email]);
            $count = $stmt->fetchColumn();

            if ($count > 0) {
                $alert = '<div class="alert alert-danger">Cet email est déjà utilisé.</div>';
            } else {
                // Hacher le mot de passe avant l'insertion
                $mdp_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

                // Générer un code de confirmation à 6 chiffres
                $confirmation_code = mt_rand(100000, 999999);

                // Insérer l'utilisateur dans la base de données avec un statut "Inactif"
                $stmt = $pdo->prepare("INSERT INTO plaignant (nom, prenom, email, mot_de_passe, statut, confirmation_code) VALUES (?, ?, ?, ?, ?, ?)");
                if ($stmt->execute([$nom, $prenom, $email, $mdp_hash, "Inactif", $confirmation_code])) {

                    // Envoi de l'e-mail de confirmation
                    $mail = new PHPMailer(true);
                    try {
                        // Configuration du serveur SMTP
                        $mail->isSMTP();
                        $mail->Host       = 'sandbox.smtp.mailtrap.io';
                        $mail->SMTPAuth   = true;
                        $mail->Username   = 'bf51506d3a4497';
                        $mail->Password   = 'a8a5efb8d5d5dc'; // Remplace par ton mot de passe réel
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port       = 587;

                        // Paramètres de l'e-mail
                        $mail->setFrom('no-reply@tonsite.com', 'Mon Site');
                        $mail->addAddress($email, "$prenom $nom");
                        $mail->Subject = 'Confirmation de votre inscription';
                        $mail->isHTML(true);
                        $mail->Body    = "
                            <h1>Bienvenue $prenom !</h1>
                            <p>Merci de vous être inscrit. Voici votre code de confirmation :</p>
                            <h2 style='color:blue;'>$confirmation_code</h2>
                            <p>Veuillez entrer ce code sur la page de confirmation pour activer votre compte.</p>
                        ";

                        $mail->send();

                        // Redirection vers la page de confirmation
                        header("Location: confirmation.php?email=" . urlencode($email));
                        exit;
                    } catch (Exception $e) {
                        $alert = '<div class="alert alert-danger">Erreur lors de l\'envoi de l\'e-mail : ' . $mail->ErrorInfo . '</div>';
                    }
                } else {
                    $alert = '<div class="alert alert-danger">Erreur lors de l\'inscription.</div>';
                }
            }
        } catch (PDOException $e) {
            $alert = '<div class="alert alert-danger">Erreur PDO : ' . $e->getMessage() . '</div>';
        }
    }
}
?>

<?php include('nav.php'); ?>
<div class="register-area pt-100 pb-70">
    <div class="container">
        <div class="register">
            <h3>Inscription</h3>

            <!-- Affichage des alertes ici -->
            <?php echo $alert; ?>

            <form method="post" action="">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <input type="email" id="email" class="form-control" placeholder="Email*" name="email" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="text" id="name" class="form-control" placeholder="Nom*" name="nom" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="text" id="lname" class="form-control" placeholder="Prénom*" name="prenom" required>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <input type="password" id="password2" class="form-control" placeholder="Mot de passe*" name="mot_de_passe" required>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <input type="password" id="password3" class="form-control" placeholder="Confirmer le mot de passe*" name="confirm_mot_de_passe" required>
                        </div>
                    </div>
                </div>
                <button type="submit" class="default-btn btn active">S'inscrire</button>
            </form>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
