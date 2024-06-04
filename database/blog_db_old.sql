-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 25 mai 2024 à 11:43
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
  `published` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `published`, `image`, `created_at`) VALUES
(1, '1er article (edited)', 'C\'est le contenu du premier article une fois de plus', 1, NULL, '2024-02-13 22:13:24'),
(3, 'Mon texte de Phd est super bien', 'Sed imperdiet orci nisi, sit amet faucibus eros luctus a. Quisque Vestibulum luctus a lorem in egestas. Mauris dictum, ipsum a finibus venenatis, nulla nisl scelerisque risus, vitae semper dui felis a sem. Pellentesque auctor porttitor nibh, sit amet ornare felis facilisis eu. Etiam mattis, libero et pretium pretium, erat tellus ornare felis, vitae maximus massa libero vel ex. Suspendisse risus erat, efficitur et lacus et, sollicitudin lobortis magna. Donec nisi nisl, aliquet at placerat id, egestas id neque. Aliquam eu urna nunc. Nunc nisl velit, accumsan sed libero et, ultricies lobortis massa. Fusce augue tortor, dictum vitae enim sed, laoreet tempor erat. Ut sagittis nulla mauris, id pretium libero finibus ac. Donec vitae viverra eros, ut aliquam quam. In at tellus venenatis, vestibulum ligula in, lacinia lectus. Phasellus mollis a turpis ut interdum.\r\n\r\nNam dapibus faucibus erat, tempus elementum dolor pulvinar vel. Nunc ut felis justo. Sed eu hendrerit tortor. Etiam ligula nisi, auctor accumsan laoreet quis, porta a leo. Vestibulum orci lacus, tincidunt quis sagittis a, ullamcorper non ante. Proin et volutpat nibh. Aenean in sem fringilla, posuere neque at, maximus arcu. Phasellus vitae nibh sed ex ornare fringilla vitae sit amet est. Morbi aliquet, est a interdum congue, mauris metus ornare tellus, condimentum porttitor orci risus condimentum magna.\r\n\r\nMaecenas lectus justo, venenatis vitae rutrum nec, maximus eu neque. Proin in scelerisque elit, vitae dignissim eros. Nulla porttitor aliquam ipsum, quis posuere neque ultrices sit amet. Donec in ante odio. Mauris et neque non lorem ultrices blandit. Mauris tincidunt nulla nibh, a luctus turpis aliquet non. Quisque sed massa vehicula, condimentum enim semper, auctor quam. Ut tristique egestas enim posuere ullamcorper. Fusce lectus enim, ultricies quis blandit eget, condimentum at arcu. Aenean scelerisque ante nec magna hendrerit laoreet.\r\n\r\nNam placerat mauris pulvinar consectetur ultricies. Nunc in ultricies nunc. Integer ut nulla ex. Donec felis est, porttitor eu malesuada ut, sagittis quis elit. Proin quis aliquet leo, eu elementum mauris. Proin ut dapibus neque, at semper odio. Phasellus pretium arcu ut nulla commodo, vitae facilisis lectus feugiat. Quisque fringilla quam non lectus accumsan bibendum. Pellentesque a lacus at urna dignissim consequat. Nulla leo orci, commodo vel euismod ut, blandit ac augue.\r\n\r\nEtiam malesuada sed nibh in molestie. Vivamus scelerisque, dolor sed sagittis scelerisque, turpis erat finibus quam, vel dictum erat neque vitae velit. Nunc molestie ultricies orci sed fringilla. Mauris fringilla accumsan laoreet. Integer nec arcu scelerisque, egestas sem id, sagittis dui. Cras facilisis lacus sem. Nam scelerisque tempor lectus eget viverra. Vestibulum maximus dictum lectus, a accumsan ipsum egestas venenatis. Phasellus auctor tempus sodales. Nulla justo mi, condimentum ac vehicula vitae, tempus vitae est. Phasellus ultricies felis nec consequat suscipit. Phasellus euismod nisi quis magna efficitur, id auctor leo suscipit.\r\n\r\nUt orci quam, viverra ut viverra eu, tristique eu nibh. Nullam sit amet risus diam. Curabitur faucibus ultrices pulvinar. Etiam nulla ex, porttitor at urna sed, pulvinar molestie justo. Donec nisl augue, laoreet id laoreet sit amet, malesuada hendrerit nulla. Nullam non vestibulum nisl. Phasellus a consectetur quam. Integer venenatis enim et odio dapibus vehicula. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.\r\n\r\nSed vitae imperdiet elit. Maecenas porta erat sed nunc placerat, nec elementum ante mattis. Nam id sapien hendrerit, cursus felis porta, accumsan velit. Praesent neque.  magna ligula, gravida vel ornare vel, finibus eu libero. Cras elementum arcu ante, at rutrum nisl viverra ut. Sed mollis sem sit amet magna tempus, sit amet tincidunt diam aliquet. Phasellus suscipit, dui a maximus tempor, nisi quam ultricies ipsum, non tristique metus mauris eu enim. Donec quis condimentum lorem, eget blandit ante. Nunc dignissim, ligula nec tristique vulputate, arcu nisi ultrices turpis, ac aliquam purus elit eu felis. Nulla facilisi. Etiam id enim nibh. Nulla ut nunc sapien. Praesent sed diam dolor.', 1, NULL, '2024-02-14 22:28:05'),
(9, 'c\'est le premier article', '<p>test du content</p>', 1, NULL, '2024-02-17 16:27:11'),
(10, 'c\'est le premier article', '<p>test du content editex</p>', 1, NULL, '2024-02-17 16:27:37'),
(15, 'photo post', '<p>test&nbsp;</p>\r\n<p>sdfsdfsdfsfs</p>\r\n<p>sdfsdfdfsdffds</p>\r\n<p></p>\r\n<p>sdf</p>\r\n<p>sdf</p>\r\n<p>sdf</p>\r\n<p>sd</p>\r\n<p>fsdfsf</p>\r\n<p>dsf</p>', 1, '6651b216705a2.jpg', '2024-05-25 11:40:38');

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
(55, 15, 4, '2024-05-25 11:40:38'),
(56, 10, 4, '2024-05-25 11:41:19'),
(57, 9, 2, '2024-05-25 11:41:41'),
(58, 9, 1, '2024-05-25 11:41:41');

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
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` int(11) NOT NULL DEFAULT 0,
  `etat_compte` int(11) NOT NULL DEFAULT 0,
  `ip_addr` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `admin`, `etat_compte`, `ip_addr`, `created_at`) VALUES
(1, 'admin', 'a@a.ch', 'c2e8d152ce66fe382bcb9b42fe6461ae0a6b5530b297b794f60daf191af2d24e', 1, 0, '127.0.0.1', '2024-02-17 22:19:04'),
(15, 'hugo', 'h@h.ch', '58a27ef0a64b4769886fe1df45539f668760f32d4ae81a1b86050ab072758703', 0, 0, '127.0.0.1', '2024-05-22 22:56:57'),
(16, 'admin1', '1@1.ch', '34a6390355f5e9cda4f02b1e28daa83f1ab7b30c0923e42f860afc740df04ede', 0, 1, '127.0.0.1', '2024-05-23 18:42:56');

-- --------------------------------------------------------

--
-- Structure de la table `user_post`
--

CREATE TABLE `user_post` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `user_post`
--

INSERT INTO `user_post` (`id`, `post_id`, `user_id`, `created_at`) VALUES
(1, 1, 1, '2024-02-28 20:35:02'),
(3, 15, 15, '2024-05-25 09:40:38');

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
-- Index pour la table `user_post`
--
ALTER TABLE `user_post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `post_tag`
--
ALTER TABLE `post_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT pour la table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `user_post`
--
ALTER TABLE `user_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `post_tag`
--
ALTER TABLE `post_tag`
  ADD CONSTRAINT `FK_post_tag_posts` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_post_tag_tags` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `user_post`
--
ALTER TABLE `user_post`
  ADD CONSTRAINT `user_post_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_post_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
