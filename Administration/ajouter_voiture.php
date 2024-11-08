<?php
// Inclusion des classes nécessaires pour gérer les sessions et l'administration des voitures
include_once __DIR__ . '/../class/SessionManager.php';
include_once __DIR__ . '/../class/AdminVoiture.php';

// Démarrer une session et vérifier si l'utilisateur est connecté
SessionManager::startSession();
if (!SessionManager::estConnecte()) {
    // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
    header('Location: connexion.php');
    exit();
}

// Vérifier si le formulaire a été soumis en méthode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Créer une instance de la classe AdminVoiture pour ajouter une nouvelle voiture
    $adminVoiture = new AdminVoiture();

    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $histoire = $_POST['histoire'];
    $moteur = $_POST['moteur'];
    $puissance = $_POST['puissance'];
    $acceleration = $_POST['acceleration'];
    $vitesse = $_POST['vitesse'];
    $particularite = $_POST['particularite'];
    $surnom = $_POST['surnom'];
    $modele = $_POST['modele'];
    $marque = $_POST['marque'];

    // Récupérer le fichier image téléchargé s'il est présent
    $imageFile = $_FILES['image'] ?? null;

    // Appeler la méthode ajouterVoiture pour enregistrer la nouvelle voiture avec son image
    $adminVoiture->ajouterVoiture($nom, $histoire, $moteur, $puissance, $acceleration, $vitesse, $particularite, $surnom, $modele, $marque, $imageFile);

    // Rediriger vers la page d'administration après l'ajout de la voiture
    header('Location: administration.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr"> <!-- Déclare que la langue principale de la page est le français -->
<head>
    <meta charset="UTF-8"> <!-- Définit l'encodage des caractères en UTF-8 -->
    <title>Ajouter Voiture</title> <!-- Titre de la page affiché dans l'onglet du navigateur -->
    <link rel="stylesheet" href="/css/styles.css"> <!-- Lien vers le fichier CSS principal pour styliser la page -->
</head>
<body>

<!-- Titre principal de la page indiquant l'ajout d'une nouvelle voiture -->
<h1>Ajouter une nouvelle voiture</h1>

<!-- Formulaire pour saisir les informations de la voiture -->
<form method="post" enctype="multipart/form-data"> <!-- Utilisation de l'enctype pour permettre le téléchargement de fichiers -->
    <label>Nom :</label><input type="text" name="nom" required><br> <!-- Champ pour le nom de la voiture (obligatoire) -->
    <label>Histoire :</label><textarea name="histoire"></textarea><br> <!-- Champ pour l'histoire de la voiture -->
    <label>Moteur :</label><input type="text" name="moteur"><br> <!-- Champ pour le type de moteur -->
    <label>Puissance :</label><input type="text" name="puissance"><br> <!-- Champ pour la puissance de la voiture -->
    <label>Accélération :</label><input type="text" name="acceleration"><br> <!-- Champ pour l'accélération de 0 à 100 km/h -->
    <label>Vitesse :</label><input type="text" name="vitesse"><br> <!-- Champ pour la vitesse maximale -->
    <label>Particularité :</label><textarea name="particularite"></textarea><br> <!-- Champ pour toute particularité de la voiture -->
    <label>Surnom :</label><input type="text" name="surnom"><br> <!-- Champ pour le surnom de la voiture -->
    <label>Modèle :</label><input type="text" name="modele"><br> <!-- Champ pour le modèle de la voiture -->
    <label>Marque :</label><input type="text" name="marque"><br> <!-- Champ pour la marque de la voiture -->
    <label>Image :</label><input type="file" name="image" required><br> <!-- Champ pour télécharger une image (obligatoire) -->

    <!-- Bouton pour soumettre le formulaire et ajouter la voiture -->
    <button type="submit">Ajouter la voiture</button>
</form>

</body>
</html>