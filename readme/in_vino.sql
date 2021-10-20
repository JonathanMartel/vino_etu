-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 20 oct. 2021 à 03:16
-- Version du serveur : 10.4.20-MariaDB
-- Version de PHP : 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `in_vino`
--

-- --------------------------------------------------------

--
-- Structure de la table `bouteilles`
--

CREATE TABLE `bouteilles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pays` char(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url_img` char(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_saq` char(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prix_saq` double(8,2) DEFAULT NULL,
  `url_saq` char(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type_id` bigint(20) UNSIGNED NOT NULL,
  `format_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `bouteilles`
--

INSERT INTO `bouteilles` (`id`, `nom`, `pays`, `url_img`, `description`, `code_saq`, `prix_saq`, `url_saq`, `created_at`, `updated_at`, `type_id`, `format_id`) VALUES
(1, 'Chardonnais', 'France', NULL, 'Je suis une description de Chardonnais', NULL, 25.00, NULL, NULL, NULL, 1, 1),
(2, 'Pinot', 'France', NULL, 'Je suis une description de Pinot', NULL, 15.00, NULL, NULL, NULL, 2, 1),
(3, 'Bordeaux', 'France', NULL, 'Je suis une description de Bordeaux', NULL, 15.00, NULL, NULL, NULL, 2, 1),
(4, 'Costières de Nîmes', 'France', NULL, 'Une bonne piquette du sud', NULL, NULL, NULL, NULL, NULL, 1, 15);

-- --------------------------------------------------------

--
-- Structure de la table `celliers`
--

CREATE TABLE `celliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` char(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `localisation` char(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `celliers`
--

INSERT INTO `celliers` (`id`, `nom`, `localisation`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'Rouges', 'Maison Montreal', NULL, NULL, 1),
(2, 'Blanc', 'Chalet Saint lin', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `cellier_bouteilles`
--

CREATE TABLE `cellier_bouteilles` (
  `id` bigint(20) NOT NULL,
  `date_achat` date DEFAULT NULL,
  `garde_jusqua` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` tinyint(4) DEFAULT NULL,
  `commentaire` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prix` double(8,2) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL,
  `millesime` year(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cellier_id` bigint(20) UNSIGNED NOT NULL,
  `bouteille_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cellier_bouteilles`
--

INSERT INTO `cellier_bouteilles` (`id`, `date_achat`, `garde_jusqua`, `note`, `commentaire`, `prix`, `quantite`, `millesime`, `created_at`, `updated_at`, `cellier_id`, `bouteille_id`) VALUES
(1, '2021-10-01', 'toto anniversaire', 4, 'J\'aime boire, normal, je suis un web dev', 25.00, 9, 2004, NULL, NULL, 1, 1),
(2, '2021-10-11', 'toto 2 anniversaire', 3, 'J\'aime boire beaucoup, normal, je suis un web dev', 15.00, 12, 2008, NULL, NULL, 1, 2),
(3, '2021-08-11', 'toto 3 anniversaire', 1, 'J\'aime pas boire beaucoup, pas normal, je suis un web dev', 45.00, 2, 2006, NULL, NULL, 1, 3),
(4, '2021-10-13', 'la fin de la bouteille', 4, 'La dernière goutte', 50.00, 36, NULL, NULL, NULL, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `formats`
--

CREATE TABLE `formats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` char(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taille` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `formats`
--

INSERT INTO `formats` (`id`, `nom`, `taille`, `created_at`, `updated_at`) VALUES
(1, 'Bouteille', 75.00, NULL, NULL),
(5, 'Quart', 20.00, NULL, NULL),
(6, 'Fillette ou Demie', 37.50, NULL, NULL),
(7, 'Medium ou Pinte', 50.00, NULL, NULL),
(8, 'Magnum', 150.00, NULL, NULL),
(9, 'Jeroboam', 300.00, NULL, NULL),
(10, 'Rehoboam', 450.00, NULL, NULL),
(11, 'Mathusalem', 600.00, NULL, NULL),
(12, 'Salmanazar', 900.00, NULL, NULL),
(13, 'Balthazar', 1200.00, NULL, NULL),
(14, 'Nabuchodonosor', 1500.00, NULL, NULL),
(15, 'Salomon', 1800.00, NULL, NULL),
(16, 'Souverain', 2625.00, NULL, NULL),
(17, 'Primat', 2700.00, NULL, NULL),
(18, 'Melchizedec ou Midas', 3000.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_10_19_181821_create_types_table', 1),
(6, '2021_10_19_181835_create_formats_table', 1),
(7, '2021_10_19_181857_create_bouteilles_table', 1),
(8, '2021_10_19_181911_create_celliers_table', 1),
(9, '2021_10_19_181928_create_cellier_bouteilles_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `mot_de_passe_resets`
--

CREATE TABLE `mot_de_passe_resets` (
  `courriel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `types`
--

CREATE TABLE `types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `types`
--

INSERT INTO `types` (`id`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Blanc', NULL, NULL),
(2, 'Rouge', NULL, NULL),
(5, 'Champagne', NULL, NULL),
(6, 'Champagne rosé', NULL, NULL),
(7, 'Mousseux', NULL, NULL),
(8, 'Rosé', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` char(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `courriel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `courriel_verified_at` timestamp NULL DEFAULT NULL,
  `mot_de_passe` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` date NOT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `courriel`, `courriel_verified_at`, `mot_de_passe`, `date_naissance`, `admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Julian', 'test@test.ca', NULL, '123456', '2021-10-01', NULL, NULL, NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bouteilles`
--
ALTER TABLE `bouteilles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bouteilles_type_id_foreign` (`type_id`),
  ADD KEY `bouteilles_format_id_foreign` (`format_id`);

--
-- Index pour la table `celliers`
--
ALTER TABLE `celliers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `celliers_user_id_foreign` (`user_id`);

--
-- Index pour la table `cellier_bouteilles`
--
ALTER TABLE `cellier_bouteilles`
  ADD PRIMARY KEY (`cellier_id`,`bouteille_id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_cellier_bouteilles_celliers1_idx` (`cellier_id`),
  ADD KEY `fk_cellier_bouteilles_bouteilles1_idx` (`bouteille_id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `formats`
--
ALTER TABLE `formats`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `mot_de_passe_resets`
--
ALTER TABLE `mot_de_passe_resets`
  ADD KEY `mot_de_passe_resets_courriel_index` (`courriel`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_courriel_unique` (`courriel`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bouteilles`
--
ALTER TABLE `bouteilles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `celliers`
--
ALTER TABLE `celliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `cellier_bouteilles`
--
ALTER TABLE `cellier_bouteilles`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `formats`
--
ALTER TABLE `formats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `types`
--
ALTER TABLE `types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `bouteilles`
--
ALTER TABLE `bouteilles`
  ADD CONSTRAINT `bouteilles_format_id_foreign` FOREIGN KEY (`format_id`) REFERENCES `formats` (`id`),
  ADD CONSTRAINT `bouteilles_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`);

--
-- Contraintes pour la table `celliers`
--
ALTER TABLE `celliers`
  ADD CONSTRAINT `celliers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `cellier_bouteilles`
--
ALTER TABLE `cellier_bouteilles`
  ADD CONSTRAINT `fk_cellier_bouteilles_bouteilles1` FOREIGN KEY (`bouteille_id`) REFERENCES `bouteilles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cellier_bouteilles_celliers1` FOREIGN KEY (`cellier_id`) REFERENCES `celliers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
