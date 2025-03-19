<?php
// Activer l'affichage des erreurs
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inclure la connexion à la base de données
include "config.php";

$alert = ""; // Message d'alerte

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST["email"]) ? trim($_POST["email"]) : '';
    $code = isset($_POST["confirmation_code"]) ? trim($_POST["confirmation_code"]) : '';
    $type = isset($_POST["type"]) ? trim($_POST["type"]) : '';

    // Vérification des valeurs autorisées pour `type`
    $valid_types = ["Étudiant", "Parent", "Professeur"];

    if (!empty($email) && !empty($code) && in_array($type, $valid_types)) {
        try {
            // Vérifier si l'utilisateur existe avec ce code
            $stmt = $pdo->prepare("SELECT * FROM plaignant WHERE email = ? AND confirmation_code = ?");
            $stmt->execute([$email, $code]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Mettre à jour le statut et le type utilisateur
                $stmt = $pdo->prepare("UPDATE plaignant SET statut = 'Actif', type = ? WHERE email = ?");
                if ($stmt->execute([$type, $email])) {
                    $alert = '<div class="alert alert-success">Votre compte a été activé avec succès !</div>';
                } else {
                    $alert = '<div class="alert alert-danger">Erreur lors de l\'activation.</div>';
                }
            } else {
                $alert = '<div class="alert alert-danger">Code de confirmation invalide.</div>';
            }
        } catch (PDOException $e) {
            $alert = '<div class="alert alert-danger">Erreur : ' . $e->getMessage() . '</div>';
        }
    } else {
        $alert = '<div class="alert alert-danger">Veuillez remplir tous les champs correctement.</div>';
    }
}
?>

<?php include('nav.php'); ?>

<div class="register-area pt-100 pb-70">
    <div class="container">
        <div class="register">
            <h3>Confirmation de compte</h3>
            <?php echo $alert; ?>
            <form method="post" action="">
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Votre email" name="email" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Code de confirmation" name="confirmation_code" required>
                </div>
                <div class="form-group">
                    <select class="form-control" name="type" required>
                        <option value="">-- Sélectionnez votre type --</option>
                        <option value="Étudiant">Étudiant</option>
                        <option value="Parent">Parent</option>
                        <option value="Professeur">Professeur</option>
                    </select>
                </div>
                <button type="submit" class="default-btn btn active">Confirmer</button>
            </form>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
