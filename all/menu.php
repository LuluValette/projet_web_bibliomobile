<?php
// Inclusion de la classe AdminVoiture pour accéder aux données des voitures par marque
include_once 'class/AdminVoiture.php';

// Création d'une instance de la classe AdminVoiture
$adminVoiture = new AdminVoiture();

// Récupération de la liste des voitures organisées par marque
$voituresParMarque = $adminVoiture->getVoituresParMarque();
?>

<!-- Lien vers le fichier CSS pour styliser le menu de navigation -->
<link rel="stylesheet" href="../css/menu.css">

<!-- Menu de navigation principal -->
<nav id="main-menu">
    <ul class="menu">
        <!-- Lien vers la page d'accueil -->
        <li><a href="../index.php">Accueil</a></li>

        <!-- Menu déroulant pour les voitures organisées par marque -->
        <li>
            <a href="#">Les voitures</a>
            <ul class="sous-menu-marques">
                <?php foreach ($voituresParMarque as $marque => $voitures): ?>
                    <!-- Lien pour chaque marque de voiture -->
                    <li>
                        <a href="#"><?php echo htmlspecialchars($marque); ?></a>

                        <!-- Sous-menu pour les modèles de la marque sélectionnée -->
                        <ul class="submenu right-align">
                            <?php foreach ($voitures as $voiture): ?>
                                <!-- Afficher le modèle de la voiture en tant que texte et créer un lien avec le nom encodé en URL -->
                                <li>
                                    <a href="../voiture.php?nom=<?php echo urlencode($voiture['nom']); ?>">
                                        <?php echo htmlspecialchars($voiture['modele']); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>

        <!-- Lien vers la page de contact -->
        <li><a href="../contact.php">Contact</a></li>
    </ul>
</nav>

<!-- Bouton pour afficher ou masquer le menu sur les petits écrans -->
<button id="menu-toggle">Afficher le menu</button>