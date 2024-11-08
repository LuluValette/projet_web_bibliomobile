<?php
// Inclusion de la classe Voiture pour accéder aux informations spécifiques d'une voiture
include_once 'class/Voiture.php';

// Vérifier si le nom de la voiture est passé dans l'URL
if (isset($_GET['nom'])) {
    // Décoder et nettoyer le nom de la voiture depuis l'URL pour éviter les erreurs dues aux espaces et caractères spéciaux
    $nomVoiture = trim(urldecode($_GET['nom']));
} else {
    // Si aucun nom n'est passé, rediriger vers la page d'accueil et arrêter le script
    header('Location: index.php');
    exit();
}

// Créer une instance de la classe Voiture en passant le nom pour récupérer les données de la voiture
$voiture = new Voiture($nomVoiture);

// Vérifier si l'objet $voiture contient un nom valide, sinon afficher un message d'erreur
if ($voiture->getNom() === null) {
    echo "Aucune information trouvée pour la voiture : " . htmlspecialchars($nomVoiture);
    exit(); // Terminer le script si la voiture n'est pas trouvée
}

// Définir le titre de la page en fonction du nom de la voiture et récupérer ses détails
$pageTitle = strtolower($voiture->getNom());
$nomVoiture = $voiture->getNom();
$histoireVoiture = $voiture->getHistoire();
$moteurVoiture = $voiture->getMoteur();
$puissanceVoiture = $voiture->getPuissance();
$accelerationVoiture = $voiture->getAcceleration();
$vitesseMaxVoiture = $voiture->getVitesseMax();
$particulariteVoiture = $voiture->getParticularite();
$imageVoiture = $voiture->getImageHtml();
$surnomVoiture = $voiture->getSurnom();
?>

<!DOCTYPE html>
<html lang="fr"> <!-- Document HTML avec langue définie en français -->
<head>
    <meta charset="UTF-8"> <!-- Encodage des caractères en UTF-8 pour gérer les caractères spéciaux -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Rendre le site responsive pour les appareils mobiles -->
    <title><?php echo htmlspecialchars($pageTitle); ?></title> <!-- Titre de la page affiché dans l'onglet du navigateur -->

    <!-- Lien vers le fichier CSS principal pour styliser la page -->
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

<header>
    <!-- Titre principal affichant le nom de la voiture, ou un message par défaut si le nom est inconnu -->
    <h1><?php echo htmlspecialchars($voiture->getNom() ?? 'Voiture inconnue'); ?></h1>

    <!-- Inclusion du menu de navigation principal -->
    <?php include 'all/menu.php'; ?>
</header>

<section id="presentation">
    <div class="presentation-content">
        <?php if ($nomVoiture): ?>
            <!-- Table pour afficher les informations détaillées de la voiture -->
            <table>
                <tr>
                    <!-- Description de l'histoire de la voiture -->
                    <td><p><?php echo htmlspecialchars($histoireVoiture); ?></p></td>
                </tr>
                <tr>
                    <td>
                        <table>
                            <tr>
                                <td>
                                    <!-- Spécifications techniques de la voiture (moteur, puissance, etc.) -->
                                    <p>
                                        • Moteur : <?php echo htmlspecialchars($moteurVoiture); ?><br/>
                                        • Puissance : <?php echo htmlspecialchars($puissanceVoiture); ?><br/>
                                        • 0-100 km/h : <?php echo htmlspecialchars($accelerationVoiture); ?><br/>
                                        • Vitesse maximale : <?php echo htmlspecialchars($vitesseMaxVoiture); ?><br/>
                                        • Particularité : <?php echo htmlspecialchars($particulariteVoiture); ?>
                                    </p>
                                </td>
                                <td>
                                    <?php
                                    // Affichage de l'image de la voiture en utilisant l'élément HTML généré par getImageHtml()
                                    echo $imageVoiture;
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <!-- Surnom ou autre particularité de la voiture -->
                    <td><p><?php echo htmlspecialchars($surnomVoiture) ?></p></td>
                </tr>
            </table>
        <?php else: ?>
            <!-- Message d'erreur si aucune information sur la voiture n'est trouvée -->
            <p>Aucune information trouvée pour la voiture : <?php echo htmlspecialchars($nomVoiture); ?></p>
        <?php endif; ?>
    </div>
</section>

<!-- Inclusion du pied de page -->
<?php include 'all/footer.php'; ?>

</body>
</html>