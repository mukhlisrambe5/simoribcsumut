-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2021 at 06:19 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_simori_bcsumut`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_activities`
--

CREATE TABLE `tb_activities` (
  `activities_id` int(11) NOT NULL,
  `activities_name` varchar(100) NOT NULL,
  `info` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_activities`
--

INSERT INTO `tb_activities` (`activities_id`, `activities_name`, `info`) VALUES
(1, 'DKO', 'Dialog Kinerja Organisasi'),
(10, 'PKPT', 'Pemantauan Kepatuhan Pelaksanakan Tugas'),
(15, 'EVKIN', 'Evaluasi Kinerja'),
(16, 'PPI', 'Pemantauan Pengendalian Internal'),
(17, 'APF', 'Monitoring Tindak Lanjut APF '),
(18, 'SmarD', 'Monitoring Arahan Dirjen'),
(19, 'Rakor', 'Tindak Lanjut Rakor');

-- --------------------------------------------------------

--
-- Table structure for table `tb_rekom`
--

CREATE TABLE `tb_rekom` (
  `rekom_id` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `rekomendasi` text NOT NULL,
  `activities_id` int(11) NOT NULL,
  `support` varchar(200) NOT NULL,
  `deadline` date NOT NULL,
  `comment` text NOT NULL,
  `file` varchar(100) DEFAULT NULL,
  `upload_date` datetime DEFAULT NULL,
  `status_id` int(11) NOT NULL,
  `komentar_ki` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_rekom`
--

INSERT INTO `tb_rekom` (`rekom_id`, `user_id`, `rekomendasi`, `activities_id`, `support`, `deadline`, `comment`, `file`, `upload_date`, `status_id`, `komentar_ki`) VALUES
('132d6999-3c06-45ad-bb06-8cfed7dce888', '1908763e-d82a-4931-8c06-01f3b823798f', 'Rekomendai 3', 10, '', '2021-01-21', '', NULL, NULL, 2, ''),
('a832391f-4675-4876-b7c1-45681d30a38b', '1908763e-d82a-4931-8c06-01f3b823798f', 'Rekomendasi 1', 10, '', '2021-02-26', '', NULL, NULL, 2, ''),
('d10a32b3-084f-4e4c-997f-9a6f66f92b1b', '1908763e-d82a-4931-8c06-01f3b823798f', 'Rekomendasi 2', 1, '', '2021-01-26', '', NULL, NULL, 4, '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_status`
--

CREATE TABLE `tb_status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(100) NOT NULL,
  `info` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_status`
--

INSERT INTO `tb_status` (`status_id`, `status_name`, `info`) VALUES
(2, 'Belum ditindaklanjuti', 'Rekomendasi yang diberikan belum ditindaklanjuti sama sekali'),
(4, 'Proses', 'Rekomendasi yang diberikan sudah ditindaklanjuti tetapi belum selesai/ belum dianggap memadai'),
(6, 'Selesai', 'Rekomendasi sudah selesai ditindaklanjuti dan dianggap memadai');

-- --------------------------------------------------------

--
-- Table structure for table `tb_suggest`
--

CREATE TABLE `tb_suggest` (
  `suggest_id` int(11) NOT NULL,
  `suggest_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_suggest`
--

INSERT INTO `tb_suggest` (`suggest_id`, `suggest_name`) VALUES
(1, 'menambahkan piechart'),
(2, 'menambahkan server side'),
(4, 'perlu ditambahkan sweet alert');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `user_id` varchar(50) NOT NULL,
  `user_name` varchar(80) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` enum('1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`user_id`, `user_name`, `email`, `username`, `password`, `level`) VALUES
('1908763e-d82a-4931-8c06-01f3b823798f', 'Bidang Pabean Cukai', '', 'Pabean', '5925db8a19419f3c6e5e0e6afa6bbae9ebe9f9d4', '2'),
('754e35b3-1e61-4639-9f5d-ffea09f4bc07', 'Bidang KI', '', 'BidangKI', '117a62cf0e1798bc60efb59c3ab559107b85e5ff', '2'),
('84091b57-36d6-44c9-a473-b62e3d8560b3', 'Kakanwil', '', 'Kakanwil', 'ee847d711bd4131bad865c55eadc8e11908c96b5', '1'),
('928ba940-29b5-4f76-9789-d0edf6da086b', 'Bidang Fasilitas ', '', 'BidFas', '1118f39535f5dd89097cfd9859738a7fab4ee657', '2'),
('9a5706a1-5155-4ddd-b336-22f25e02c9da', 'Bidang P2', '', 'BidangP2', '724172525a81d390f9b8ea51f5114812f02af063', '2'),
('9b40913f-08af-4cf1-b77b-9e3e523fe619', 'Bagian Umum', '', 'BagianUmum', 'e31992bf0bf17babd89b18d62a16ad0ed2baa9e8', '2'),
('aaec11cb-7f50-422e-8e56-d4b3c1a9cd76', 'Admin KI', '', 'AdminKI', '117a62cf0e1798bc60efb59c3ab559107b85e5ff', '1'),
('e80fc71d-6de2-4ba4-a7af-6adf370598ab', 'Fungsional Auditor', '', 'Audit', '38badec5802f396ddfe19103159562bca8a7ed8e', '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_activities`
--
ALTER TABLE `tb_activities`
  ADD PRIMARY KEY (`activities_id`);

--
-- Indexes for table `tb_rekom`
--
ALTER TABLE `tb_rekom`
  ADD PRIMARY KEY (`rekom_id`),
  ADD KEY `id_user` (`user_id`);

--
-- Indexes for table `tb_status`
--
ALTER TABLE `tb_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `tb_suggest`
--
ALTER TABLE `tb_suggest`
  ADD PRIMARY KEY (`suggest_id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_activities`
--
ALTER TABLE `tb_activities`
  MODIFY `activities_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tb_status`
--
ALTER TABLE `tb_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_suggest`
--
ALTER TABLE `tb_suggest`
  MODIFY `suggest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
