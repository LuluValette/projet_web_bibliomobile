<?php
// Inclusion des classes nécessaires pour la gestion des sessions et l'administration des voitures
include_once __DIR__ . '/../class/SessionManager.php';
include_once __DIR__ . '/../class/AdminVoiture.php';

// Démarrer la session et vérifier si l'utilisateur est connecté
SessionManager::startSession();
if (!SessionManager::estConnecte()) {
    // Si l'utilisateur n'est pas connecté, renvoyer un message JSON indiquant une erreur d'autorisation
    echo json_encode(['message' => 'Non autorisé']);
    exit(); // Terminer le script pour éviter tout traitement ultérieur
}

// Vérifier que la requête est de type POST et qu'un nom de voiture est spécifié dans les données POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nom'])) {
    // Créer une instance de la classe AdminVoiture pour manipuler les données de la voiture
    $adminVoiture = new AdminVoiture();
    // Récupérer le nom de la voiture depuis les données POST
    $nomVoiture = $_POST['nom'];

    // Supprimer la voiture spécifiée
    try {
        // Appeler la méthode supprimerVoitureComplet pour supprimer la voiture de la base de données
        $adminVoiture->supprimerVoitureComplet($nomVoiture);

        // Si la suppression est réussie, envoyer un message JSON de confirmation
        echo json_encode(['message' => "La voiture $nomVoiture a été supprimée avec succès."]);
    } catch (Exception $e) {
        // En cas d'erreur, envoyer un message JSON avec les détails de l'erreur
        echo json_encode(['message' => "Erreur lors de la suppression : " . $e->getMessage()]);
    }
} else {
    // Si la requête est invalide, envoyer un message JSON indiquant une erreur
    echo json_encode(['message' => 'Requête invalide']);
}
?>