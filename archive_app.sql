-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 01 nov. 2021 à 21:42
-- Version du serveur : 8.0.27
-- Version de PHP : 7.3.24-(to be removed in future macOS)

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `archive_app`
--

-- --------------------------------------------------------

--
-- Structure de la table `devise`
--

CREATE TABLE `devise` (
  `id` int NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `devise`
--

INSERT INTO `devise` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'DH', '2021-10-30 22:58:05', '2021-10-30 22:58:05'),
(2, 'Euro', '2021-10-30 22:58:11', '2021-10-30 22:58:11');

-- --------------------------------------------------------

--
-- Structure de la table `marche_unique`
--

CREATE TABLE `marche_unique` (
  `id` int NOT NULL,
  `titulaire_id` int NOT NULL,
  `societe_id` int NOT NULL,
  `nature_operation_id` int NOT NULL,
  `tfs_id` int NOT NULL,
  `devise_id` int NOT NULL,
  `num_marche` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_marche` smallint NOT NULL,
  `mode_passassion` smallint NOT NULL,
  `fontionnement_investissement` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee_budgetaire` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `montant` double NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `line_budgetaire` int NOT NULL,
  `document_passation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document_execution` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `marche_unique`
--

INSERT INTO `marche_unique` (`id`, `titulaire_id`, `societe_id`, `nature_operation_id`, `tfs_id`, `devise_id`, `num_marche`, `type_marche`, `mode_passassion`, `fontionnement_investissement`, `annee_budgetaire`, `montant`, `created_at`, `updated_at`, `line_budgetaire`, `document_passation`, `document_execution`) VALUES
(1, 1, 2, 3, 1, 1, '01', 0, 0, 'F', '09', 20000, '2021-10-31 12:58:56', '2021-10-31 12:58:56', 222, '', ''),
(2, 1, 2, 3, 1, 1, '01', 0, 0, 'F', '09', 20000, '2021-10-31 15:09:09', '2021-10-31 16:01:59', 1, 'adminlte-3-datatables-617eb195d8dfd662470651.csv', 'bienvenue-chez-logigroup-youness-617ebdf70ba70848432292.pdf');

-- --------------------------------------------------------

--
-- Structure de la table `nature_operation_bon_commande`
--

CREATE TABLE `nature_operation_bon_commande` (
  `id` int NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nature_operation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tfs_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `nature_operation_bon_commande`
--

INSERT INTO `nature_operation_bon_commande` (`id`, `code`, `nature_operation`, `tfs_id`) VALUES
(1, '93', 'QSDK', 2);

-- --------------------------------------------------------

--
-- Structure de la table `nature_operation_contrat`
--

CREATE TABLE `nature_operation_contrat` (
  `id` int NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nature_operation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tfs_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `nature_operation_contrat`
--

INSERT INTO `nature_operation_contrat` (`id`, `code`, `nature_operation`, `tfs_id`) VALUES
(1, '08', 'AAA', 1);

-- --------------------------------------------------------

--
-- Structure de la table `nature_operation_marche_reconductible`
--

CREATE TABLE `nature_operation_marche_reconductible` (
  `id` int NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nature_operation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tfs_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `nature_operation_marche_reconductible`
--

INSERT INTO `nature_operation_marche_reconductible` (`id`, `code`, `nature_operation`, `tfs_id`) VALUES
(1, '03', 'marchés Reconductible', 2);

-- --------------------------------------------------------

--
-- Structure de la table `nature_operation_marche_unique`
--

CREATE TABLE `nature_operation_marche_unique` (
  `id` int NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nature_operation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tfs_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `nature_operation_marche_unique`
--

INSERT INTO `nature_operation_marche_unique` (`id`, `code`, `nature_operation`, `tfs_id`) VALUES
(3, '01', 'Test', 1);

-- --------------------------------------------------------

--
-- Structure de la table `reset_password_request`
--

CREATE TABLE `reset_password_request` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `selector` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hashed_token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requested_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `societe`
--

CREATE TABLE `societe` (
  `id` int NOT NULL,
  `titulaire_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_societe` int DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `societe`
--

INSERT INTO `societe` (`id`, `titulaire_id`, `name`, `code_societe`, `adresse`, `created_at`, `updated_at`) VALUES
(2, 1, '3f industrie', 0, '36, rue imam al boukhari maarif', '2021-10-26 16:58:14', '2021-10-26 16:58:14'),
(3, 1, '3f industrie', 0, '36, rue imam al boukhari maarif', '2021-10-26 20:27:17', '2021-10-26 20:27:17'),
(4, 1, 'TESTa', 3, 'aTEST', '2021-10-26 20:27:33', '2021-10-30 23:32:00'),
(5, 1, '3f industrie', 3, '36, rue imam al boukhari maarif', '2021-10-31 22:47:01', '2021-10-31 22:47:01'),
(6, 1, '3f industrie', 1, '36, rue imam al boukhari maarif', '2021-10-31 22:47:35', '2021-10-31 22:47:35'),
(7, 1, '3f industrie', 1, '36, rue imam al boukhari maarif', '2021-10-31 22:56:00', '2021-10-31 22:56:00');

-- --------------------------------------------------------

--
-- Structure de la table `societe_titulaire`
--

CREATE TABLE `societe_titulaire` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `societe_titulaire`
--

INSERT INTO `societe_titulaire` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Marocaine', '2021-10-26 16:02:47', '2021-10-26 16:02:47'),
(2, 'Etrangère', '2021-10-26 21:01:19', '2021-10-30 23:31:42');

-- --------------------------------------------------------

--
-- Structure de la table `tfs`
--

CREATE TABLE `tfs` (
  `id` int NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tfs`
--

INSERT INTO `tfs` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, 'Service', 'S', '2021-10-30 23:35:05', '2021-10-30 23:35:05'),
(2, 'Fourniture', 'F', '2021-10-30 23:35:05', '2021-10-30 23:35:05'),
(3, 'Rest', 'R', '2021-10-30 23:09:38', '2021-10-30 23:09:45');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `roles`, `password`, `is_verified`, `created_at`, `updated_at`) VALUES
(1, 'Youness', 'Arbouh', 'youness.arbouh@gmail.com', '[]', '$2y$13$8O4QsyIsovW1hr9SwQ75zOZMreB9HGYByM5xim8PHmS2PbieUaLrC', 1, '2021-10-20 22:08:36', '2021-10-20 22:15:32');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `devise`
--
ALTER TABLE `devise`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `marche_unique`
--
ALTER TABLE `marche_unique`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C28F6B6DA10273AA` (`titulaire_id`),
  ADD KEY `IDX_C28F6B6DFCF77503` (`societe_id`),
  ADD KEY `IDX_C28F6B6D28C42716` (`nature_operation_id`),
  ADD KEY `IDX_C28F6B6DD7897FC9` (`tfs_id`),
  ADD KEY `IDX_C28F6B6DF4445056` (`devise_id`);

--
-- Index pour la table `nature_operation_bon_commande`
--
ALTER TABLE `nature_operation_bon_commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_16AAA8BFD7897FC9` (`tfs_id`);

--
-- Index pour la table `nature_operation_contrat`
--
ALTER TABLE `nature_operation_contrat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_AF8F9019D7897FC9` (`tfs_id`);

--
-- Index pour la table `nature_operation_marche_reconductible`
--
ALTER TABLE `nature_operation_marche_reconductible`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F8D79C30D7897FC9` (`tfs_id`);

--
-- Index pour la table `nature_operation_marche_unique`
--
ALTER TABLE `nature_operation_marche_unique`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_20342644D7897FC9` (`tfs_id`);

--
-- Index pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7CE748AA76ED395` (`user_id`);

--
-- Index pour la table `societe`
--
ALTER TABLE `societe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_19653DBDA10273AA` (`titulaire_id`);

--
-- Index pour la table `societe_titulaire`
--
ALTER TABLE `societe_titulaire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tfs`
--
ALTER TABLE `tfs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `devise`
--
ALTER TABLE `devise`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `marche_unique`
--
ALTER TABLE `marche_unique`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `nature_operation_bon_commande`
--
ALTER TABLE `nature_operation_bon_commande`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `nature_operation_contrat`
--
ALTER TABLE `nature_operation_contrat`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `nature_operation_marche_reconductible`
--
ALTER TABLE `nature_operation_marche_reconductible`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `nature_operation_marche_unique`
--
ALTER TABLE `nature_operation_marche_unique`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `societe`
--
ALTER TABLE `societe`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `societe_titulaire`
--
ALTER TABLE `societe_titulaire`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `tfs`
--
ALTER TABLE `tfs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `marche_unique`
--
ALTER TABLE `marche_unique`
  ADD CONSTRAINT `FK_C28F6B6D28C42716` FOREIGN KEY (`nature_operation_id`) REFERENCES `nature_operation_marche_unique` (`id`),
  ADD CONSTRAINT `FK_C28F6B6DA10273AA` FOREIGN KEY (`titulaire_id`) REFERENCES `societe_titulaire` (`id`),
  ADD CONSTRAINT `FK_C28F6B6DD7897FC9` FOREIGN KEY (`tfs_id`) REFERENCES `tfs` (`id`),
  ADD CONSTRAINT `FK_C28F6B6DF4445056` FOREIGN KEY (`devise_id`) REFERENCES `devise` (`id`),
  ADD CONSTRAINT `FK_C28F6B6DFCF77503` FOREIGN KEY (`societe_id`) REFERENCES `societe` (`id`);

--
-- Contraintes pour la table `nature_operation_bon_commande`
--
ALTER TABLE `nature_operation_bon_commande`
  ADD CONSTRAINT `FK_16AAA8BFD7897FC9` FOREIGN KEY (`tfs_id`) REFERENCES `tfs` (`id`);

--
-- Contraintes pour la table `nature_operation_contrat`
--
ALTER TABLE `nature_operation_contrat`
  ADD CONSTRAINT `FK_AF8F9019D7897FC9` FOREIGN KEY (`tfs_id`) REFERENCES `tfs` (`id`);

--
-- Contraintes pour la table `nature_operation_marche_reconductible`
--
ALTER TABLE `nature_operation_marche_reconductible`
  ADD CONSTRAINT `FK_F8D79C30D7897FC9` FOREIGN KEY (`tfs_id`) REFERENCES `tfs` (`id`);

--
-- Contraintes pour la table `nature_operation_marche_unique`
--
ALTER TABLE `nature_operation_marche_unique`
  ADD CONSTRAINT `FK_20342644D7897FC9` FOREIGN KEY (`tfs_id`) REFERENCES `tfs` (`id`);

--
-- Contraintes pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `societe`
--
ALTER TABLE `societe`
  ADD CONSTRAINT `FK_19653DBDA10273AA` FOREIGN KEY (`titulaire_id`) REFERENCES `societe_titulaire` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
