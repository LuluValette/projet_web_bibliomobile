$(document).on('click', '.delete-voiture', function(e) {
    e.preventDefault(); // Empêche l'action par défaut du lien

    const voitureNom = $(this).data('nom'); // Récupère le nom de la voiture à partir de l'attribut data

    // Demande de confirmation avant la suppression
    if (confirm(`Êtes-vous sûr de vouloir supprimer ${voitureNom} ?`)) {
        // Envoi d'une requête AJAX pour supprimer la voiture
        $.ajax({
            url: 'supprimer_voiture.php', // URL du script côté serveur
            type: 'POST', // Type de requête
            data: { nom: voitureNom }, // Données envoyées : le nom de la voiture
            success: function(response) {
                alert(response.message); // Affiche le message de réponse
                location.reload(); // Recharge la page après suppression
            },
            error: function() {
                alert("Erreur lors de la suppression de la voiture."); // Message d'erreur en cas d'échec
            }
        });
    }
});