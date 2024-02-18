-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 18 fév. 2024 à 22:57
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `created_at`) VALUES
(1, '1er article (edited)', 'C\'est le contenu du premier article une fois de plus', '2024-02-13 22:13:24'),
(3, 'Mon texte de Phd est super bien', 'Sed imperdiet orci nisi, sit amet faucibus eros luctus a. Quisque Vestibulum luctus a lorem in egestas. Mauris dictum, ipsum a finibus venenatis, nulla nisl scelerisque risus, vitae semper dui felis a sem. Pellentesque auctor porttitor nibh, sit amet ornare felis facilisis eu. Etiam mattis, libero et pretium pretium, erat tellus ornare felis, vitae maximus massa libero vel ex. Suspendisse risus erat, efficitur et lacus et, sollicitudin lobortis magna. Donec nisi nisl, aliquet at placerat id, egestas id neque. Aliquam eu urna nunc. Nunc nisl velit, accumsan sed libero et, ultricies lobortis massa. Fusce augue tortor, dictum vitae enim sed, laoreet tempor erat. Ut sagittis nulla mauris, id pretium libero finibus ac. Donec vitae viverra eros, ut aliquam quam. In at tellus venenatis, vestibulum ligula in, lacinia lectus. Phasellus mollis a turpis ut interdum.\r\n\r\nNam dapibus faucibus erat, tempus elementum dolor pulvinar vel. Nunc ut felis justo. Sed eu hendrerit tortor. Etiam ligula nisi, auctor accumsan laoreet quis, porta a leo. Vestibulum orci lacus, tincidunt quis sagittis a, ullamcorper non ante. Proin et volutpat nibh. Aenean in sem fringilla, posuere neque at, maximus arcu. Phasellus vitae nibh sed ex ornare fringilla vitae sit amet est. Morbi aliquet, est a interdum congue, mauris metus ornare tellus, condimentum porttitor orci risus condimentum magna.\r\n\r\nMaecenas lectus justo, venenatis vitae rutrum nec, maximus eu neque. Proin in scelerisque elit, vitae dignissim eros. Nulla porttitor aliquam ipsum, quis posuere neque ultrices sit amet. Donec in ante odio. Mauris et neque non lorem ultrices blandit. Mauris tincidunt nulla nibh, a luctus turpis aliquet non. Quisque sed massa vehicula, condimentum enim semper, auctor quam. Ut tristique egestas enim posuere ullamcorper. Fusce lectus enim, ultricies quis blandit eget, condimentum at arcu. Aenean scelerisque ante nec magna hendrerit laoreet.\r\n\r\nNam placerat mauris pulvinar consectetur ultricies. Nunc in ultricies nunc. Integer ut nulla ex. Donec felis est, porttitor eu malesuada ut, sagittis quis elit. Proin quis aliquet leo, eu elementum mauris. Proin ut dapibus neque, at semper odio. Phasellus pretium arcu ut nulla commodo, vitae facilisis lectus feugiat. Quisque fringilla quam non lectus accumsan bibendum. Pellentesque a lacus at urna dignissim consequat. Nulla leo orci, commodo vel euismod ut, blandit ac augue.\r\n\r\nEtiam malesuada sed nibh in molestie. Vivamus scelerisque, dolor sed sagittis scelerisque, turpis erat finibus quam, vel dictum erat neque vitae velit. Nunc molestie ultricies orci sed fringilla. Mauris fringilla accumsan laoreet. Integer nec arcu scelerisque, egestas sem id, sagittis dui. Cras facilisis lacus sem. Nam scelerisque tempor lectus eget viverra. Vestibulum maximus dictum lectus, a accumsan ipsum egestas venenatis. Phasellus auctor tempus sodales. Nulla justo mi, condimentum ac vehicula vitae, tempus vitae est. Phasellus ultricies felis nec consequat suscipit. Phasellus euismod nisi quis magna efficitur, id auctor leo suscipit.\r\n\r\nUt orci quam, viverra ut viverra eu, tristique eu nibh. Nullam sit amet risus diam. Curabitur faucibus ultrices pulvinar. Etiam nulla ex, porttitor at urna sed, pulvinar molestie justo. Donec nisl augue, laoreet id laoreet sit amet, malesuada hendrerit nulla. Nullam non vestibulum nisl. Phasellus a consectetur quam. Integer venenatis enim et odio dapibus vehicula. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.\r\n\r\nSed vitae imperdiet elit. Maecenas porta erat sed nunc placerat, nec elementum ante mattis. Nam id sapien hendrerit, cursus felis porta, accumsan velit. Praesent neque.  magna ligula, gravida vel ornare vel, finibus eu libero. Cras elementum arcu ante, at rutrum nisl viverra ut. Sed mollis sem sit amet magna tempus, sit amet tincidunt diam aliquet. Phasellus suscipit, dui a maximus tempor, nisi quam ultricies ipsum, non tristique metus mauris eu enim. Donec quis condimentum lorem, eget blandit ante. Nunc dignissim, ligula nec tristique vulputate, arcu nisi ultrices turpis, ac aliquam purus elit eu felis. Nulla facilisi. Etiam id enim nibh. Nulla ut nunc sapien. Praesent sed diam dolor.', '2024-02-14 22:28:05'),
(6, 'wemby best player ? (test)', 'timeo edited test Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Habitasse platea dictumst vestibulum rhoncus. Fames ac turpis egestas sed tempus urna et pharetra. Posuere ac ut consequat semper. Est velit egestas dui id ornare. Vel facilisis volutpat est velit egestas. Vel elit scelerisque mauris pellentesque pulvinar pellentesque habitant. Fringilla ut morbi tincidunt augue interdum velit euismod in. Eu nisl nunc mi ipsum. Placerat vestibulum lectus mauris ultrices eros in cursus. Nam at lectus urna duis convallis.\r\n\r\nSed egestas egestas fringilla phasellus faucibus. Ornare suspendisse sed nisi lacus sed viverra tellus in hac. Donec enim diam vulputate ut. Vulputate eu scelerisque felis imperdiet proin fermentum. Netus et malesuada fames ac. Scelerisque varius morbi enim nunc faucibus a pellentesque sit. Malesuada fames ac turpis egestas sed tempus urna et pharetra. Ut aliquam purus sit amet luctus venenatis lectus magna. In hac habitasse platea dictumst quisque sagittis. Enim lobortis scelerisque fermentum dui faucibus. Tristique senectus et netus et malesuada fames ac turpis. Nisi lacus sed viverra tellus in. Diam sollicitudin tempor id eu nisl nunc. Eget est lorem ipsum dolor sit. Elementum sagittis vitae et leo. Malesuada fames ac turpis egestas sed. Integer vitae justo eget magna fermentum iaculis eu non diam.\r\n\r\nEtiam dignissim diam quis enim lobortis scelerisque fermentum dui faucibus. Ultricies mi quis hendrerit dolor magna eget est. Tellus in hac habitasse platea dictumst vestibulum rhoncus. Malesuada nunc vel risus commodo viverra maecenas accumsan. Vel eros donec ac odio. Pretium fusce id velit ut tortor. Porta nibh venenatis cras sed felis. Eu augue ut lectus arcu bibendum at varius. Aliquet lectus proin nibh nisl. Velit sed ullamcorper morbi tincidunt ornare massa eget egestas. Morbi tristique senectus et netus et malesuada fames ac turpis. Nec tincidunt praesent semper feugiat nibh. Erat velit scelerisque in dictum non consectetur a. A iaculis at erat pellentesque adipiscing commodo elit at imperdiet. Tempor orci eu lobortis elementum. Tempor orci dapibus ultrices in iaculis nunc sed augue lacus. Varius sit amet mattis vulputate enim nulla aliquet porttitor lacus. Congue mauris rhoncus aenean vel. Adipiscing enim eu turpis egestas. In nibh mauris cursus mattis molestie a iaculis at erat.\r\n\r\nSed viverra tellus in hac habitasse platea. Nam libero justo laoreet sit amet cursus. Elementum tempus egestas sed sed risus pretium quam. Senectus et netus et malesuada fames ac turpis egestas. Enim facilisis gravida neque convallis a cras semper auctor neque. Ut sem nulla pharetra diam sit amet. In pellentesque massa placerat duis ultricies lacus. Dictum at tempor commodo ullamcorper a lacus. Nisl vel pretium lectus quam id leo. Mattis enim ut tellus elementum sagittis vitae et leo duis. Elementum eu facilisis sed odio morbi quis commodo odio. Quis imperdiet massa tincidunt nunc pulvinar sapien et ligula. Sit amet consectetur adipiscing elit ut aliquam purus sit amet. Mi tempus imperdiet nulla malesuada pellentesque elit eget gravida. Morbi quis commodo odio aenean sed adipiscing diam donec adipiscing. Consequat mauris nunc congue nisi vitae suscipit tellus mauris a. Magnis dis parturient montes nascetur ridiculus mus mauris vitae. Sed nisi lacus sed viverra.\r\n\r\nEnim ut sem viverra aliquet eget sit amet tellus cras. Id velit ut tortor pretium viverra. Nec feugiat in fermentum posuere. Euismod elementum nisi quis eleifend. Eget sit amet tellus cras adipiscing. Tellus molestie nunc non blandit massa. Sem viverra aliquet eget sit amet tellus. Dolor sit amet consectetur adipiscing elit duis tristique sollicitudin nibh. Facilisis volutpat est velit egestas dui id ornare. Cras sed felis eget velit aliquet sagittis id. Egestas diam in arcu cursus. Tellus orci ac auctor augue. Id venenatis a condimentum vitae sapien pellentesque habitant morbi tristique. Fringilla ut morbi tincidunt augue. Scelerisque mauris pellentesque pulvinar pellentesque habitant morbi tristique senectus et. Cursus vitae congue mauris rhoncus. Sit amet justo donec enim diam vulputate ut. Nullam eget felis eget nunc lobortis mattis aliquam faucibus purus.', '2024-02-16 18:32:26'),
(9, 'c\'est le premier article', 'test du content', '2024-02-17 16:27:11'),
(10, 'c\'est le premier article', 'test du content', '2024-02-17 16:27:37');

-- --------------------------------------------------------

--
-- Structure de la table `post_tag`
--

CREATE TABLE `post_tag` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `post_tag`
--

INSERT INTO `post_tag` (`id`, `post_id`, `tag_id`, `created_at`) VALUES
(4, 3, 2, '2024-02-17 22:06:37'),
(5, 3, 4, '2024-02-17 22:06:37'),
(7, 3, 3, '2024-02-17 22:06:37'),
(12, 1, 3, '2024-02-17 22:06:37'),
(13, 1, 2, '2024-02-17 22:06:37'),
(14, 1, 1, '2024-02-17 22:06:37'),
(21, 6, 3, '2024-02-17 22:06:37'),
(47, 10, 4, '2024-02-18 21:02:17'),
(48, 10, 3, '2024-02-18 21:02:17');

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `tags`
--

INSERT INTO `tags` (`id`, `name`, `created_at`) VALUES
(1, 'PHP', '2024-02-14 22:26:50'),
(2, 'JS', '2024-02-14 22:26:56'),
(3, 'HTML/CSS', '2024-02-14 22:27:12'),
(4, 'Python', '2024-02-14 22:27:23');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `admin`, `created_at`) VALUES
(1, 'admin', '$2y$10$QAG/BcW3bL622SCcfXv5bOb8E0Vdu6iAnAgUnUkP9P3gkDlFb1CWe', 1, '2024-02-17 22:19:04');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `post_tag`
--
ALTER TABLE `post_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_post_tag_posts` (`post_id`),
  ADD KEY `FK_post_tag_tags` (`tag_id`);

--
-- Index pour la table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `post_tag`
--
ALTER TABLE `post_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT pour la table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `post_tag`
--
ALTER TABLE `post_tag`
  ADD CONSTRAINT `FK_post_tag_posts` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_post_tag_tags` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
