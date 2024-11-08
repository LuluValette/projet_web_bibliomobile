<?php
// class/Voiture.php

include_once 'AdminVoiture.php';

class Voiture {
    private $nom = null;
    private $histoire = null;
    private $moteur = null;
    private $puissance = null;
    private $acceleration = null;
    private $vitesseMax = null;
    private $particularite = null;
    private $surnom = null;
    private $modele = null;
    private $marque = null;
    private $imageHtml = null;

    /**
     * Constructeur qui initialise les informations de la voiture en fonction du nom donné
     *
     * @param string $nomVoiture Le nom de la voiture
     */
    public function __construct($nomVoiture) {
        $this->loadCarInfo($nomVoiture);
    }

    /**
     * Charge les informations de la voiture depuis la base de données
     *
     * @param string $nomVoiture Le nom de la voiture
     */
    private function loadCarInfo($nomVoiture) {
        // Créer une instance de AdminVoiture pour accéder aux informations de la voiture
        $adminVoiture = new AdminVoiture();
        $carInfo = $adminVoiture->getVoitureByName($nomVoiture);

        // Si des informations sont trouvées, les assigner aux propriétés
        if ($carInfo && is_array($carInfo)) {
            $this->nom = $carInfo['nom'] ?? null;
            $this->histoire = $carInfo['histoire'] ?? null;
            $this->moteur = $carInfo['moteur'] ?? null;
            $this->puissance = $carInfo['puissance'] ?? null;
            $this->acceleration = $carInfo['acceleration'] ?? null;
            $this->vitesseMax = $carInfo['vitesse'] ?? null;
            $this->particularite = $carInfo['particularite'] ?? null;
            $this->surnom = $carInfo['surnom'] ?? null;
            $this->modele = $carInfo['modele'] ?? null;
            $this->marque = $carInfo['marque'] ?? null;
            $this->imageHtml = $carInfo['imageHtml'] ?? '<p>Image non disponible</p>';
        } else {
            $this->imageHtml = '<p>Image non disponible</p>';
        }
    }

    // Getters pour chaque propriété
    public function getNom() { return $this->nom; }
    public function getHistoire() { return $this->histoire; }
    public function getMoteur() { return $this->moteur; }
    public function getPuissance() { return $this->puissance; }
    public function getAcceleration() { return $this->acceleration; }
    public function getVitesseMax() { return $this->vitesseMax; }
    public function getParticularite() { return $this->particularite; }
    public function getSurnom() { return $this->surnom; }
    public function getModele() { return $this->modele; }
    public function getMarque() { return $this->marque; }
    public function getImageHtml() { return $this->imageHtml; }
}
?>