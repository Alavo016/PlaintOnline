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

$user_id = $_SESSION['user_id'];

try {
    $stmt = $pdo->prepare("
    SELECT p.id, c.nom AS categorie, p.titre, p.description, p.statut, p.date_creation, p.priorite 
    FROM plainte p 
    LEFT JOIN categorie_plainte c ON p.categorie_id = c.id 
    WHERE p.plaignant_id = :user_id 
    ORDER BY p.date_creation DESC
    ");

    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $plaintes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>

<div class="main-content">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="text-primary">📜 Liste des Plaintes</h3>
                <a href="add_plainte.php" class="btn btn-outline-dark">➕ Ajouter une plainte</a>
            </div>
            <div class="card shadow-lg">
                <div class="card-body">
                    <?php if (count($plaintes) > 0) : ?>
                        <div class="table-responsive">
                            <table id="tablePlaintes" class="table table-hover table-striped align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Catégorie</th>
                                        <th>Titre</th>
                                        <th>Description</th>
                                        <th>Statut</th>
                                        <th>Date</th>
                                        <th>Priorité</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($plaintes as $plainte) : ?>
                                        <tr>
                                            <td><?= htmlspecialchars($plainte['id']); ?></td>
                                            <td><?= htmlspecialchars($plainte['categorie'] ?? 'Non catégorisé'); ?></td>
                                            <td><?= htmlspecialchars($plainte['titre']); ?></td>
                                            <td title="<?= htmlspecialchars($plainte['description']); ?>">
                                                <?= htmlspecialchars(strlen($plainte['description']) > 70 ? substr($plainte['description'], 0, 70) . '...' : $plainte['description']); ?>
                                            </td>
                                            <td>
                                                <span class="badge bg-<?= $plainte['statut'] == 'En cours' ? 'warning text-dark' : ($plainte['statut'] == 'Résolue' ? 'success' : 'danger') ?>">
                                                    <?= htmlspecialchars($plainte['statut']); ?>
                                                </span>
                                            </td>
                                            <td><?= date("d/m/Y H:i", strtotime($plainte['date_creation'])); ?></td>
                                            <td>
                                                <span class="badge bg-<?= $plainte['priorite'] == 'Haute' ? 'danger' : ($plainte['priorite'] == 'Moyenne' ? 'warning text-dark' : 'primary') ?>">
                                                    <?= htmlspecialchars($plainte['priorite']); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <a href="modifier_plainte.php?id=<?= $plainte['id']; ?>" class="btn btn-outline-primary">✏ Modifier</a>
                                                <a href="supprimer_plainte.php?id=<?= $plainte['id']; ?>" class="btn btn-outline-danger" onclick="return confirm('Voulez-vous supprimer cette plainte ?');">🗑 Supprimer</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else : ?>
                        <div class="alert alert-info text-center">Aucune plainte trouvée.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>