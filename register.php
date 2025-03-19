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
    } else {
        try {
            // Vérifier si l'email est déjà utilisé
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM plaignant WHERE email = ?");
            $stmt->execute([$email]);
            $count = $stmt->fetchColumn();

            if ($count > 0) {
                $alert = '<div class="alert alert-danger" role="alert">Cet email est déjà enregistré. Veuillez en choisir un autre.</div>';
            } else {
                // Hacher le mot de passe avant l'insertion
                $mdp_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

                // Insérer l'utilisateur dans la base de données
                $stmt = $pdo->prepare("INSERT INTO plaignant (nom, prenom, email, mot_de_passe) VALUES (?, ?, ?, ?)");
                if ($stmt->execute([$nom, $prenom, $email, $mdp_hash])) {
                    header("Location: login.php");
                    exit;
                } else {
                    $alert = '<div class="alert alert-danger" role="alert">Erreur lors de l\'insertion.</div>';
                }
            }
        } catch (PDOException $e) {
            $alert = '<div class="alert alert-danger" role="alert">Erreur PDO : ' . $e->getMessage() . '</div>';
        }
    }
}
?>

<?php include('nav.php'); ?>
        <!--Start Page Banner-->
        <div class="page-banner-area bg-2">
            <div class="container">
                <div class="page-banner-content">
                    <h1>Inscription</h1>
                    <ul>
                        <li><a href="index.html">Acceuil</a></li>
                        <li>Inscription</li>
                    </ul>
                </div>
            </div>
        </div>
        <!--End Page Banner-->

<!-- Start Register Area -->
<div class="register-area pt-100 pb-70">
    <div class="container">
        <div class="register">
            <h3>Inscription</h3>

            <!-- Affichage des alertes ici après la bannière -->
            <?php echo $alert; ?>

            <form method="post" action="">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <input type="email" id="email" class="form-control" placeholder="Email*" name="email" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <input type="text" id="name" class="form-control" placeholder="Nom*" name="nom" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
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
<!-- End Register Area -->

<?php include('footer.php'); ?>
