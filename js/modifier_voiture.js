$(document).ready(function() {
    // Au clic sur le bouton de mise à jour
    $('#updateButton').click(function(e) {
        e.preventDefault(); // Empêche l'envoi classique du formulaire

        // Récupère les données du formulaire, y compris l'image, en utilisant FormData
        var formData = new FormData($('#updateForm')[0]);

        // Envoi d'une requête AJAX pour la mise à jour des données
        $.ajax({
            url: 'modifier_voiture_ajax.php', // URL du script côté serveur pour la mise à jour
            type: 'POST', // Type de requête
            data: formData, // Données envoyées : toutes les données du formulaire
            contentType: false, // Empêche jQuery de définir le contentType
            processData: false, // Empêche le traitement automatique des données
            success: function(response) {
                alert(response); // Affiche le message de succès
                window.location.href = "administration.php"; // Redirige vers la page d'administration
            },
            error: function() {
                alert('Erreur lors de la mise à jour.'); // Message d'erreur en cas d'échec
            }
        });
    });
});