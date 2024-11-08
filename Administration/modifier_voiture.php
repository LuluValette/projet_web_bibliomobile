<?php
// Inclusion des classes nécessaires pour gérer les sessions, l'administration des voitures, et le chargement des images
include_once __DIR__ . '/../class/SessionManager.php';
include_once __DIR__ . '/../class/AdminVoiture.php';
include_once __DIR__ . '/../class/ImageLoader.php';

// Démarrer la session et vérifier si l'utilisateur est connecté
SessionManager::startSession();
if (!SessionManager::estConnecte()) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header('Location: connexion.php');
    exit(); // Arrêter l'exécution du script
}

// Créer une instance de la classe AdminVoiture pour manipuler les données de la voiture
$adminVoiture = new AdminVoiture();
$voiture = null; // Initialiser la variable pour contenir les données de la voiture

// Définir le chemin de l'image par défaut pour la voiture en fonction du nom passé dans l'URL
$imagePath = 'IMGViewer/' . ($_GET['nom'] ?? '') . '.jpg';

// Vérifier si un nom de voiture a été passé dans l'URL
if (isset($_GET['nom'])) {
    // Récupérer et échapper le nom de la voiture pour éviter les injections
    $nom = htmlspecialchars($_GET['nom'], ENT_QUOTES, 'UTF-8');
    // Obtenir les informations de la voiture en utilisant le nom
    $voiture = $adminVoiture->getVoitureByName($nom);
}
?>

<!DOCTYPE html>
<html lang="fr"> <!-- Déclare que la langue principale de la page est le français -->
<head>
    <meta charset="UTF-8"> <!-- Définit l'encodage des caractères en UTF-8 -->
    <title>Modifier Voiture</title> <!-- Titre de la page pour l'onglet du navigateur -->
    <link rel="stylesheet" href="/css/styles.css"> <!-- Lien vers le style général de la page -->
    <link rel="stylesheet" href="/css/administration.css"> <!-- Lien vers le style spécifique pour l'administration -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Inclusion de jQuery -->
</head>
<body>

<h1>Modifier Voiture : <?php echo htmlspecialchars($voiture['nom'] ?? ''); ?></h1> <!-- Titre indiquant la voiture en cours de modification -->

<!-- Formulaire pour mettre à jour les informations de la voiture -->
<form id="updateForm" method="post" enctype="multipart/form-data">
    <!-- Champs cachés pour l'action de mise à jour et le nom de la voiture -->
    <input type="hidden" id="action" name="action" value="update">
    <input type="hidden" id="nom" name="nom" value="<?php echo htmlspecialchars($voiture['nom'] ?? ''); ?>">

    <label>Image actuelle :</label><br>
    <?php if (file_exists($imagePath)): ?>
        <!-- Afficher l'image actuelle de la voiture si elle existe -->
        <img src="<?php echo $imagePath; ?>" alt="Image de la voiture"><br>
    <?php else: ?>
        <!-- Message si aucune image n'est trouvée pour la voiture -->
        <p>Aucune image trouvée.</p>
    <?php endif; ?>

    <!-- Champ pour télécharger une nouvelle image de la voiture -->
    <label for="image">Nouvelle image :</label>
    <input type="file" id="image" name="image"><br><br>

    <!-- Champ pour saisir l'histoire de la voiture -->
    <label for="histoire">Histoire :</label>
    <textarea id="histoire" name="histoire"><?php echo htmlspecialchars($voiture['histoire'] ?? ''); ?></textarea>

    <!-- Champ pour saisir le type de moteur de la voiture -->
    <label for="moteur">Moteur :</label>
    <input type="text" id="moteur" name="moteur" value="<?php echo htmlspecialchars($voiture['moteur'] ?? ''); ?>"><br><br>

    <!-- Champ pour saisir la puissance de la voiture -->
    <label for="puissance">Puissance :</label>
    <input type="text" id="puissance" name="puissance" value="<?php echo htmlspecialchars($voiture['puissance'] ?? ''); ?>"><br><br>

    <!-- Champ pour saisir l'accélération de la voiture -->
    <label for="acceleration">Accélération :</label>
    <input type="text" id="acceleration" name="acceleration" value="<?php echo htmlspecialchars($voiture['acceleration'] ?? ''); ?>"><br><br>

    <!-- Champ pour saisir la vitesse maximale de la voiture -->
    <label for="vitesse">Vitesse :</label>
    <input type="text" id="vitesse" name="vitesse" value="<?php echo htmlspecialchars($voiture['vitesse'] ?? ''); ?>"><br><br>

    <!-- Champ pour saisir toute particularité de la voiture -->
    <label for="particularite">Particularité :</label>
    <textarea id="particularite" name="particularite"><?php echo htmlspecialchars($voiture['particularite'] ?? ''); ?></textarea><br><br>

    <!-- Champ pour saisir le surnom de la voiture -->
    <label for="surnom">Surnom :</label>
    <input type="text" id="surnom" name="surnom" value="<?php echo htmlspecialchars($voiture['surnom'] ?? ''); ?>"><br><br>

    <!-- Champ pour saisir le modèle de la voiture -->
    <label for="modele">Modèle :</label>
    <input type="text" id="modele" name="modele" value="<?php echo htmlspecialchars($voiture['modele'] ?? ''); ?>"><br><br>

    <!-- Champ pour saisir la marque de la voiture -->
    <label for="marque">Marque :</label>
    <input type="text" id="marque" name="marque" value="<?php echo htmlspecialchars($voiture['marque'] ?? ''); ?>"><br><br>

    <!-- Boutons pour mettre à jour ou annuler la modification de la voiture -->
    <button type="button" id="updateButton">Mettre à jour</button>
    <button type="button" onclick="window.location.href='administration.php';">Annuler</button>
</form>

<!-- Inclusion du script JavaScript pour gérer l'interaction de mise à jour -->
<script src="/js/modifier_voiture.js"></script>
</body>
</html>