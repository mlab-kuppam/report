-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2016 at 08:12 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `healthcaredb`
--

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE IF NOT EXISTS `report` (
  `t_name` varchar(100) DEFAULT NULL,
  `m_name` varchar(100) DEFAULT NULL,
  `c_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`t_name`, `m_name`, `c_name`) VALUES
('skin', 'Scabies', 'sc'),
('skin', 'Pityriasis Alba', 'pi'),
('skin', 'Xerosis', 'xerosis'),
('skin', 'Phrynoderma', 'ph'),
('skin', 'Pediculosis', 'pe'),
('skin', 'Pityriasis Versicolor', 'pity'),
('skin', 'Impetigo', 'im'),
('skin', 'Papular Urticaria', 'pap'),
('skin', 'Tinea Cruris/corporis', 'tc'),
('skin', 'Miliaria', 'mi'),
('skin', 'Viral Warts', 'vi'),
('ent', 'Otitis Externa - Right Ear', 'oe_r'),
('ent', 'Otitis Externa - Left Ear', 'oe_l'),
('ent', 'ASOM - Right Ear', 'as_r'),
('ent', 'ASOM - Left Ear', 'as_l'),
('ent', 'CSOM - Right Ear', 'cs_r'),
('ent', 'CSOM - Left Ear', 'cs_l'),
('ent', 'Wax - Right Ear', 'iw_r'),
('ent', 'Wax Left', 'iw_l'),
('ent', 'Impaired Hearing - Right Ear', 'ih_r'),
('ent', 'Impaired Hearing Left', 'ih_l'),
('ent', 'H/O Epistaxis', 'ep'),
('ent', 'Adenotonsilitis', 'ad'),
('ent', 'Pharyngitis', 'ph'),
('ent', 'Allergic Rhinitis', 'ar'),
('ent', 'Speech Defects', 'sd'),
('ent', 'URTI', 'urti'),
('ent', 'Cleft Lip', 'cleft'),
('eye', 'Colour Vision - Right Eye', 'cv_r'),
('eye', 'Colour Vision - Left Eye', 'cv_l'),
('eye', 'Bitots spots - Right Eye', 'bs_r'),
('eye', 'Bitots spots - Left Eye', 'bs_l'),
('eye', 'Allergic Conjunctivitis - Right Eye', 'ac_r'),
('eye', 'Allergic Conjunctivitis - Left Eye', 'ac_l'),
('eye', 'Night Blindness', 'nb'),
('eye', 'Congenital ptosis - Right Eye', 'cp_r'),
('eye', 'Congenital ptosis - Left Eye', 'cp_l'),
('eye', 'Congenital developmental cararact - Right Eye', 'cdc_r'),
('eye', 'Congenital developmental cararact - Left Eye', 'cdc_l'),
('eye', 'Amblyopia - Right Eye', 'am_r'),
('eye', 'Amblyopia - Left Eye', 'am_l'),
('eye', 'Nystagmus - Right Eye', 'ny_r'),
('eye', 'Nystagmus - Left Eye', 'ny_l'),
('eye', 'Fundus examination - Right Eye', 'fe_r'),
('eye', 'Fundus examination - Left Eye', 'fe_l'),
('health1', 'Clinical Anaemia', 'ca'),
('health1', 'Frequency of Skipping Food', 'frequencyFood'),
('health1', 'Having Overnight Food in the Morning', 'over_night_food'),
('health1', 'Both Parents Working', 'both_parents'),
('health1', 'Height', 'height'),
('health1', 'Weight', 'weight'),
('health1', 'Waist Circumference', 'wc'),
('health1', 'Hip Circumference', 'hc'),
('health1', 'Pulse Rate', 'pr'),
('health1', 'Blood Pressure', 'bp'),
('health1', 'Personale Hygiene Nails', 'ph_n'),
('health1', 'Personale Hygiene Bathing', 'ph_b'),
('health1', 'Personale Hygiene Grooming', 'ph_g'),
('health1', 'Personale Hygiene Regular Brushing', 'ph_oc'),
('health1', 'Personale Hygiene Age of Menarche', 'ph_am'),
('health1', 'Dental Caries', 'oe_dc'),
('health1', 'Fluorosis', 'oe_f'),
('health1', 'Gingivitis', 'oe_g'),
('health1', 'Oral Ulcers', 'oe_ou'),
('health1', 'Trauma of Tooth', 'oe_trauma'),
('health1', 'Spacing', 'oe_spacing'),
('health1', 'corwding', 'oe_crowding'),
('health1', 'Others Comments', 'oe_others'),
('health1', 'Chronic Cough', 'rs_chronic'),
('health1', 'Brochial Asthma', 'rs_bronchial'),
('health1', 'Adventitous Sounds', 'rs_sounds'),
('health1', 'Others Comments', 'rs_others'),
('health1', 'Abnormal Heart Sounds', 'cvs_ahs'),
('health1', 'Others Comments', 'cvs_others'),
('health2', 'H/O gastro-enteritis in Last 6 Months', 'gs_ag'),
('health2', 'H/O Worm Infestation in Last 6 Months', 'gs_wi'),
('health2', 'Others Comments', 'gs_others'),
('health2', 'Deformities', 'ms_d'),
('health2', 'Others Comments', 'ms_others'),
('health2', 'H/O Seizures', 'ns_s'),
('health2', 'Others Comments', 'ns_others'),
('health2', 'ADHD', 'bp_adhd'),
('health2', 'Others Comments', 'bp_others'),
('health2', 'UTI', 'gus_uti'),
('health2', 'Bedwetting', 'gus_bed'),
('health2', 'Others Comments', 'gus_others'),
('health2', 'Vitamin C Deficiency', 'vt_c'),
('health2', 'Vitamin B Complex Deficiency', 'vt_b'),
('health2', 'Other Comments', 'vt_others');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
