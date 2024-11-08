<?php

class ImageLoader {
    // Chemin absolu vers le fichier XML contenant les informations des images
    private static $xmlFile = __DIR__ . '/../all/IMGViewer.xml';

    /**
     * Fonction pour normaliser le nom d'une voiture en enlevant les accents et en passant en minuscules
     *
     * @param string $name Le nom à normaliser
     * @return string Le nom normalisé
     */
    private static function normalizeName($name) {
        // Convertir le nom en minuscules et retirer les espaces autour
        $name = strtolower(trim($name));

        // Remplacer les caractères accentués par leurs équivalents non accentués
        $name = str_replace(
            ['é', 'è', 'ê', 'ë', 'à', 'â', 'ä', 'î', 'ï', 'ô', 'ö', 'ù', 'û', 'ü', 'ç'],
            ['e', 'e', 'e', 'e', 'a', 'a', 'a', 'i', 'i', 'o', 'o', 'u', 'u', 'u', 'c'],
            $name
        );
        return $name;
    }

    /**
     * Récupère toutes les images du fichier XML sous forme de tableau avec URL et description.
     *
     * @return array Tableau contenant les informations de chaque image
     */
    public static function getAllImages() {
        $carImages = [];

        // Vérifie si le fichier XML existe, sinon retourne un message d'erreur
        if (!file_exists(self::$xmlFile)) {
            return ['error' => 'Erreur : fichier XML introuvable.'];
        }

        // Charge le fichier XML
        $xml = simplexml_load_file(self::$xmlFile);
        if ($xml === false) {
            return ['error' => 'Erreur : échec du chargement du fichier XML.'];
        }

        // Parcourt chaque élément image dans le fichier XML pour extraire l'URL et la description
        foreach ($xml->image as $image) {
            $carImages[] = [
                'url' => (string) $image->url,
                'alt' => (string) $image->alt
            ];
        }

        // Retourne un tableau contenant les URL et descriptions des images
        return $carImages;
    }

    /**
     * Récupère l'image correspondant au nom de voiture donné ou une image par défaut si introuvable.
     *
     * @param string $carName Le nom de la voiture pour rechercher l'image
     * @return array Tableau avec URL et description de l'image ou une image par défaut
     */
    public static function getImageByName($carName) {
        // Chemin de l'image par défaut si aucune image correspondante n'est trouvée
        $defaultImage = [
            'url' => '/path/to/default/image.jpg', // Remplacez par le chemin réel de l'image par défaut
            'alt' => 'Image par défaut'
        ];

        // Vérifie si le fichier XML existe et peut être chargé
        if (!file_exists(self::$xmlFile)) {
            return $defaultImage;
        }

        // Charge le fichier XML
        $xml = simplexml_load_file(self::$xmlFile);
        if ($xml === false) {
            return $defaultImage;
        }

        // Normalise le nom de la voiture pour faciliter la recherche
        $carName = self::normalizeName($carName);

        // Recherche une image correspondant au nom de la voiture
        foreach ($xml->image as $image) {
            $imageURL = strtolower((string) $image->url);
            // Vérifie si le nom de la voiture normalisé est présent dans l'URL de l'image
            if (strpos($imageURL, $carName) !== false) {
                return [
                    'url' => (string) $image->url,
                    'alt' => (string) $image->alt
                ];
            }
        }

        // Retourne l'image par défaut si aucune correspondance n'est trouvée
        return $defaultImage;
    }
}
?>