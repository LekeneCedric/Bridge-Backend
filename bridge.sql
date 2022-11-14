-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 07 oct. 2022 à 20:42
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bridge`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonces`
--

CREATE TABLE `annonces` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `association_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `intitule` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nbvue` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `appartenirs`
--

CREATE TABLE `appartenirs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `association_id` bigint(20) UNSIGNED NOT NULL,
  `donateur_id` bigint(20) UNSIGNED NOT NULL,
  `valide` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `associations`
--

CREATE TABLE `associations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pays` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_contribuable` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_responsable` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` double(8,2) DEFAULT NULL,
  `latitude` double(8,2) DEFAULT NULL,
  `verifie` tinyint(1) NOT NULL DEFAULT 0,
  `valide` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `asso_dons`
--

CREATE TABLE `asso_dons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `association_id` bigint(20) UNSIGNED NOT NULL,
  `donateur_id` bigint(20) UNSIGNED NOT NULL,
  `besoin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `titre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etat` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantite` int(11) NOT NULL,
  `longitude` double(8,2) DEFAULT NULL,
  `latitude` double(8,2) DEFAULT NULL,
  `verifie` tinyint(1) NOT NULL DEFAULT 0,
  `valide` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `besoins`
--

CREATE TABLE `besoins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `association_id` bigint(20) UNSIGNED NOT NULL,
  `contenu` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attente` int(11) NOT NULL DEFAULT 0,
  `resolu` int(11) NOT NULL DEFAULT 0,
  `quantite` int(11) NOT NULL,
  `quantite_actuelle` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `category_annonces`
--

CREATE TABLE `category_annonces` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `intitule` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `category_associations`
--

CREATE TABLE `category_associations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `intitule` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `category_besoins`
--

CREATE TABLE `category_besoins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `intitule` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `category_demandes`
--

CREATE TABLE `category_demandes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `intitule` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `category_dons`
--

CREATE TABLE `category_dons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `intitule` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `category_mouvements`
--

CREATE TABLE `category_mouvements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `intitule` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `demandes`
--

CREATE TABLE `demandes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `donateur_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenu` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resolu` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `donateurs`
--

CREATE TABLE `donateurs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` date DEFAULT NULL,
  `sexe` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pays` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verifie` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `dons`
--

CREATE TABLE `dons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `donateur_id` bigint(20) UNSIGNED NOT NULL,
  `titre` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etat` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `disponibilite` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` double(8,2) DEFAULT NULL,
  `latitude` double(8,2) DEFAULT NULL,
  `nombre_reserve` int(11) NOT NULL DEFAULT 0,
  `disponible` int(11) NOT NULL DEFAULT 0,
  `verifie` tinyint(1) NOT NULL DEFAULT 0,
  `valide` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `donateur_id` bigint(20) UNSIGNED NOT NULL,
  `annonce_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `association_id` bigint(20) UNSIGNED DEFAULT NULL,
  `annonce_id` bigint(20) UNSIGNED DEFAULT NULL,
  `donateur_id` bigint(20) UNSIGNED DEFAULT NULL,
  `don_id` bigint(20) UNSIGNED DEFAULT NULL,
  `mouvement_id` bigint(20) UNSIGNED DEFAULT NULL,
  `asso_don_id` bigint(20) UNSIGNED DEFAULT NULL,
  `filePath` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fileName` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `donateur_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `contenu` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `vu` int(11) NOT NULL DEFAULT 0,
  `demande_id` bigint(20) UNSIGNED DEFAULT NULL,
  `don_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(5, '2022_08_21_190343_create_associations_table', 1),
(6, '2022_08_22_190203_create_donateurs_table', 1),
(7, '2022_08_22_190245_create_annonces_table', 1),
(8, '2022_08_22_190304_create_demandes_table', 1),
(9, '2022_08_22_190317_create_besoins_table', 1),
(10, '2022_08_22_190328_create_mouvements_table', 1),
(11, '2022_08_22_190400_create_dons_table', 1),
(12, '2022_08_22_190401_create_recus_table', 1),
(13, '2022_08_22_190916_create_category_annonces_table', 1),
(14, '2022_08_22_190931_create_category_demandes_table', 1),
(15, '2022_08_22_190939_create_category_besoins_table', 1),
(16, '2022_08_22_190957_create_category_mouvements_table', 1),
(17, '2022_08_22_191011_create_category_associations_table', 1),
(18, '2022_08_22_191040_create_category_dons_table', 1),
(19, '2022_08_22_193851_create_messages_table', 1),
(20, '2022_08_23_140437_create_participers_table', 1),
(21, '2022_08_23_140449_create_appartenirs_table', 1),
(22, '2022_08_23_181011_create_reservers_table', 1),
(23, '2022_09_14_092136_create_socials_table', 1),
(24, '2022_09_22_133905_create_asso_dons_table', 1),
(25, '2022_09_22_191608_create_likes_table', 1),
(26, '2022_09_23_090904_create_media_table', 1),
(27, '2022_09_28_073735_create_notifications_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `mouvements`
--

CREATE TABLE `mouvements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `association_id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `intitule` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_rencontre` date NOT NULL,
  `heure_debut` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `heure_fin` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` double(8,2) DEFAULT NULL,
  `latitude` double(8,2) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `donateur_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `vu` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `participers`
--

CREATE TABLE `participers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mouvement_id` bigint(20) UNSIGNED NOT NULL,
  `donateur_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `recus`
--

CREATE TABLE `recus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contenu` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `don_id` bigint(20) UNSIGNED NOT NULL,
  `association_id` bigint(20) UNSIGNED NOT NULL,
  `donateur_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reservers`
--

CREATE TABLE `reservers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `don_id` bigint(20) UNSIGNED NOT NULL,
  `donateur_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `socials`
--

CREATE TABLE `socials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `association_id` bigint(20) UNSIGNED DEFAULT NULL,
  `donateur_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `annonces`
--
ALTER TABLE `annonces`
  ADD PRIMARY KEY (`id`),
  ADD KEY `annonces_association_id_foreign` (`association_id`);

--
-- Index pour la table `appartenirs`
--
ALTER TABLE `appartenirs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appartenirs_association_id_foreign` (`association_id`),
  ADD KEY `appartenirs_donateur_id_foreign` (`donateur_id`);

--
-- Index pour la table `associations`
--
ALTER TABLE `associations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `asso_dons`
--
ALTER TABLE `asso_dons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asso_dons_association_id_foreign` (`association_id`),
  ADD KEY `asso_dons_donateur_id_foreign` (`donateur_id`),
  ADD KEY `asso_dons_besoin_id_foreign` (`besoin_id`);

--
-- Index pour la table `besoins`
--
ALTER TABLE `besoins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `besoins_association_id_foreign` (`association_id`);

--
-- Index pour la table `category_annonces`
--
ALTER TABLE `category_annonces`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `category_associations`
--
ALTER TABLE `category_associations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `category_besoins`
--
ALTER TABLE `category_besoins`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `category_demandes`
--
ALTER TABLE `category_demandes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `category_dons`
--
ALTER TABLE `category_dons`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `category_mouvements`
--
ALTER TABLE `category_mouvements`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `demandes`
--
ALTER TABLE `demandes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `demandes_donateur_id_foreign` (`donateur_id`);

--
-- Index pour la table `donateurs`
--
ALTER TABLE `donateurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `dons`
--
ALTER TABLE `dons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dons_donateur_id_foreign` (`donateur_id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `likes_donateur_id_foreign` (`donateur_id`),
  ADD KEY `likes_annonce_id_foreign` (`annonce_id`);

--
-- Index pour la table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_association_id_foreign` (`association_id`),
  ADD KEY `media_annonce_id_foreign` (`annonce_id`),
  ADD KEY `media_donateur_id_foreign` (`donateur_id`),
  ADD KEY `media_don_id_foreign` (`don_id`),
  ADD KEY `media_mouvement_id_foreign` (`mouvement_id`),
  ADD KEY `media_asso_don_id_foreign` (`asso_don_id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_donateur_id_foreign` (`donateur_id`),
  ADD KEY `messages_demande_id_foreign` (`demande_id`),
  ADD KEY `messages_don_id_foreign` (`don_id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `mouvements`
--
ALTER TABLE `mouvements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mouvements_association_id_foreign` (`association_id`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_donateur_id_foreign` (`donateur_id`);

--
-- Index pour la table `participers`
--
ALTER TABLE `participers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `participers_mouvement_id_foreign` (`mouvement_id`),
  ADD KEY `participers_donateur_id_foreign` (`donateur_id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `recus`
--
ALTER TABLE `recus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recus_don_id_foreign` (`don_id`),
  ADD KEY `recus_association_id_foreign` (`association_id`),
  ADD KEY `recus_donateur_id_foreign` (`donateur_id`);

--
-- Index pour la table `reservers`
--
ALTER TABLE `reservers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservers_don_id_foreign` (`don_id`),
  ADD KEY `reservers_donateur_id_foreign` (`donateur_id`);

--
-- Index pour la table `socials`
--
ALTER TABLE `socials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `socials_association_id_foreign` (`association_id`),
  ADD KEY `socials_donateur_id_foreign` (`donateur_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `annonces`
--
ALTER TABLE `annonces`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `appartenirs`
--
ALTER TABLE `appartenirs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `associations`
--
ALTER TABLE `associations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `asso_dons`
--
ALTER TABLE `asso_dons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `besoins`
--
ALTER TABLE `besoins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `category_annonces`
--
ALTER TABLE `category_annonces`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `category_associations`
--
ALTER TABLE `category_associations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `category_besoins`
--
ALTER TABLE `category_besoins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `category_demandes`
--
ALTER TABLE `category_demandes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `category_dons`
--
ALTER TABLE `category_dons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `category_mouvements`
--
ALTER TABLE `category_mouvements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `demandes`
--
ALTER TABLE `demandes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `donateurs`
--
ALTER TABLE `donateurs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `dons`
--
ALTER TABLE `dons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `mouvements`
--
ALTER TABLE `mouvements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `participers`
--
ALTER TABLE `participers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `recus`
--
ALTER TABLE `recus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reservers`
--
ALTER TABLE `reservers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `socials`
--
ALTER TABLE `socials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `annonces`
--
ALTER TABLE `annonces`
  ADD CONSTRAINT `annonces_association_id_foreign` FOREIGN KEY (`association_id`) REFERENCES `associations` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `appartenirs`
--
ALTER TABLE `appartenirs`
  ADD CONSTRAINT `appartenirs_association_id_foreign` FOREIGN KEY (`association_id`) REFERENCES `associations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appartenirs_donateur_id_foreign` FOREIGN KEY (`donateur_id`) REFERENCES `donateurs` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `asso_dons`
--
ALTER TABLE `asso_dons`
  ADD CONSTRAINT `asso_dons_association_id_foreign` FOREIGN KEY (`association_id`) REFERENCES `associations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `asso_dons_besoin_id_foreign` FOREIGN KEY (`besoin_id`) REFERENCES `besoins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `asso_dons_donateur_id_foreign` FOREIGN KEY (`donateur_id`) REFERENCES `donateurs` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `besoins`
--
ALTER TABLE `besoins`
  ADD CONSTRAINT `besoins_association_id_foreign` FOREIGN KEY (`association_id`) REFERENCES `associations` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `demandes`
--
ALTER TABLE `demandes`
  ADD CONSTRAINT `demandes_donateur_id_foreign` FOREIGN KEY (`donateur_id`) REFERENCES `donateurs` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `dons`
--
ALTER TABLE `dons`
  ADD CONSTRAINT `dons_donateur_id_foreign` FOREIGN KEY (`donateur_id`) REFERENCES `donateurs` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_annonce_id_foreign` FOREIGN KEY (`annonce_id`) REFERENCES `annonces` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_donateur_id_foreign` FOREIGN KEY (`donateur_id`) REFERENCES `donateurs` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_annonce_id_foreign` FOREIGN KEY (`annonce_id`) REFERENCES `annonces` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `media_asso_don_id_foreign` FOREIGN KEY (`asso_don_id`) REFERENCES `asso_dons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `media_association_id_foreign` FOREIGN KEY (`association_id`) REFERENCES `associations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `media_don_id_foreign` FOREIGN KEY (`don_id`) REFERENCES `dons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `media_donateur_id_foreign` FOREIGN KEY (`donateur_id`) REFERENCES `donateurs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `media_mouvement_id_foreign` FOREIGN KEY (`mouvement_id`) REFERENCES `mouvements` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_demande_id_foreign` FOREIGN KEY (`demande_id`) REFERENCES `demandes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_don_id_foreign` FOREIGN KEY (`don_id`) REFERENCES `dons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_donateur_id_foreign` FOREIGN KEY (`donateur_id`) REFERENCES `donateurs` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `mouvements`
--
ALTER TABLE `mouvements`
  ADD CONSTRAINT `mouvements_association_id_foreign` FOREIGN KEY (`association_id`) REFERENCES `associations` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_donateur_id_foreign` FOREIGN KEY (`donateur_id`) REFERENCES `donateurs` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `participers`
--
ALTER TABLE `participers`
  ADD CONSTRAINT `participers_donateur_id_foreign` FOREIGN KEY (`donateur_id`) REFERENCES `donateurs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `participers_mouvement_id_foreign` FOREIGN KEY (`mouvement_id`) REFERENCES `mouvements` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `recus`
--
ALTER TABLE `recus`
  ADD CONSTRAINT `recus_association_id_foreign` FOREIGN KEY (`association_id`) REFERENCES `associations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `recus_don_id_foreign` FOREIGN KEY (`don_id`) REFERENCES `dons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `recus_donateur_id_foreign` FOREIGN KEY (`donateur_id`) REFERENCES `donateurs` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reservers`
--
ALTER TABLE `reservers`
  ADD CONSTRAINT `reservers_don_id_foreign` FOREIGN KEY (`don_id`) REFERENCES `dons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservers_donateur_id_foreign` FOREIGN KEY (`donateur_id`) REFERENCES `donateurs` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `socials`
--
ALTER TABLE `socials`
  ADD CONSTRAINT `socials_association_id_foreign` FOREIGN KEY (`association_id`) REFERENCES `associations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `socials_donateur_id_foreign` FOREIGN KEY (`donateur_id`) REFERENCES `donateurs` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
