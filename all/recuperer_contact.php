<?php
// Informations de connexion à la base de données
$host = 'mysql-valette.alwaysdata.net';
$dbname = 'valette_bdd';
$user = 'valette_god';
$password = 'PetitPoney';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // En cas d'erreur de connexion, ne rien afficher pour des raisons de sécurité
    exit("Erreur de connexion à la base de données.");
}

// Préparation et exécution de la requête pour récupérer les informations de contact
$sql = "SELECT * FROM contact";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Vérification que les informations de contact existent
if (!empty($contacts)) {
    $phone = htmlspecialchars($contacts[0]['phone']);
    $mail = htmlspecialchars($contacts[0]['mail']);
    $address = htmlspecialchars($contacts[0]['address']);
} else {
    // Valeurs par défaut si aucun contact n'est trouvé
    $phone = "Non spécifié";
    $mail = "Non spécifié";
    $address = "Non spécifié";
}
?>