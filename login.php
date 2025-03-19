<?php
session_start();
include('config.php'); // Connexion à la base de données

$erreur = ""; // Stocke le message d'erreur
$success = ""; // Stocke le message de succès

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $mot_de_passe = trim($_POST['mot_de_passe']);

    if (!empty($email) && !empty($mot_de_passe)) {
        // Requête sécurisée avec PDO
        $sql = "SELECT id, nom, email, mot_de_passe, statut, type FROM plaignant WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch();

            // Vérification si le compte est inactif
            if ($user['statut'] != 'Actif') {
                $_SESSION['confirmation_email'] = $user['email']; // Stocker l'email pour la confirmation
                $erreur = "Compte non activé. Veuillez vérifier votre mail afin de saisir le code de confirmation.";
                echo "<meta http-equiv='refresh' content='2;url=confirmation.php'>";
            } 
            // Vérification du mot de passe
            elseif (password_verify($mot_de_passe, $user['mot_de_passe'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['nom'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_statut'] = $user['statut'];
                $_SESSION['user_type'] = $user['type'];

                // Gestion du "Se souvenir de moi"
                if (isset($_POST['remember_me'])) {
                    setcookie("user_email", $email, time() + (86400 * 30), "/");
                    setcookie("user_name", $user['nom'], time() + (86400 * 30), "/");
                    setcookie("user_statut", $user['statut'], time() + (86400 * 30), "/");
                    setcookie("user_type", $user['type'], time() + (86400 * 30), "/");
                }

                $success = "Connexion réussie ! Redirection...";
                echo "<meta http-equiv='refresh' content='3;url=plaignant/liste_plainte.php'>";
            } else {
                $erreur = "Mot de passe incorrect.";
            }
        } else {
            $erreur = "Aucun compte trouvé avec cette adresse e-mail.";
        }
    } else {
        $erreur = "Veuillez remplir tous les champs.";
    }
}
?>

<!-- HTML de connexion -->
<?php include('nav.php'); ?>

<div class="login-area pt-100 pb-70">
    <div class="container">
        <div class="login">
            <h3>Connexion</h3>

            <!-- Affichage des messages -->
            <?php if (!empty($erreur)) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Erreur :</strong> <?= $erreur ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>

            <?php if (!empty($success)) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Succès :</strong> <?= $success ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>

            <form method="post">
                <div class="form-group">
                    <label for="email">Adresse e-mail </label>
                    <input type="email" id="email" class="form-control" placeholder="Adresse e-mail*" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" class="form-control" placeholder="Mot de passe*" name="mot_de_passe" required>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember_me" id="flexCheckDefault" value="1">
                    <label class="form-check-label" for="flexCheckDefault">
                        Se souvenir de moi
                    </label>
                </div>
                <button type="submit" class="default-btn btn active">Se connecter</button>
                <a href="recover-password.html">Mot de passe oublié ?</a>
            </form>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
