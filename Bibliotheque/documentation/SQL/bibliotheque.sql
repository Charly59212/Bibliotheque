-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 02 jan. 2025 à 13:47
-- Version du serveur :  5.7.17
-- Version de PHP :  7.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bibliotheque`
--

-- --------------------------------------------------------

--
-- Structure de la table `auteurs`
--

CREATE TABLE `auteurs` (
  `id` int(11) NOT NULL,
  `auteur` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `biographie` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Déchargement des données de la table `auteurs`
--

INSERT INTO `auteurs` (`id`, `auteur`, `biographie`) VALUES
(1, 'Victor Hugo', 'Écrivain français du XIXe siècle, auteur des Misérables.'),
(2, 'G. Damas', 'Après une licence en Droit, Geneviève Damas suit une formation de comédienne au\r\nconservatoire Royal de Bruxelles.'),
(3, 'Saint-Exupéry', 'Antoine de Saint-Exupéry est un écrivain, poète, aviateur et reporter français. Il publie, en s\'inspirant de ses expériences d\'aviateur, ses premiers romans : Courrier sud en 1929 et surtout Vol de nuit en 1931, qui connaît un grand succès et reçoit le prix Femina.'),
(4, 'George Orwell', 'Écrivain britannique, auteur de La Ferme des animaux et surtout 1984, roman dans lequel il crée le concept de Big Brother, depuis passé dans le langage courant de la critique des techniques modernes de surveillance et de contrôle des individus. '),
(5, 'Jules Verne', 'Écrivain français, dont les romans, toujours très documentés, se déroulent généralement au cours de la seconde moitié du XIXe siècle. Auteur des livres Les Enfants du capitaine Grant (1868), Le Tour du monde en quatre-vingts jours (1873), Michel Strogoff (1876), L\'Étoile du Sud (1884), etc..'),
(6, 'Agatha Christie', 'Célèbre pour ses romans policiers, notamment Hercule Poirot.'),
(7, 'Homer', 'Auteur des épopées antiques l’Iliade et l’Odyssée.'),
(8, 'Mary Shelley', 'Auteure pionnière de la science-fiction avec Frankenstein.'),
(9, 'A. C. Doyle', 'Créateur du détective Sherlock Holmes.'),
(10, 'H.G. Wells', 'Maître de la science-fiction avec La Guerre des mondes.'),
(11, 'Leo Tolstoy', 'Écrivain russe célèbre pour Guerre et Paix et Anna Karénine.'),
(12, 'Emily Brontë', 'Auteure de Les Hauts de Hurlevent, un classique romantique.'),
(13, 'Bram Stoker', 'Abraham Stoker dit Bram Stoker, né le 8 novembre 1847 à Clontarf et mort le 20 avril 1912 à Londres, est un écrivain irlandais, auteur de nombreux romans et de nouvelles, qui a connu la célébrité grâce à son roman intitulé Dracula.'),
(14, 'M. J. Benton ', 'Michael James Benton est un membre de la Royal Society of Edinburgh et professeur de paléontologie des vertébrés au département des sciences de la Terre de l\'Université de Bristol.'),
(15, 'A. Camus', 'Albert Camus était est un philosophe, écrivain, journaliste militant, romancier, dramaturge, essayiste et nouvelliste français.'),
(16, 'Simone Veil', 'Simone Veil écrit sur son enfance, son arrestation par les nazis et sa déportation dans le camp de concentration, ainsi que sur sa carrière politique et ses luttes pour les droits des femmes françaises.'),
(17, 'M. Chattam', 'Maxime Guy Sylvain Drouot, connu sous les noms de plume Maxime Chattam et Maxime Williams, est un romancier français, spécialisé dans le thriller.'),
(18, 'A. Rimbaud', 'Jean Nicolas Arthur Rimbaud est un poète français.Il écrit ses premières œuvres très tôt, à l\'âge de 15 ans, et est un enfant brillant scolairement.'),
(19, 'Jane Austen', 'Jane Austen est une écrivaine anglaise. Elle fait partie d\'une fratrie de huit enfants.'),
(20, 'S. Edgar', 'Silène Edgar, alias Sophie Ruhaud, est professeure de français durant 15 ans et auteure de romans pour la jeunesse.'),
(21, 'M.H. Robert', 'Après un Doctorat d’Endocrinologie, Nutrition et Métabolisme à l’Université de Limoges, Marie Husson-Robert a enseigné à l’Université de Nantes.'),
(22, 'Tracy Wolff', 'Tracy Wolff est autrice de romans sur fond de paranormal sous le nom de Tessa Adams. Elle signe également sous le pseudonyme de Tracy Deebs.'),
(23, 'J.R. Santos', 'José António Afonso Rodrigues dos Santos (J.R. dos Santos) est un journaliste, essayiste et romancier.'),
(24, 'R. Barjavel', ' René Barjavel est un auteur et journaliste français.');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`) VALUES
(1, 'Roman'),
(2, 'Fantastique'),
(3, 'Fantasy'),
(4, 'Histoire'),
(5, 'Policier'),
(6, 'Classique'),
(7, 'Mythologie'),
(8, 'Science');

-- --------------------------------------------------------

--
-- Structure de la table `livres`
--

CREATE TABLE `livres` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `auteur_id` int(11) NOT NULL,
  `annee_publication` int(4) NOT NULL,
  `isbn` varchar(20) NOT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `description` text,
  `date_ajout` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Déchargement des données de la table `livres`
--

INSERT INTO `livres` (`id`, `titre`, `auteur_id`, `annee_publication`, `isbn`, `categorie_id`, `description`, `date_ajout`) VALUES
(1, 'Les Misérables', 1, 1901, '9781234567890', 1, 'les misérables\r\n', '2024-12-08 11:04:16'),
(2, ' L\'étranger ', 15, 1972, '9782070360024', 6, 'L\'étranger est le premier roman d\'Albert Camus (1913-1960), prix Nobel de littérature, auteur de La peste et de Caligula.', '2024-12-30 16:46:15'),
(3, 'Dinosaures', 14, 2024, '9782603031353', 8, 'Au cours des dernières décennies, la paléobiologie est passée du statut de science spéculative à celui de discipline de pointe. Aujourd’hui, les chercheurs soumettent les découvertes fossiles aux technologies les plus avancées pour révéler de nouvelles informations surprenantes sur la vie des dinosaures.', '2024-12-30 16:43:22'),
(4, '1984', 4, 1949, '9780452284234', 1, 'L\'histoire se déroule dans un futur imaginaire. L\'année en cours est incertaine, mais on pense qu\'il s\'agit de 1984. Une grande partie du monde est en guerre perpétuelle.', '2024-12-08 14:08:03'),
(5, 'Le petit prince', 3, 1943, '9782070408504', 1, 'Le Petit Prince vient d’une planète à peine plus grande que lui sur laquelle il y a des baobabs et une fleur très précieuse, qui fait sa coquette et dont il se sent responsable.', '2024-12-23 19:01:29'),
(6, 'Prime Time', 17, 2024, '9782226470089 ', 5, 'Pendant que des millions de téléspectateurs regardent le journal télévisé de 20 h sur la première chaîne nationale, un homme masqué, à la voix déformée, prend en otage le présentateur vedette.', '2024-12-30 18:45:16'),
(7, 'Poésies', 18, 1998, '9782253096351 ', 6, 'À dix-sept ans, Rimbaud s\'est déjà défini. Il veut vaincre les apparences, briser les carcans de sa ville natale, Charleville.', '2024-12-30 18:49:36'),
(8, 'L’Iliade', 7, -800, '9780140275360', 7, 'Une épopée fondatrice de la littérature occidentale.', '2024-12-23 20:33:57'),
(9, 'Frankenstein', 8, 1818, '9780199537150', 4, 'Le mythe fondateur de la science-fiction.', '2024-12-23 20:33:57'),
(10, 'Dracula', 13, 1897, '9782080723062', 2, 'Le jeune Jonathan Harker rend visite au comte Dracula dans son château des Carpates afin de l’informer du domaine qu’il vient d’acheter pour lui en Angleterre. Au cours de son voyage, les autochtones qu’il rencontre tentent de le dissuader d’atteindre son but...', '2024-12-30 16:33:22'),
(11, ' Une vie ', 16, 2009, '9782253127765', 6, 'Personnage au destin exceptionnel, elle est la femme politique dont la légitimité est la moins contestée, en France et à l\'étranger ; son autobiographie est attendue depuis longtemps.', '2024-12-30 16:51:35'),
(12, 'Guerre et Paix', 11, 1869, '9780307266934', 3, 'Un chef-d’œuvre de la littérature russe.', '2024-12-23 20:33:57'),
(13, 'Les Hauts de Hurlevent', 12, 1847, '9780141439556', 3, 'Une histoire d’amour et de vengeance.', '2024-12-23 20:33:57'),
(14, 'Persuasion', 19, 1996, '9782264023834 ', 5, 'Anne, une jeune aristocrate, a repoussé les avances de Frederick, un officier de marine qu\'elle ne jugeait pas de sa condition.', '2024-12-30 18:54:14'),
(15, '42 jours', 20, 2017, '9782362312519 ', 4, 'Sacha, douze ans, et Jacob, son petit frère, sont à la fois surpris et très contents de partir en vacances avant la fin de l’année scolaire.', '2024-12-30 18:56:52'),
(16, 'Le Tour du monde en 80 jours', 5, 1976, '9782253012696', 1, 'Le roman raconte la course autour du monde d\'un gentleman anglais, Phileas Fogg, qui a fait le pari d\'y parvenir en quatre-vingts jours. Il est accompagné par Jean Passepartout, son fidèle domestique.\r\n', '2024-12-23 19:47:01'),
(17, 'Le Meurtre de Roger Ackroyd', 6, 1926, '9780007422548', 5, 'Un classique des romans policiers.', '2024-12-23 20:33:57'),
(18, 'La Guerre des mondes', 10, 1898, '9780345324542', 4, 'Une invasion extraterrestre racontée avec génie.', '2024-12-23 20:33:57'),
(19, 'Un Scandale en Bohême', 9, 1891, '9780241952935', 5, 'Une enquête de Sherlock Holmes.', '2024-12-23 20:33:57'),
(20, 'Emma', 19, 2023, '9782491683214 ', 4, 'Le destin n\'y est pour rien. Si les couples se font et se défont, dans le petit bourg de Highbury, c\'est qu\'Emma s\'est improvisée entremetteuse.', '2024-12-30 18:59:06'),
(21, 'Strange', 2, 2023, '9782246834977 ', 1, 'Raphaël écrit a son père. Ils ne se sont plus vus depuis plusieurs mois en raison du covid, s\'imagine ce dernier. Il s’agit de bien autre chose.', '2024-12-30 19:02:25'),
(22, 'Apoptosis ', 21, 2023, '9782382111192', 5, 'Lorsque Eliott Delmas, ouvre la première page du dossier d\'enquête sur la société Suisse MetabCare, il est encore loin d\'en imaginer la vénéneuse réalité, l\'inimaginable perversité.', '2024-12-30 19:26:35'),
(23, 'Enflammés', 22, 2024, '9782266341936 ', 2, 'Une nouvelle menace gronde au moment même où le Cercle s`effondre. Cela fait trois mois que Grace et ses amis ont éliminé Cyrus. Mais cette période de calme était trop belle pour durer.', '2024-12-30 19:30:05'),
(24, 'Oubliés', 23, 2024, '9782357207844 ', 4, 'À la veille des derniers affrontements de la Première Guerre mondiale, Oubliés raconte l\'aventure d\'une poignée de soldats portugais abandonnés dans les tranchées des Flandres.', '2024-12-30 19:32:18'),
(25, 'L\'Enchanteur', 24, 2018, '9784621002612 ', 3, 'Qui ne connaît Merlin ? Il se joue du temps qui passe, reste jeune et beau, vif et moqueur, tendre, pour tout dire Enchanteur.', '2024-12-30 19:37:20');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `name` varchar(190) NOT NULL,
  `email` varchar(190) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `name`, `email`, `password`) VALUES
(1, 'Charly', 'Charly@gmail.com', '$2y$10$dvmTAcKpxNBbHOwXM5BmFu6c7.4gYzO8Q.XsBopFSOKi2PNsHnY8u');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `auteurs`
--
ALTER TABLE `auteurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `livres`
--
ALTER TABLE `livres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_livres_auteurs` (`auteur_id`),
  ADD KEY `fk_livres_categories` (`categorie_id`),
  ADD KEY `isbn` (`isbn`) USING BTREE;

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `auteurs`
--
ALTER TABLE `auteurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `livres`
--
ALTER TABLE `livres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `livres`
--
ALTER TABLE `livres`
  ADD CONSTRAINT `fk_livres_auteurs` FOREIGN KEY (`auteur_id`) REFERENCES `auteurs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_livres_categories` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
