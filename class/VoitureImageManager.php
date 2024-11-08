<?php

class VoitureImageManager {

    /**
     * Ajoute une image pour une voiture spécifique et met à jour le fichier XML
     *
     * @param string $nomVoiture Le nom de la voiture
     * @param array $imageFile Le fichier image téléchargé
     * @throws Exception Si l'image ne peut pas être déplacée
     */
    public static function ajouterImage($nomVoiture, $imageFile) {
        $targetDir = __DIR__ . '/../IMGViewer/';
        $newImageName = $nomVoiture . '.avif';
        $targetFile = $targetDir . $newImageName;

        if (move_uploaded_file($imageFile['tmp_name'], $targetFile)) {
            self::ajouterImageXML($nomVoiture, 'IMGViewer/' . $newImageName);
        } else {
            throw new Exception("Erreur lors du déplacement de l'image.");
        }
    }

    /**
     * Supprime l'image d'une voiture spécifique et met à jour le fichier XML
     *
     * @param string $nomVoiture Le nom de la voiture
     */
    public static function supprimerImage($nomVoiture) {
        $imagePath = __DIR__ . '/../IMGViewer/' . $nomVoiture . '.avif';
        if (file_exists($imagePath)) {
            unlink($imagePath); // Supprime le fichier image physique
        }
        self::supprimerImageXML($nomVoiture); // Supprime l'entrée dans le fichier XML
    }

    /**
     * Ajoute une image au fichier XML pour la voiture spécifiée
     *
     * @param string $nomVoiture Le nom de la voiture
     * @param string $imagePath Le chemin de l'image
     */
    private static function ajouterImageXML($nomVoiture, $imagePath) {
        $xmlFile = __DIR__ . '/../all/IMGViewer.xml';

        if (file_exists($xmlFile)) {
            $xml = simplexml_load_file($xmlFile);
        } else {
            $xml = new SimpleXMLElement('<images></images>');
        }

        $newImage = $xml->addChild('image');
        $newImage->addChild('nom', htmlspecialchars($nomVoiture));
        $newImage->addChild('url', htmlspecialchars($imagePath));
        $newImage->addChild('alt', 'Image de ' . htmlspecialchars($nomVoiture));
        $xml->asXML($xmlFile); // Sauvegarde les modifications dans le fichier XML
    }

    /**
     * Supprime une image du fichier XML pour une voiture spécifique
     *
     * @param string $nomVoiture Le nom de la voiture
     * @throws Exception Si le fichier XML est introuvable
     */
    private static function supprimerImageXML($nomVoiture) {
        $xmlFile = __DIR__ . '/../all/IMGViewer.xml';

        if (!file_exists($xmlFile)) {
            throw new Exception("Fichier XML introuvable.");
        }

        $xml = simplexml_load_file($xmlFile);
        foreach ($xml->image as $index => $image) {
            if (strpos((string)$image->url, "IMGViewer/$nomVoiture.avif") !== false) {
                unset($xml->image[$index]); // Supprime l'image du XML
                break;
            }
        }
        $xml->asXML($xmlFile); // Sauvegarde les modifications dans le fichier XML
    }

    /**
     * Modifie l'image associée à une voiture en la remplaçant par une nouvelle
     *
     * @param string $nomVoiture Le nom de la voiture
     * @param array $imageFile Le nouveau fichier image
     */
    public static function modifierImage($nomVoiture, $imageFile) {
        self::supprimerImage($nomVoiture); // Supprime l'ancienne image
        self::ajouterImage($nomVoiture, $imageFile); // Ajoute la nouvelle image
    }
}
?>