-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 15, 2021 at 06:12 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `archive_app2`
--

-- --------------------------------------------------------

--
-- Table structure for table `bon_commande`
--

CREATE TABLE `bon_commande` (
  `id` int(11) NOT NULL,
  `titulaire_id` int(11) NOT NULL,
  `societe_id` int(11) NOT NULL,
  `nature_operation_id` int(11) NOT NULL,
  `tfs_id` int(11) NOT NULL,
  `devise_id` int(11) NOT NULL,
  `num_bc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_bc` smallint(6) NOT NULL,
  `fontionnement_investissement` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee_budgetaire` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `montant` double NOT NULL,
  `line_budgetaire_id` int(11) NOT NULL,
  `document_passation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document_execution` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_doc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_bar_img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `demande_devis` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `devis_contradictoire` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bon_livraison` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bordereau` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ordonnancement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avis_virement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contrat`
--

CREATE TABLE `contrat` (
  `id` int(11) NOT NULL,
  `titulaire_id` int(11) NOT NULL,
  `societe_id` int(11) NOT NULL,
  `nature_operation_id` int(11) NOT NULL,
  `devise_id` int(11) NOT NULL,
  `num_cc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_contrat` smallint(6) NOT NULL,
  `fontionnement_investissement` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee_budgetaire` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `montant` double NOT NULL,
  `line_budgetaire_id` int(11) NOT NULL,
  `document_passation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document_execution` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_doc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_bar_img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `demande_devis` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lettre_sntl` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contrat_signe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `convention_signe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `devis_contradictoire` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contrat_signe_paiement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bon_livraison` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bordereau` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ordonnancement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avis_virement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `depense`
--

CREATE TABLE `depense` (
  `id` int(11) NOT NULL,
  `beneficiaire_id` int(11) NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `objet` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `obs` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `montant` double NOT NULL,
  `document_passation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document_execution` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `document_ordre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_dpense_id` int(11) NOT NULL,
  `date_depense` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `depense`
--

INSERT INTO `depense` (`id`, `beneficiaire_id`, `reference`, `objet`, `obs`, `montant`, `document_passation`, `document_execution`, `created_at`, `updated_at`, `document_ordre`, `type_dpense_id`, `date_depense`) VALUES
(2, 1, '12', 'test', NULL, 3490, NULL, NULL, '2021-12-13 11:01:14', '2021-12-13 11:01:14', NULL, 1, NULL),
(3, 1, '23', 'test2', NULL, 1457.23, NULL, NULL, '2021-12-13 11:05:30', '2021-12-13 11:05:30', NULL, 1, NULL),
(4, 1, '34', 'envoie de courier', NULL, 1000.29, NULL, NULL, '2021-12-13 11:06:12', '2021-12-13 11:28:40', NULL, 1, '2021-12-21');

-- --------------------------------------------------------

--
-- Table structure for table `devise`
--

CREATE TABLE `devise` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `devise`
--

INSERT INTO `devise` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'DH', '2021-11-11 11:18:24', '2021-11-11 11:18:24'),
(2, 'Dollar', '2021-12-06 12:15:10', '2021-12-06 12:15:10'),
(3, 'Euro', '2021-12-06 12:15:19', '2021-12-06 12:15:19');

-- --------------------------------------------------------

--
-- Table structure for table `ligne_budgetaire`
--

CREATE TABLE `ligne_budgetaire` (
  `id` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `fontionnement_investissement` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rubrique` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ligne_budgetaire`
--

INSERT INTO `ligne_budgetaire` (`id`, `num`, `fontionnement_investissement`, `rubrique`, `created_at`, `updated_at`) VALUES
(1, 10, 'F', 'charges immobilières', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 11, 'F', 'ImpÙts et taxes', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 12, 'F', 'Locations de bâtiments administratifs et charges connexes', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 13, 'F', 'Entretien et réparation des b‚timents administratifs', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 14, 'F', 'Agencement, aménagement et installation', '2021-12-06 13:00:29', '2021-12-06 13:00:29'),
(6, 15, 'F', 'Achat de produits de chauffage et de cuisson.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 20, 'F', 'Taxes et redevances ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 21, 'F', 'Taxes et redevances de télécommunications.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 22, 'F', 'Taxes postales et frais d\'affranchissement.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 23, 'F', 'Redevances d\'eau.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 24, 'F', 'Redevances d\'électricité.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 25, 'F', 'Droits d\'enregistrement et de timbre.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 30, 'F', 'Maintenance et réparation du matériel', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 31, 'F', 'Entretien et réparation du matériel de transmission.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 32, 'F', 'Frais de maintenance du matériel informatique et des logiciels.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 33, 'F', 'Entretien du matériel technique et électronique.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 34, 'F', 'Entretien et réparation du matériel électrique.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 40, 'F', 'Développement, reproduction et télédétection', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 41, 'F', 'Achat de produits de développement et de reproduction.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 42, 'F', 'Frais relatifs aux travaux de développement et de reproduction.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 43, 'F', 'Achat de produits télédétection.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 44, 'F', 'Achat de logiciels de traitement et d\'exploitation d\'images.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 50, 'F', 'Mobilier, matériel et fournitures de bureau', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 51, 'F', 'Achat de matériel et mobilier de bureau.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 52, 'F', 'Entretien et réparation du mobilier et du matériel de bureau.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 53, 'F', 'Location de matériel et mobilier.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 54, 'F', 'Fourniture de bureau, produits d\'impression, papeterie et imprimés.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 55, 'F', 'Fourniture pour le matériel technique et informatique.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 60, 'F', 'Parc automobile', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 61, 'F', 'Carburants, combustibles et ingrédients.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 62, 'F', 'Frais d\'entretien et de réparation des véhicules.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 63, 'F', 'Frais d\'assurances des véhicules.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 64, 'F', 'Taxe spéciale annuelle sur les véhicules automobiles.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 70, 'F', 'Transport et déplacement', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 71, 'F', 'Frais de transport du personnel à l\'intérieur du Maroc.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 72, 'F', 'Frais de transport du matériel.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 73, 'F', 'Frais de transport du personnel à l\'étranger.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 80, 'F', 'Etudes, conseil, assistance et services assimilés.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 81, 'F', 'Etudes générales.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 82, 'F', 'Abonnement et documentation.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 83, 'F', 'Frais de formation.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 84, 'F', 'Frais de publicité et d\'insertion.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 85, 'F', 'Frais de consultation et d\'expertise.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 86, 'F', 'Assistance technique et conseils.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 90, 'F', 'Dépense diverses', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 91, 'F', 'Frais de douane.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 92, 'F', 'Frais de reception et de cérémonies officielles.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 93, 'F', 'Frais d\'organisation de stages et de séminaires.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 94, 'F', 'Cotisation aux organismes internationaux.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 95, 'F', 'Habillement des agents de service.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 96, 'F', 'Frais bancaires.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 97, 'F', 'Versement au budget général', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 98, 'F', 'Crédits non programmés.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 10, 'I', 'Achat de terrains.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 20, 'I', 'Construction de bâtiments administratifs.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 30, 'I', 'Travaux d\'aménagement de bâtiments et d\'installation.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 40, 'I', 'Entretien et réparation des bâtiments administratifs.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 50, 'I', 'Etudes et assistance.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 60, 'I', 'Frais de publicité et d\'insertion.', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `marche_unique`
--

CREATE TABLE `marche_unique` (
  `id` int(11) NOT NULL,
  `titulaire_id` int(11) NOT NULL,
  `societe_id` int(11) NOT NULL,
  `nature_operation_id` int(11) NOT NULL,
  `tfs_id` int(11) NOT NULL,
  `devise_id` int(11) NOT NULL,
  `num_marche` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_marche` smallint(6) NOT NULL,
  `mode_passassion` smallint(6) NOT NULL,
  `fontionnement_investissement` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee_budgetaire` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `montant` double NOT NULL,
  `line_budgetaire_id` int(11) NOT NULL,
  `document_passation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document_execution` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `code_doc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_bar_img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lettre_de_lancement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `decision` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avis_journaux` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `convocation_tm` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pv_technique` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lettre_justification` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lettre_complement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marche_signe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certificat_administratif` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avis_journaux_engagement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caution` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pouvoir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `retenue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fiche_modele` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `etat_engagement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marche_signe_paiement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fiche_intervention` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `decomptes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proces_verbal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bordereau` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ordonnancement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avis_virement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `marche_unique`
--

INSERT INTO `marche_unique` (`id`, `titulaire_id`, `societe_id`, `nature_operation_id`, `tfs_id`, `devise_id`, `num_marche`, `type_marche`, `mode_passassion`, `fontionnement_investissement`, `annee_budgetaire`, `montant`, `line_budgetaire_id`, `document_passation`, `document_execution`, `created_at`, `updated_at`, `code_doc`, `code_bar_img`, `lettre_de_lancement`, `decision`, `avis_journaux`, `convocation_tm`, `pv_technique`, `lettre_justification`, `lettre_complement`, `marche_signe`, `certificat_administratif`, `avis_journaux_engagement`, `caution`, `pouvoir`, `retenue`, `fiche_modele`, `etat_engagement`, `marche_signe_paiement`, `facture`, `fiche_intervention`, `decomptes`, `proces_verbal`, `bordereau`, `ordonnancement`, `avis_virement`) VALUES
(1, 1, 2, 1, 1, 1, '05', 0, 0, 'F', '2021', 100000, 1, NULL, NULL, '2021-11-30 17:44:28', '2021-11-30 17:44:28', '05 T 1001 01 10 F 2021', '05T10010110F2021.jpg', 'pe-converti-61a654ec4c144637358048.pdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pe-converti-61a654ec4c76d084792284.pdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pe-converti-61a654ec4cb71840360266.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `nature_operation_bon_commande`
--

CREATE TABLE `nature_operation_bon_commande` (
  `id` int(11) NOT NULL,
  `tfs_id` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nature_operation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nature_operation_contrat`
--

CREATE TABLE `nature_operation_contrat` (
  `id` int(11) NOT NULL,
  `tfs_id` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nature_operation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nature_operation_depense`
--

CREATE TABLE `nature_operation_depense` (
  `id` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nature_operation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nature_operation_depense`
--

INSERT INTO `nature_operation_depense` (`id`, `code`, `nature_operation`) VALUES
(1, '01', 'Achat de billet');

-- --------------------------------------------------------

--
-- Table structure for table `nature_operation_marche_reconductible`
--

CREATE TABLE `nature_operation_marche_reconductible` (
  `id` int(11) NOT NULL,
  `tfs_id` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nature_operation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nature_operation_marche_unique`
--

CREATE TABLE `nature_operation_marche_unique` (
  `id` int(11) NOT NULL,
  `tfs_id` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nature_operation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nature_operation_marche_unique`
--

INSERT INTO `nature_operation_marche_unique` (`id`, `tfs_id`, `code`, `nature_operation`) VALUES
(1, 2, '01', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `nature_recette`
--

CREATE TABLE `nature_recette` (
  `id` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nature_operation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nature_recette`
--

INSERT INTO `nature_recette` (`id`, `code`, `nature_operation`) VALUES
(3, '1', 'Location salle');

-- --------------------------------------------------------

--
-- Table structure for table `personnel`
--

CREATE TABLE `personnel` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personnel`
--

INSERT INTO `personnel` (`id`, `name`, `adresse`, `created_at`, `updated_at`, `code`) VALUES
(1, 'Barid Al Maghreb', 'Rabat', '2021-12-03 23:39:00', '2021-12-03 23:39:00', '1');

-- --------------------------------------------------------

--
-- Table structure for table `recette`
--

CREATE TABLE `recette` (
  `id` int(11) NOT NULL,
  `nature_recette_id` int(11) NOT NULL,
  `num_cc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `partieversantes` varchar(800) COLLATE utf8mb4_unicode_ci NOT NULL,
  `obs` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `montant` double NOT NULL,
  `document_passation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document_execution` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `document_autre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document_bon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_recette` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_recette` date DEFAULT NULL,
  `document_notif` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document_ordre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recette`
--

INSERT INTO `recette` (`id`, `nature_recette_id`, `num_cc`, `partieversantes`, `obs`, `montant`, `document_passation`, `document_execution`, `created_at`, `updated_at`, `document_autre`, `document_bon`, `type_recette`, `date_recette`, `document_notif`, `document_ordre`) VALUES
(1, 3, '123', 'insea', 'ras', 23555, NULL, NULL, '2021-11-30 17:52:36', '2021-12-13 10:49:45', NULL, NULL, 'Recette Directe', NULL, 'document-61b71739bfe89976476329.pdf', 'document-61b71739c09dc718113651.pdf'),
(2, 3, '4', 'insea', NULL, 345, NULL, NULL, '2021-12-06 17:11:52', '2021-12-06 17:12:16', NULL, NULL, 'Recette Directe', '2021-12-23', NULL, NULL),
(3, 3, '22', 'insea', NULL, 3000, NULL, NULL, '2021-12-06 18:19:22', '2021-12-06 18:19:22', NULL, NULL, 'Recette via GID', '2021-12-29', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reset_password_request`
--

CREATE TABLE `reset_password_request` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `selector` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hashed_token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requested_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `societe`
--

CREATE TABLE `societe` (
  `id` int(11) NOT NULL,
  `titulaire_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_societe` int(11) DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `societe`
--

INSERT INTO `societe` (`id`, `titulaire_id`, `name`, `code_societe`, `adresse`, `created_at`, `updated_at`) VALUES
(2, 1, '3f industrie', 0, '36, rue imam al boukhari maarif', '2021-10-26 16:58:14', '2021-10-26 16:58:14'),
(3, 1, '3f industrie', 0, '36, rue imam al boukhari maarif', '2021-10-26 20:27:17', '2021-10-26 20:27:17'),
(4, 1, 'TEST', 2, 'TEST', '2021-10-26 20:27:33', '2021-10-26 20:27:33');

-- --------------------------------------------------------

--
-- Table structure for table `societe_titulaire`
--

CREATE TABLE `societe_titulaire` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `societe_titulaire`
--

INSERT INTO `societe_titulaire` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Marocaine', '2021-10-26 16:02:47', '2021-10-26 16:02:47'),
(2, 'Francaise', '2021-10-26 21:01:19', '2021-10-26 21:01:19');

-- --------------------------------------------------------

--
-- Table structure for table `tfs`
--

CREATE TABLE `tfs` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tfs`
--

INSERT INTO `tfs` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, 'Travaux', 'T', '2021-11-08 19:20:18', '2021-11-08 19:20:18'),
(2, 'Fourniture', 'F', '2021-11-08 19:20:47', '2021-11-08 19:20:47'),
(3, 'Service', 'S', '2021-11-08 19:20:53', '2021-11-08 19:20:53');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`roles`)),
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `phone` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `roles`, `password`, `is_verified`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'ARBOUH', 'Youness', 'youness.arbouh@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$8O4QsyIsovW1hr9SwQ75zOZMreB9HGYByM5xim8PHmS2PbieUaLrC', 1, '+2126963180518', '2021-10-20 22:08:36', '2021-11-08 15:47:07'),
(18, 'Abderahman', 'Simmons', 'utilisateur@crts.ma', '[\"ROLE_USER\"]', '$2y$13$8O4QsyIsovW1hr9SwQ75zOZMreB9HGYByM5xim8PHmS2PbieUaLrC', 1, '+1 (895) 593-6522', '2021-11-08 14:34:52', '2021-11-08 16:10:42'),
(19, 'Nabil', 'SAIDI', 'agent@crts.ma', '[\"ROLE_AGENT\"]', '$2y$13$8O4QsyIsovW1hr9SwQ75zOZMreB9HGYByM5xim8PHmS2PbieUaLrC', 1, '+1 (996) 587-1587', '2021-11-08 14:57:05', '2021-11-11 11:46:32'),
(20, 'Dris', 'Qmichou', 'qmichou@crts.ac.ma', '[\"ROLE_REGIE\"]', '$2y$13$AJ4Y.aFL8SgL0LpZmMpzZuqJhGmZcSK4at/73CnmWY2hmARbV/dj.', 1, '0612456778', '2021-12-01 09:20:31', '2021-12-01 09:20:31'),
(21, 'Nabil', 'SAIDI', 'msaidi@insea.ac.ma', '[\"ROLE_ADMIN\"]', '$2y$13$LAC/USSYNt3dOQjlTwmXYOT.fDBaD6fz0AVICkb1J00tgueJ3/Jke', 1, '0610415428', '2021-12-13 11:46:56', '2021-12-13 11:46:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bon_commande`
--
ALTER TABLE `bon_commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_159D9576A10273AA` (`titulaire_id`),
  ADD KEY `IDX_159D9576FCF77503` (`societe_id`),
  ADD KEY `IDX_159D957628C42716` (`nature_operation_id`),
  ADD KEY `IDX_159D9576D7897FC9` (`tfs_id`),
  ADD KEY `IDX_159D9576F4445056` (`devise_id`),
  ADD KEY `IDX_159D9576BCD1DB57` (`line_budgetaire_id`);

--
-- Indexes for table `contrat`
--
ALTER TABLE `contrat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_60349993A10273AA` (`titulaire_id`),
  ADD KEY `IDX_60349993FCF77503` (`societe_id`),
  ADD KEY `IDX_6034999328C42716` (`nature_operation_id`),
  ADD KEY `IDX_60349993F4445056` (`devise_id`),
  ADD KEY `IDX_60349993BCD1DB57` (`line_budgetaire_id`);

--
-- Indexes for table `depense`
--
ALTER TABLE `depense`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_340597575AF81F68` (`beneficiaire_id`),
  ADD KEY `IDX_340597573FEA98E2` (`type_dpense_id`);

--
-- Indexes for table `devise`
--
ALTER TABLE `devise`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ligne_budgetaire`
--
ALTER TABLE `ligne_budgetaire`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marche_unique`
--
ALTER TABLE `marche_unique`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C28F6B6DA10273AA` (`titulaire_id`),
  ADD KEY `IDX_C28F6B6DFCF77503` (`societe_id`),
  ADD KEY `IDX_C28F6B6D28C42716` (`nature_operation_id`),
  ADD KEY `IDX_C28F6B6DD7897FC9` (`tfs_id`),
  ADD KEY `IDX_C28F6B6DF4445056` (`devise_id`),
  ADD KEY `IDX_C28F6B6DBCD1DB57` (`line_budgetaire_id`);

--
-- Indexes for table `nature_operation_bon_commande`
--
ALTER TABLE `nature_operation_bon_commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_16AAA8BFD7897FC9` (`tfs_id`);

--
-- Indexes for table `nature_operation_contrat`
--
ALTER TABLE `nature_operation_contrat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_AF8F9019D7897FC9` (`tfs_id`);

--
-- Indexes for table `nature_operation_depense`
--
ALTER TABLE `nature_operation_depense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nature_operation_marche_reconductible`
--
ALTER TABLE `nature_operation_marche_reconductible`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F8D79C30D7897FC9` (`tfs_id`);

--
-- Indexes for table `nature_operation_marche_unique`
--
ALTER TABLE `nature_operation_marche_unique`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_20342644D7897FC9` (`tfs_id`);

--
-- Indexes for table `nature_recette`
--
ALTER TABLE `nature_recette`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personnel`
--
ALTER TABLE `personnel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recette`
--
ALTER TABLE `recette`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_49BB6390654F9C7E` (`nature_recette_id`);

--
-- Indexes for table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7CE748AA76ED395` (`user_id`);

--
-- Indexes for table `societe`
--
ALTER TABLE `societe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_19653DBDA10273AA` (`titulaire_id`);

--
-- Indexes for table `societe_titulaire`
--
ALTER TABLE `societe_titulaire`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tfs`
--
ALTER TABLE `tfs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  ADD UNIQUE KEY `UNIQ_8D93D649444F97DD` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bon_commande`
--
ALTER TABLE `bon_commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contrat`
--
ALTER TABLE `contrat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `depense`
--
ALTER TABLE `depense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `devise`
--
ALTER TABLE `devise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ligne_budgetaire`
--
ALTER TABLE `ligne_budgetaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `marche_unique`
--
ALTER TABLE `marche_unique`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nature_operation_bon_commande`
--
ALTER TABLE `nature_operation_bon_commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nature_operation_contrat`
--
ALTER TABLE `nature_operation_contrat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nature_operation_depense`
--
ALTER TABLE `nature_operation_depense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nature_operation_marche_reconductible`
--
ALTER TABLE `nature_operation_marche_reconductible`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nature_operation_marche_unique`
--
ALTER TABLE `nature_operation_marche_unique`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nature_recette`
--
ALTER TABLE `nature_recette`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `personnel`
--
ALTER TABLE `personnel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `recette`
--
ALTER TABLE `recette`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `societe`
--
ALTER TABLE `societe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `societe_titulaire`
--
ALTER TABLE `societe_titulaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tfs`
--
ALTER TABLE `tfs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bon_commande`
--
ALTER TABLE `bon_commande`
  ADD CONSTRAINT `FK_159D957628C42716` FOREIGN KEY (`nature_operation_id`) REFERENCES `nature_operation_bon_commande` (`id`),
  ADD CONSTRAINT `FK_159D9576A10273AA` FOREIGN KEY (`titulaire_id`) REFERENCES `societe_titulaire` (`id`),
  ADD CONSTRAINT `FK_159D9576BCD1DB57` FOREIGN KEY (`line_budgetaire_id`) REFERENCES `ligne_budgetaire` (`id`),
  ADD CONSTRAINT `FK_159D9576D7897FC9` FOREIGN KEY (`tfs_id`) REFERENCES `tfs` (`id`),
  ADD CONSTRAINT `FK_159D9576F4445056` FOREIGN KEY (`devise_id`) REFERENCES `devise` (`id`),
  ADD CONSTRAINT `FK_159D9576FCF77503` FOREIGN KEY (`societe_id`) REFERENCES `societe` (`id`);

--
-- Constraints for table `contrat`
--
ALTER TABLE `contrat`
  ADD CONSTRAINT `FK_6034999328C42716` FOREIGN KEY (`nature_operation_id`) REFERENCES `nature_operation_contrat` (`id`),
  ADD CONSTRAINT `FK_60349993A10273AA` FOREIGN KEY (`titulaire_id`) REFERENCES `societe_titulaire` (`id`),
  ADD CONSTRAINT `FK_60349993BCD1DB57` FOREIGN KEY (`line_budgetaire_id`) REFERENCES `ligne_budgetaire` (`id`),
  ADD CONSTRAINT `FK_60349993F4445056` FOREIGN KEY (`devise_id`) REFERENCES `devise` (`id`),
  ADD CONSTRAINT `FK_60349993FCF77503` FOREIGN KEY (`societe_id`) REFERENCES `societe` (`id`);

--
-- Constraints for table `depense`
--
ALTER TABLE `depense`
  ADD CONSTRAINT `FK_340597573FEA98E2` FOREIGN KEY (`type_dpense_id`) REFERENCES `nature_operation_depense` (`id`),
  ADD CONSTRAINT `FK_340597575AF81F68` FOREIGN KEY (`beneficiaire_id`) REFERENCES `personnel` (`id`);

--
-- Constraints for table `marche_unique`
--
ALTER TABLE `marche_unique`
  ADD CONSTRAINT `FK_C28F6B6D28C42716` FOREIGN KEY (`nature_operation_id`) REFERENCES `nature_operation_marche_unique` (`id`),
  ADD CONSTRAINT `FK_C28F6B6DA10273AA` FOREIGN KEY (`titulaire_id`) REFERENCES `societe_titulaire` (`id`),
  ADD CONSTRAINT `FK_C28F6B6DBCD1DB57` FOREIGN KEY (`line_budgetaire_id`) REFERENCES `ligne_budgetaire` (`id`),
  ADD CONSTRAINT `FK_C28F6B6DD7897FC9` FOREIGN KEY (`tfs_id`) REFERENCES `tfs` (`id`),
  ADD CONSTRAINT `FK_C28F6B6DF4445056` FOREIGN KEY (`devise_id`) REFERENCES `devise` (`id`),
  ADD CONSTRAINT `FK_C28F6B6DFCF77503` FOREIGN KEY (`societe_id`) REFERENCES `societe` (`id`);

--
-- Constraints for table `nature_operation_bon_commande`
--
ALTER TABLE `nature_operation_bon_commande`
  ADD CONSTRAINT `FK_16AAA8BFD7897FC9` FOREIGN KEY (`tfs_id`) REFERENCES `tfs` (`id`);

--
-- Constraints for table `nature_operation_contrat`
--
ALTER TABLE `nature_operation_contrat`
  ADD CONSTRAINT `FK_AF8F9019D7897FC9` FOREIGN KEY (`tfs_id`) REFERENCES `tfs` (`id`);

--
-- Constraints for table `nature_operation_marche_reconductible`
--
ALTER TABLE `nature_operation_marche_reconductible`
  ADD CONSTRAINT `FK_F8D79C30D7897FC9` FOREIGN KEY (`tfs_id`) REFERENCES `tfs` (`id`);

--
-- Constraints for table `nature_operation_marche_unique`
--
ALTER TABLE `nature_operation_marche_unique`
  ADD CONSTRAINT `FK_20342644D7897FC9` FOREIGN KEY (`tfs_id`) REFERENCES `tfs` (`id`);

--
-- Constraints for table `recette`
--
ALTER TABLE `recette`
  ADD CONSTRAINT `FK_49BB6390654F9C7E` FOREIGN KEY (`nature_recette_id`) REFERENCES `nature_recette` (`id`);

--
-- Constraints for table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `societe`
--
ALTER TABLE `societe`
  ADD CONSTRAINT `FK_19653DBDA10273AA` FOREIGN KEY (`titulaire_id`) REFERENCES `societe_titulaire` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
