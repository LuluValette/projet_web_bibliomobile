-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql-valette.alwaysdata.net
-- Généré le : ven. 08 nov. 2024 à 19:03
-- Version du serveur : 10.11.8-MariaDB
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `valette_bdd`
--

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `phone` varchar(15) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`phone`, `mail`, `address`) VALUES
('+33123456789', 'valettel@3il.fr', '5 rue de Bruxelles, 12000 Rodez, France');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `username`, `password`) VALUES
(1, 'admin', 'mdpadmin');

-- --------------------------------------------------------

--
-- Structure de la table `voitures`
--

CREATE TABLE `voitures` (
  `nom` varchar(127) NOT NULL,
  `histoire` varchar(1023) DEFAULT NULL,
  `moteur` varchar(127) DEFAULT NULL,
  `puissance` varchar(127) DEFAULT NULL,
  `acceleration` varchar(127) DEFAULT NULL,
  `vitesse` varchar(127) DEFAULT NULL,
  `particularite` varchar(1023) DEFAULT NULL,
  `surnom` varchar(1023) DEFAULT NULL,
  `modele` varchar(127) NOT NULL,
  `marque` varchar(127) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `voitures`
--

INSERT INTO `voitures` (`nom`, `histoire`, `moteur`, `puissance`, `acceleration`, `vitesse`, `particularite`, `surnom`, `modele`, `marque`) VALUES
('la bete difficile', 'Inspirée par la légendaire Ford GT40 qui a triomphé aux 24 Heures du Mans dans les années 1960, la Ford GT moderne a été lancée en 2005. Elle a été conçue pour célébrer le centenaire de Ford tout en restant fidèle à l’esprit de la course. Malgré son design classique, la Ford GT est une supercar moderne avec un comportement parfois difficile à dompter.', 'V8 suralimenté de 5,4 litres', '550 ch', '3,6 secondes', '330 km/h', 'Sa répartition du poids en position centrale arrière et son châssis rigide la rendent très sensible aux erreurs de conduite.', 'La Ford GT exige une grande maîtrise. En dépit de ses performances impressionnantes, elle est plus exigeante à piloter que certaines de ses concurrentes en raison de sa maniabilité nerveuse et de son moteur brutal.', 'GT', 'Ford'),
('la brutale', 'La Lamborghini Countach, lancée en 1974, est l’une des voitures les plus iconiques des années 70 et 80. Avec son design futuriste et ses portes en élytre, elle a redéfini le concept de supercar. Toutefois, derrière son allure radicale se cachait une voiture difficile à manier, en particulier à haute vitesse.', 'V12 de 3,9 à 5,2 litres', '375 ch à 455 ch', '4,7 secondes', '300 km/h', 'Châssis large, suspension rigide et manque de visibilité arrière.', 'La Countach est surnommée “brutale” en raison de sa suspension rigide et de son ergonomie qui demandait une force physique importante pour être conduite. La visibilité arrière quasi nulle ajoutait au défi de conduite de cette voiture.', 'Countach', 'Lamborghini'),
('la faiseuse de veuve', 'Lancée en 1975, la Porsche 911 Turbo Type 930 est la première 911 équipée d’un turbocompresseur. Ce modèle a marqué l’entrée de Porsche dans l’ère des voitures suralimentées, mais il s’est également forgé une réputation redoutable en raison de son comportement imprévisible. À l’époque, la gestion des moteurs turbo n’était pas aussi raffinée qu’aujourd’hui, ce qui a contribué à ce surnom redoutable.', 'Flat-six 3,0 à 3,3 litres turbo', 'Entre 260 ch et 300 ch', 'Environ 5 secondes', '260 km/h', 'L’effet du turbo arrivait soudainement, provoquant des accélérations brutales. Combiné à son moteur en porte-à-faux arrière, cela rendait la voiture extrêmement délicate à manœuvrer, surtout dans les virages serrés.', 'La 911 Type 930 avait un caractère capricieux, surtout pour les conducteurs non expérimentés. Le surcroît de puissance en sortie de virage, associé à la légère répartition du poids, pouvait facilement faire perdre le contrôle du véhicule, d’où son surnom de “faiseuse de veuve”.', '930 Turbo', 'Porsche'),
('la mordante', 'La Dodge Viper a été lancée en 1991 par Chrysler en tant que supercar américaine brute. Conçue sans aide électronique, elle symbolisait la puissance mécanique pure, faisant de son maniement un défi pour les pilotes. Ses premières versions étaient dépourvues de toute assistance à la conduite moderne comme l’ABS ou l’antipatinage, la laissant entièrement entre les mains du conducteur.', 'V10 de 8,0 à 8,4 litres', 'De 400 ch à 645 ch', 'Moins de 4 secondes', 'Plus de 320 km/h', 'Enorme couple à bas régime, propulsion, sans aides électroniques.', 'La Viper a gagné son surnom en raison de sa tendance à “mordre” le conducteur mal préparé. Avec un moteur si puissant et une répartition des masses difficile à contrôler, elle pouvait rapidement passer de docile à incontrôlable.', 'Viper', 'Dodge'),
('la rebelle', 'La Porsche Carrera GT, lancée en 2004, est une supercar de légende, connue pour son approche radicale de la performance. À l’origine, son moteur V10 avait été développé pour la course d’endurance, mais après l’abandon du projet, Porsche a décidé de l’utiliser pour créer une supercar routière. Elle est devenue célèbre, non seulement pour ses performances spectaculaires, mais aussi pour être une voiture difficile à maîtriser, particulièrement en raison de son caractère brut et sans aides électroniques modernes.', 'V10 atmosphérique de 5,7 litres', '612 ch', '3,9 secondes', '330 km/h', 'Châssis en carbone, boîte manuelle à 6 rapports, pas d’ABS ni de contrôle de traction.', 'La Porsche Carrera GT est souvent qualifiée de “rebelle” en raison de sa nature exigeante et imprévisible. Contrairement aux supercars modernes qui sont dotées de nombreuses aides électroniques pour contrôler la puissance, la Carrera GT repose entièrement sur les compétences du conducteur. Son embrayage en céramique est notoirement délicat, et la voiture a une répartition du poids qui la rend difficile à stabiliser en cas de perte de contrôle. De plus, sans aides à la conduite comme l’antipatinage ou l’ESP, chaque erreur de pilotage pouvait avoir des conséquences graves, ce qui en fait une voiture redoutée même par les conducteurs chevronnés.', 'Carrera GT', 'Porsche'),
('la sauvage', 'La Ferrari F40, lancée en 1987, est sans doute l’une des supercars les plus iconiques de l’histoire. Conçue pour célébrer les 40 ans de Ferrari, elle est aussi la dernière voiture approuvée par Enzo Ferrari avant sa mort. Elle était à l’époque la voiture de route la plus rapide et la plus puissante jamais produite par Ferrari.', 'V8 bi-turbo de 2,9 litres', '478 ch', '4,1 secondes', '324 km/h', 'Pas d’assistance électronique (pas d’ABS, ni de direction assistée), châssis léger en carbone.', 'La F40 est célèbre pour être extrêmement légère et rapide, mais cela la rendait aussi difficile à maîtriser. Son moteur bi-turbo délivrait une puissance de façon abrupte, et sans les aides modernes, elle exigeait une conduite experte.', 'F40', 'Ferrari'),
('la tueuse de pilotes', 'TVR est une marque britannique connue pour ses voitures sportives puissantes et sans compromis. La Cerbera, lancée en 1996, incarne cette philosophie avec un châssis léger et un énorme moteur. Fidèle à la tradition TVR, elle n’avait pas d’aides à la conduite, ce qui la rendait particulièrement dangereuse pour les conducteurs non aguerris.', 'V8 ou V12 de 4,5 à 6,0 litres', 'Jusqu’à 420 ch', '3,9 secondes', '305 km/h', 'Pas de systèmes électroniques, voiture extrêmement brute et nerveuse.', 'Les TVR, en général, sont connues pour leur nature sauvage. La Cerbera, avec son manque d’aides à la conduite, combinée à une puissance immense, la rendait extrêmement risquée, surtout en conduite agressive.', 'Cerbera', 'TVR');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `voitures`
--
ALTER TABLE `voitures`
  ADD PRIMARY KEY (`nom`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
