-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 21 oct. 2021 à 21:49
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
  `format_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `bouteilles`
--

INSERT INTO `bouteilles` (`id`, `nom`, `pays`, `url_img`, `description`, `code_saq`, `prix_saq`, `url_saq`, `created_at`, `updated_at`, `type_id`, `format_id`, `user_id`) VALUES
(1, 'Borsao Seleccion', 'Espagne', '//s7d9.scene7.com/is/image/SAQ/10324623_is?$saq-rech-prod-gril$', 'Vin rouge\r\n         \r\n      \r\n      \r\n      Espagne, 750 ml\r\n      \r\n      \r\n      Code SAQ : 10324623', '10324623', 11.00, 'https://www.saq.com/page/fr/saqcom/vin-rouge/borsao-seleccion/10324623', NULL, NULL, 1, 1, 1),
(2, 'Monasterio de Las Vinas Gran Reserva', 'Espagne', '//s7d9.scene7.com/is/image/SAQ/10359156_is?$saq-rech-prod-gril$', 'Vin rouge\r\n         \r\n      \r\n      \r\n      Espagne, 750 ml\r\n      \r\n      \r\n      Code SAQ : 10359156', '10359156', 19.00, 'https://www.saq.com/page/fr/saqcom/vin-rouge/monasterio-de-las-vinas-gran-reserva/10359156', NULL, NULL, 1, 1, 1),
(3, 'Castano Hecula', 'Espagne', '//s7d9.scene7.com/is/image/SAQ/11676671_is?$saq-rech-prod-gril$', 'Vin rouge\r\n         \r\n      \r\n      \r\n      Espagne, 750 ml\r\n      \r\n      \r\n      Code SAQ : 11676671', '11676671', 12.00, 'https://www.saq.com/page/fr/saqcom/vin-rouge/castano-hecula/11676671', NULL, NULL, 1, 1, 1),
(4, 'Campo Viejo Tempranillo Rioja', 'Espagne', '//s7d9.scene7.com/is/image/SAQ/11462446_is?$saq-rech-prod-gril$', 'Vin rouge\r\n         \r\n      \r\n      \r\n      Espagne, 750 ml\r\n      \r\n      \r\n      Code SAQ : 11462446', '11462446', 14.00, 'https://www.saq.com/page/fr/saqcom/vin-rouge/campo-viejo-tempranillo-rioja/11462446', NULL, NULL, 1, 1, 1),
(5, 'Bodegas Atalaya Laya 2017', 'Espagne', '//s7d9.scene7.com/is/image/SAQ/12375942_is?$saq-rech-prod-gril$', 'Vin rouge\r\n         \r\n      \r\n      \r\n      Espagne, 750 ml\r\n      \r\n      \r\n      Code SAQ : 12375942', '12375942', 17.00, 'https://www.saq.com/page/fr/saqcom/vin-rouge/bodegas-atalaya-laya-2017/12375942', NULL, NULL, 1, 1, 1),
(6, 'Vin Vault Pinot Grigio', 'États-Unis', '//s7d9.scene7.com/is/image/SAQ/13467048_is?$saq-rech-prod-gril$', 'Vin blanc\r\n         \r\n      \r\n      \r\n      États-Unis, 3 L\r\n      \r\n      \r\n      Code SAQ : 13467048', '13467048', NULL, 'https://www.saq.com/page/fr/saqcom/vin-blanc/vin-vault-pinot-grigio/13467048', NULL, NULL, 2, 9, 1),
(7, 'Huber Riesling Engelsberg 2017', 'Autriche', '//s7d9.scene7.com/is/image/SAQ/13675841_is?$saq-rech-prod-gril$', 'Vin blanc\r\n         \r\n      \r\n      \r\n      Autriche, 750 ml\r\n      \r\n      \r\n      Code SAQ : 13675841', '13675841', 22.00, 'https://www.saq.com/page/fr/saqcom/vin-blanc/huber-riesling-engelsberg-2017/13675841', NULL, NULL, 2, 1, 1),
(8, 'Dominio de Tares Estay Castilla y Léon 2015', 'Espagne', '//s7d9.scene7.com/is/image/SAQ/13802571_is?$saq-rech-prod-gril$', 'Vin rouge\r\n         \r\n      \r\n      \r\n      Espagne, 750 ml\r\n      \r\n      \r\n      Code SAQ : 13802571', '13802571', 18.00, 'https://www.saq.com/page/fr/saqcom/vin-rouge/dominio-de-tares-estay-castilla-y-leon-2015/13802571', NULL, NULL, 1, 1, 1),
(9, 'Tessellae Old Vines Côtes du Roussillon 2016', 'France', '//s7d9.scene7.com/is/image/SAQ/12216562_is?$saq-rech-prod-gril$', 'Vin rouge\r\n         \r\n      \r\n      \r\n      France, 750 ml\r\n      \r\n      \r\n      Code SAQ : 12216562', '12216562', 21.00, 'https://www.saq.com/page/fr/saqcom/vin-rouge/tessellae-old-vines-cotes-du-roussillon-2016/12216562', NULL, NULL, 1, 1, 1),
(10, 'Tenuta Il Falchetto Bricco Paradiso -... 2015', 'Italie', '//s7d9.scene7.com/is/image/SAQ/13637422_is?$saq-rech-prod-gril$', 'Vin rouge\r\n         \r\n      \r\n      \r\n      Italie, 750 ml\r\n      \r\n      \r\n      Code SAQ : 13637422', '13637422', 34.00, 'https://www.saq.com/page/fr/saqcom/vin-rouge/tenuta-il-falchetto-bricco-paradiso---barbera-dasti-superiore-docg-2015/13637422', NULL, NULL, 1, 1, 1),
(11, '1000 Stories Zinfandel Californie', 'États-Unis', 'https://www.saq.com/media/catalog/product/1/3/13584455-1_1578538222.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', 'Vin rouge | 750 ml | États-Unis', '13584455', 28.00, 'https://www.saq.com/fr/13584455', NULL, NULL, 1, 1, 1),
(12, '11th Hour Cellars Pinot Noir', 'États-Unis', 'https://www.saq.com/media/catalog/product/1/3/13966470-1_1578546924.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', 'Vin rouge | 750 ml | États-Unis', '13966470', 18.00, 'https://www.saq.com/fr/13966470', NULL, NULL, 1, 1, 1),
(13, '13th Street Winery Gamay 2019', 'Canada', 'https://www.saq.com/media/catalog/product/1/2/12705631-1_1582140016.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', 'Vin rouge | 750 ml | Canada', '12705631', 20.00, 'https://www.saq.com/fr/12705631', NULL, NULL, 1, 1, 1),
(14, '13th Street Winery Red Palette 2016', 'Canada', 'https://www.saq.com/media/catalog/product/1/2/12687823-1_1578361222.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', 'Vin rouge | 750 ml | Canada', '12687823', 19.00, 'https://www.saq.com/fr/12687823', NULL, NULL, 1, 1, 1),
(15, '14 Hands Cabernet-Sauvignon Columbia Valley', 'États-Unis', 'https://www.saq.com/media/wysiwyg/product_tags/pastille_gout/ac_small.png?width=20&height=20', 'Vin rouge | 750 ml | États-Unis', '13876247', 15.00, 'https://www.saq.com/fr/13876247', NULL, NULL, 1, 1, 1),
(16, '14 Hands Hot to Trot Columbia Valley', 'États-Unis', 'https://www.saq.com/media/wysiwyg/product_tags/pastille_gout/ac_small.png?width=20&height=20', 'Vin rouge | 750 ml | États-Unis', '12245611', 15.00, 'https://www.saq.com/fr/12245611', NULL, NULL, 1, 1, 1),
(17, '19 Crimes Cabernet-Sauvignon Limestone Coast', 'Australie', 'https://www.saq.com/media/wysiwyg/product_tags/pastille_gout/ac_small.png?width=20&height=20', 'Vin rouge | 750 ml | Australie', '12824197', 19.00, 'https://www.saq.com/fr/12824197', NULL, NULL, 1, 1, 1),
(18, '19 Crimes Cali 2020', 'États-Unis', 'https://www.saq.com/media/catalog/product/1/4/14713423-1_1616156727.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', 'Vin rouge | 750 ml | États-Unis', '14713423', 20.00, 'https://www.saq.com/fr/14713423', NULL, NULL, 1, 1, 1),
(19, '19 Crimes Shiraz/Grenache/Mataro', 'Australie', 'https://www.saq.com/media/wysiwyg/product_tags/pastille_gout/as_small.png?width=20&height=20', 'Vin rouge | 750 ml | Australie', '12073995', 19.00, 'https://www.saq.com/fr/12073995', NULL, NULL, 1, 1, 1),
(20, '19 Crimes The Uprising', 'Australie', 'https://www.saq.com/media/catalog/product/1/4/14715293-1_1615248955.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', 'Vin rouge | 375 ml | Australie', '14715293', 9.00, 'https://www.saq.com/fr/14715293', NULL, NULL, 1, 6, 1),
(21, '19 Crimes The Warden 2017', 'Australie', 'https://www.saq.com/media/catalog/product/1/3/13846179-1_1578543327.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', 'Vin rouge | 750 ml | Australie', '13846179', 30.00, 'https://www.saq.com/fr/13846179', NULL, NULL, 1, 1, 1),
(22, '3 Badge Leese-Fitch Merlot 2015', 'États-Unis', 'https://www.saq.com/media/wysiwyg/placeholder/category/06.png', 'Vin rouge | 750 ml | États-Unis', '13523011', 18.00, 'https://www.saq.com/fr/13523011', NULL, NULL, 1, 1, 1),
(23, '3 de Valandraud 2016', 'France', 'https://www.saq.com/media/catalog/product/1/3/13392031-1_1578535218.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', 'Vin rouge | 750 ml | France', '13392031', 53.00, 'https://www.saq.com/fr/13392031', NULL, NULL, 1, 1, 1),
(24, '3 de Valandraud St-Émilion Grand Cru 2015', 'France', 'https://www.saq.com/media/catalog/product/1/4/14767624-1_1631204434.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', 'Vin rouge | 1,5 L | France', '14767624', 98.00, 'https://www.saq.com/fr/14767624', NULL, NULL, 1, 8, 1),
(25, '3 Rings Shiraz 2017', 'Australie', 'https://www.saq.com/media/catalog/product/1/2/12815725-1_1603713617.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', 'Vin rouge | 750 ml | Australie', '12815725', 22.00, 'https://www.saq.com/fr/12815725', NULL, NULL, 1, 1, 1),
(26, '655 Miles Cabernet Sauvignon Lodi', 'États-Unis', 'https://www.saq.com/media/wysiwyg/product_tags/pastille_gout/as_small.png?width=20&height=20', 'Vin rouge | 750 ml | États-Unis', '14139863', 15.00, 'https://www.saq.com/fr/14139863', NULL, NULL, 1, 1, NULL),
(27, '7Colores Gran Reserva Valle Casablanca 2017', 'Chili', 'https://www.saq.com/media/catalog/product/1/4/14208427-1_1606227648.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', 'Vin rouge | 750 ml | Chili', '14208427', 19.00, 'https://www.saq.com/fr/14208427', NULL, NULL, 1, 1, NULL),
(28, 'A Mandria di Signadore Patrimonio 2019', 'France', 'https://www.saq.com/media/catalog/product/1/4/14736271-1_1624654560.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', 'Vin rouge | 750 ml | France', '14736271', 42.00, 'https://www.saq.com/fr/14736271', NULL, NULL, 1, 1, NULL),
(29, 'A Mandria di Signadore Patrimonio 2018', 'France', 'https://www.saq.com/media/catalog/product/1/1/11908161-1_1580629223.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', 'Vin rouge | 750 ml | France', '11908161', 41.00, 'https://www.saq.com/fr/11908161', NULL, NULL, 1, 1, NULL),
(30, 'A Occhipinti Rosso Arcaico 2019', 'Italie', 'https://www.saq.com/media/catalog/product/1/4/14651867-1_1612271137.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', 'Vin rouge | 750 ml | Italie', '14651867', 30.00, 'https://www.saq.com/fr/14651867', NULL, NULL, 1, 1, NULL),
(31, 'A thousand Lives Cabernet-Sauvignon Mendoza', 'Argentine', 'https://www.saq.com/media/wysiwyg/product_tags/pastille_gout/as_small.png?width=20&height=20', 'Vin rouge | 750 ml | Argentine', '14250211', 9.00, 'https://www.saq.com/fr/14250211', NULL, NULL, 1, 1, NULL),
(32, 'A.A. Badenhorst Family Blend 2018', 'Afrique du Sud', 'https://www.saq.com/media/catalog/product/1/2/12275298-1_1581958830.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', 'Vin rouge | 750 ml | Afrique du Sud', '12275298', 41.00, 'https://www.saq.com/fr/12275298', NULL, NULL, 1, 1, NULL),
(33, 'A.A. Badenhorst The Curator 2019', 'Afrique du Sud', 'https://www.saq.com/media/catalog/product/1/2/12819435-1_1589314084.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', 'Vin rouge | 750 ml | Afrique du Sud', '12819435', 13.00, 'https://www.saq.com/fr/12819435', NULL, NULL, 1, 1, NULL),
(34, 'AA Badenhorst Swartland Papegaai 2019', 'Afrique du Sud', 'https://www.saq.com/media/catalog/product/1/3/13632306-1_1578539713.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', 'Vin rouge | 750 ml | Afrique du Sud', '13632306', 19.00, 'https://www.saq.com/fr/13632306', NULL, NULL, 1, 1, NULL);

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
(1, 'Rouges', 'Maison Montreal', NULL, NULL, 2),
(2, 'Blanc', 'Chalet Saint lin', NULL, NULL, 2),
(3, 'Premier cellier de Brian', 'Montreal', NULL, NULL, 3);

-- --------------------------------------------------------

--
-- Structure de la table `cellier_bouteilles`
--

CREATE TABLE `cellier_bouteilles` (
  `date_achat` date DEFAULT NULL,
  `garde_jusqua` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` tinyint(4) DEFAULT NULL,
  `commentaire` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prix` double(8,2) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL,
  `millesime` year(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cellier_id` bigint(20) UNSIGNED NOT NULL,
  `bouteille_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cellier_bouteilles`
--

INSERT INTO `cellier_bouteilles` (`date_achat`, `garde_jusqua`, `note`, `commentaire`, `prix`, `quantite`, `millesime`, `created_at`, `updated_at`, `cellier_id`, `bouteille_id`) VALUES
('2019-01-26', 'non', NULL, '2019-01-26', 23.52, 19, 2015, NULL, NULL, 1, 3),
('0000-00-00', '', NULL, '', 0.00, 9, 0000, NULL, NULL, 1, 5),
('0000-00-00', '', NULL, '', 0.00, 10, 2000, NULL, NULL, 1, 8),
('2019-01-16', '2020', NULL, '2019-01-16', 22.00, 11, 1999, NULL, NULL, 1, 9),
('0000-00-00', '', NULL, '', 0.00, 3, 0000, NULL, NULL, 1, 10),
('0000-00-00', '', NULL, '', 0.00, 1, 0000, NULL, NULL, 1, 12),
('0000-00-00', '', NULL, '', 0.00, 1, 0000, NULL, NULL, 2, 5),
('0000-00-00', '', NULL, '', 0.00, 1, 0000, NULL, NULL, 2, 10),
('0000-00-00', '', NULL, '', 0.00, 1, 0000, NULL, NULL, 2, 12);

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
(1, 'Rouge', NULL, NULL),
(2, 'Blanc', NULL, NULL),
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
(1, 'Admin', 'test@test.ca', NULL, '123456', '2021-10-01', 1, NULL, NULL, NULL),
(2, 'Julian', 'julian@julian.ca', NULL, '123456', '2000-10-01', NULL, NULL, NULL, NULL),
(3, 'Brian', 'brian@brian.ca', NULL, '123456', '2000-01-01', NULL, NULL, NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bouteilles`
--
ALTER TABLE `bouteilles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bouteilles_type_id_foreign` (`type_id`),
  ADD KEY `bouteilles_format_id_foreign` (`format_id`),
  ADD KEY `bouteilles_user_id_foreign` (`user_id`);

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
  ADD PRIMARY KEY (`cellier_id`,`bouteille_id`,`millesime`) USING BTREE,
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `celliers`
--
ALTER TABLE `celliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `formats`
--
ALTER TABLE `formats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `bouteilles`
--
ALTER TABLE `bouteilles`
  ADD CONSTRAINT `bouteilles_format_id_foreign` FOREIGN KEY (`format_id`) REFERENCES `formats` (`id`),
  ADD CONSTRAINT `bouteilles_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`),
  ADD CONSTRAINT `bouteilles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

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
