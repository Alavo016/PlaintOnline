<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

include('../config.php'); // Connexion à la base de données
include('start.php');
include('side.php');
include('nav.php');

// Récupérer les catégories dynamiquement
$query = $pdo->query("SELECT id, nom FROM categorie_plainte");
$categories = $query->fetchAll(PDO::FETCH_ASSOC);

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titre = trim($_POST["titre"]);
    $description = trim($_POST["description"]);
    $categorie_id = !empty($_POST["categorie_id"]) ? $_POST["categorie_id"] : null;
    $statut = "En cours";
    $priorite = "haute"; // Priorité fixe
    $date_creation = date("Y-m-d H:i:s");
    $plaignant_id = $_SESSION['user_id']; // Utilisateur connecté

    // Insérer la plainte en base
    $stmt = $pdo->prepare("INSERT INTO plainte (plaignant_id, categorie_id, titre, description, statut, date_creation, priorite, nbr_relances) 
                           VALUES (?, ?, ?, ?, ?, ?, ?, 0)");
    $stmt->execute([$plaignant_id, $categorie_id, $titre, $description, $statut, $date_creation, $priorite]);
    $plainte_id = $pdo->lastInsertId();

    // Gestion du fichier joint (optionnel)
    if (!empty($_FILES["fichier"]["name"])) {
        $fichier_nom = $_FILES["fichier"]["name"];
        $fichier_type = $_FILES["fichier"]["type"];
        $fichier_taille = $_FILES["fichier"]["size"];
        $fichier_tmp = $_FILES["fichier"]["tmp_name"];
        $fichier_ext = pathinfo($fichier_nom, PATHINFO_EXTENSION);
        $fichier_nom_unique = uniqid("fichier_", true) . "." . $fichier_ext;
        $fichier_url = "uploads/" . $fichier_nom_unique;

        // Vérifier la taille et le type du fichier
        $extensions_autorisees = ["jpg", "jpeg", "png", "pdf", "docx"];
        if (in_array(strtolower($fichier_ext), $extensions_autorisees) && $fichier_taille <= 5 * 1024 * 1024) {
            if (move_uploaded_file($fichier_tmp, $fichier_url)) {
                $stmt = $pdo->prepare("INSERT INTO piece_jointe (plainte_id, fichier_nom, fichier_type, fichier_url, taille_fichier, date_ajout) 
                                       VALUES (?, ?, ?, ?, ?, NOW())");
                $stmt->execute([$plainte_id, $fichier_nom, $fichier_type, $fichier_url, $fichier_taille]);
            }
        }
    }

    echo "<script>alert('Plainte ajoutée avec succès !'); window.location.href = 'liste_plainte.php';</script>";
}
?>

<div class="col-12 mb-20">
    <div class="wg-box">
        <h3>Ajouter une plainte</h3>
        <form action="" method="POST" enctype="multipart/form-data">

            <!-- Titre -->
            <fieldset class="mb-24">
                <label class="body-title mb-10" for="titre">Titre de la plainte <span class="tf-color-1">*</span></label>
                <input type="text" id="titre" name="titre" placeholder="Entrez le titre de la plainte" required>
            </fieldset>

            <!-- Description -->
            <fieldset class="mb-24">
                <label class="body-title mb-10" for="description">Description <span class="tf-color-1">*</span></label>
                <textarea id="description" name="description" placeholder="Décrivez votre plainte en détail" required></textarea>
            </fieldset>

            <!-- Catégorie dynamique -->
            <fieldset class="mb-24">
                <label class="body-title mb-10" for="categorie_id">Catégorie <span class="tf-color-1">*</span></label>
                <select id="categorie_id" name="categorie_id" required>
                    <option value="">-- Sélectionnez une catégorie --</option>
                    <?php foreach ($categories as $categorie) : ?>
                        <option value="<?= htmlspecialchars($categorie['id']) ?>"><?= htmlspecialchars($categorie['nom']) ?></option>
                    <?php endforeach; ?>
                </select>
            </fieldset>

            <!-- Fichier joint (optionnel) -->
            <fieldset class="mb-24">
                <label class="body-title mb-10" for="fichier">Fichier joint (optionnel)</label>
                <label class="uploadfile" for="fichier">
                    <span class="icon"><i class="icon-upload-cloud"></i></span>
                    <span class="text-tiny">Déposez votre fichier ici ou cliquez pour parcourir</span>
                    <input type="file" id="fichier" name="fichier" accept=".jpg,.jpeg,.png,.pdf,.docx" onchange="previewFile(event)">
                </label>
                <div id="filePreview" class="upload-preview"></div>
            </fieldset>

            <!-- Bouton d'envoi -->
            <div class="bot">
                <button class="tf-button w208" type="submit">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

</div>
</div>
</div>
<?php
include('footer.php');
?>