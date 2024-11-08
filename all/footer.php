<!-- Lien vers le fichier CSS pour le style du footer -->
<link rel="stylesheet" href="../css/footer.css">

<footer>
    <div class="footer-content">
        <!-- Titre de la section de contact dans le footer -->
        <h2>Contactez-nous</h2>

        <?php
        // Inclusion du fichier PHP 'recuperer_contact.php' pour charger les informations de contact (téléphone, email, adresse)
        include 'recuperer_contact.php';
        ?>

        <!-- Tableau pour organiser les informations de contact en trois colonnes -->
        <table>
            <tr>
                <!-- Afficher le numéro de téléphone avec un lien cliquable pour appeler directement -->
                <td><p>Téléphone : <a href="tel:<?php echo htmlspecialchars($phone); ?>"><?php echo htmlspecialchars($phone); ?></a></p></td>

                <!-- Afficher l'email avec un lien cliquable pour ouvrir une fenêtre de messagerie -->
                <td><p>Email : <a href="mailto:<?php echo htmlspecialchars($mail); ?>"><?php echo htmlspecialchars($mail); ?></a></p></td>

                <!-- Afficher l'adresse physique de l'organisation -->
                <td><p>Adresse : <?php echo htmlspecialchars($address); ?></p></td>
            </tr>
        </table>

        <!-- Ajout d'un lien vers la page d'administration, centré dans le footer -->
        <div style="text-align: center; margin-top: 20px;">
            <a href="../Administration/administration.php">Administration</a>
        </div>
    </div>
</footer>