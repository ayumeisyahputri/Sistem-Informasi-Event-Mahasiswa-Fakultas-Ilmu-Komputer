-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2025 at 01:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `informasi_mahasiswa`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `event_terakhir_diikuti` (`p_id_mahasiswa` INT) RETURNS VARCHAR(100) CHARSET utf8mb4 COLLATE utf8mb4_general_ci DETERMINISTIC BEGIN
    DECLARE nama_event_terakhir VARCHAR(100);

    SELECT e.nama_event INTO nama_event_terakhir
    FROM event e
    JOIN pendaftaran_event p ON e.id_event = p.id_event
    WHERE p.id_mahasiswa = p_id_mahasiswa
    ORDER BY p.tanggal_daftar DESC
    LIMIT 1;

    RETURN IFNULL(nama_event_terakhir, 'Belum Pernah Mengikuti Event');
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `event_terpopuler` () RETURNS VARCHAR(100) CHARSET utf8mb4 COLLATE utf8mb4_general_ci DETERMINISTIC BEGIN
    DECLARE nama_event_populer VARCHAR(100);

    SELECT e.nama_event INTO nama_event_populer
    FROM event e
    JOIN pendaftaran_event p ON e.id_event = p.id_event
    GROUP BY e.id_event
    ORDER BY COUNT(p.id_pendaftaran_event) DESC
    LIMIT 1;

    RETURN nama_event_populer;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fn_cek_pendaftaran_event` (`mahasiswa_id` INT, `event_id` INT) RETURNS INT(11) DETERMINISTIC BEGIN
    DECLARE status_daftar INT DEFAULT 0;

    IF EXISTS (
        SELECT 1 
        FROM pendaftaran_event 
        WHERE id_mahasiswa = mahasiswa_id AND id_event = event_id
    ) THEN
        SET status_daftar = 1;
    END IF;

    RETURN status_daftar;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `hari_terakhir_daftar_event` (`p_id_event` INT) RETURNS INT(11) DETERMINISTIC BEGIN
    DECLARE sisa_hari INT;
    DECLARE tgl_deadline DATE;
    SELECT deadline_pendaftaran INTO tgl_deadline
    FROM event WHERE id_event = p_id_event;
    SET sisa_hari = DATEDIFF(tgl_deadline, CURDATE());
    RETURN sisa_hari;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `status_pendaftaran_terakhir` (`p_id_mahasiswa` INT) RETURNS VARCHAR(50) CHARSET utf8mb4 COLLATE utf8mb4_general_ci DETERMINISTIC BEGIN
    DECLARE status_terakhir VARCHAR(50);
    SELECT status INTO status_terakhir
    FROM pendaftaran_event
    WHERE id_mahasiswa = p_id_mahasiswa
    ORDER BY tanggal_daftar DESC
    LIMIT 1;
    RETURN IFNULL(status_terakhir, 'Belum Pernah Daftar');
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id_event` int(11) NOT NULL,
  `nama_event` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `penyelenggara` varchar(100) DEFAULT NULL,
  `deadline_pendaftaran` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id_event`, `nama_event`, `deskripsi`, `penyelenggara`, `deadline_pendaftaran`) VALUES
(1, 'Seminar Sains Data', 'Seminar Membahas Masa Depan Sains Data di Indonesia', 'Tech Corp', '2025-12-01'),
(2, 'Workshop UI/UX', 'Bagaimana membangun skill UI/UX', 'Komunitas Startup', '2025-11-06'),
(3, 'Lomba Infografis', 'Lomba dengan tema menyayangi bumi', 'Komunitas Startup', '2025-03-12'),
(4, 'Seminar Android', 'Seminar Android Development and Strategy', 'KSM Android', '2026-01-01'),
(5, 'Seminar Cybersecurity', 'Seminar Cyber Menjaga Keamanan dan Aware Masyarakat', 'KSM Cyber', '2026-05-06'),
(6, 'Pelatihan Public Speaking', 'Cara agar pede berbicara di depan umum', 'BEM', '2025-06-20'),
(7, 'Hackathon Kampus', 'Kompetisi coding 24 jam', 'Komunitas Startup', '2026-07-27'),
(8, 'Seminar Data Analyst', 'Belajar ', 'FIK', '2026-01-10'),
(9, 'Seminar Data Engineer', 'Belajar Menjadi Data Engineer ', 'FIK', '2026-01-10');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `nim` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `jurusan` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mahasiswa`, `nama`, `nim`, `email`, `jurusan`, `password`) VALUES
(1, 'Andi Pratama', '2410514019', 'andi_baru@mail.com', 'Informatika', 'pass123'),
(2, 'Budi Santoso', '2510514010', 'budi@mail.com', 'Sistem Informasi', 'pass234'),
(3, 'Citra Mawarni', '2410514010', 'citra@mail.com', 'Sains Data', 'pass345'),
(4, 'Dewi Anggraini', '2310514017', 'dewi@mail.com', 'Informatika', 'pass456'),
(5, 'Eko Purnomo', '2510514001', 'eko@mail.com', 'Sains Data', 'pass567'),
(6, 'Farhan Putra', '2410514015', 'farhan@mail.com', 'Sistem Informasi', 'pass678'),
(7, 'Gita Sari', '2310514018', 'gita@mail.com', 'Informatika', 'pass789'),
(8, 'Hendra Wijaya', '2210514020', 'hendra@mail.com', 'Sains Data', 'pass890'),
(9, 'Indah Puspita', '2510514030', 'indah@mail.com', 'Sistem Informasi', 'pass901'),
(10, 'Joko Nugroho', '2410514017', 'joko@mail.com', 'Informatika', 'pass911'),
(11, 'Karin Setiawan', '2310514005', 'karin@mail.com', 'Sains Data', 'pass912'),
(12, 'Lutfi Rahman', '2310514003', 'lutfi@mail.com', 'Informatika', 'pass913'),
(13, 'Maya Lestari', '2510514005', 'maya@mail.com', 'Sistem Informasi', 'pass914'),
(14, 'Naufal Rizky', '2510514006', 'naufal@mail.com', 'Informatika', 'pass915'),
(15, 'Olivia Ananda', '2310514040', 'olivia@mail.com', 'Sains Data', 'pass916'),
(16, 'Putri Cahya', '2410514021', 'putri@mail.com', 'Sains Data', 'pass917'),
(17, 'Qory Prameswari', '2510514031', 'qory@mail.com', 'Informatika', 'pass918'),
(18, 'Rizal Akbar', '2310514012', 'rizal@mail.com', 'Sistem Informasi', 'pass919'),
(19, 'Sinta Dewanti', '2410514011', 'sinta@mail.com', 'Sains Data', 'pass920'),
(20, 'Teguh Saputra', '2510514022', 'teguh@mail.com', 'Informatika', 'pass921');

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id_notifikasi` int(11) NOT NULL,
  `id_mahasiswa` int(11) DEFAULT NULL,
  `pesan` text DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `status_baca` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`id_notifikasi`, `id_mahasiswa`, `pesan`, `tanggal`, `status_baca`) VALUES
(1, 1, 'Pendaftaran event Seminar Sains Data berhasil.', '2025-01-06', 'Belum'),
(2, 2, 'Pendaftaran event Seminar Sains Data diterima.', '2025-03-11', 'Sudah'),
(3, 3, 'Saran Anda telah diterima oleh pihak kampus.', '2025-03-09', 'Belum'),
(4, 4, 'Update jadwal Seminar Android tersedia.', '2025-04-02', 'Sudah'),
(5, 5, 'Pendaftaran event Anda ditolak. Silakan cek kembali kelengkapan berkas.', '2025-05-26', 'Belum'),
(6, 6, 'Pendaftaran event Seminar Cybersecurity telah dikonfirmasi.', '2025-06-11', 'Sudah'),
(7, 7, 'Pengumuman event Hackathon Kampus telah dirilis.', '2025-07-21', 'Belum'),
(8, 2, 'Selamat! Pendaftaran Anda untuk event \"Seminar Sains Data\" telah DITERIMA.', '2025-11-13', 'Belum'),
(9, 16, 'Status pendaftaran Anda untuk event \"Hackathon Kampus\" diperbarui menjadi Menunggu.', '2025-11-13', 'Belum'),
(10, 16, 'Selamat! Pendaftaran Anda untuk event \"Hackathon Kampus\" telah DITERIMA.', '2025-11-13', 'Belum'),
(11, 2, 'Selamat! Pendaftaran Anda untuk event \"Seminar Sains Data\" telah DITERIMA.', '2025-11-20', 'Belum');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran_event`
--

CREATE TABLE `pendaftaran_event` (
  `id_pendaftaran_event` int(11) NOT NULL,
  `id_event` int(11) DEFAULT NULL,
  `id_mahasiswa` int(11) DEFAULT NULL,
  `tanggal_daftar` date DEFAULT NULL,
  `bukti_upload` varchar(100) DEFAULT NULL,
  `status` enum('Diterima','Ditolak','Menunggu') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pendaftaran_event`
--

INSERT INTO `pendaftaran_event` (`id_pendaftaran_event`, `id_event`, `id_mahasiswa`, `tanggal_daftar`, `bukti_upload`, `status`) VALUES
(1, 1, 1, '2025-11-10', 'bukti_01.jpg', 'Diterima'),
(2, 1, 2, '2025-11-11', NULL, 'Diterima'),
(3, 4, 1, '2025-11-12', 'bukti_02.png', 'Diterima'),
(4, 5, 3, '2025-11-01', 'bukti_03.pdf', 'Diterima'),
(5, 5, 2, '2025-11-07', NULL, 'Menunggu'),
(6, 7, 5, '2025-11-10', 'bukti_04.jpg', 'Diterima'),
(8, 7, 16, '2025-11-01', 'bukti_06.png', 'Diterima'),
(9, 4, 17, '2025-10-28', 'bukti_07.jpg', 'Ditolak'),
(10, 1, 2, '2025-11-20', 'test.jpg', 'Diterima');

--
-- Triggers `pendaftaran_event`
--
DELIMITER $$
CREATE TRIGGER `after_update_pendaftaran_event_user` AFTER UPDATE ON `pendaftaran_event` FOR EACH ROW BEGIN
    DECLARE pesan VARCHAR(255);

    
    IF NEW.status <> OLD.status THEN
        IF NEW.status = 'Diterima' THEN
            SET pesan = CONCAT('Selamat! Pendaftaran Anda untuk event "', 
                (SELECT nama_event FROM event WHERE id_event = NEW.id_event), 
                '" telah DITERIMA.');
        ELSEIF NEW.status = 'Ditolak' THEN
            SET pesan = CONCAT('Maaf, pendaftaran Anda untuk event "', 
                (SELECT nama_event FROM event WHERE id_event = NEW.id_event), 
                '" telah DITOLAK. Silakan cek kembali data Anda.');
        ELSE
            SET pesan = CONCAT('Status pendaftaran Anda untuk event "', 
                (SELECT nama_event FROM event WHERE id_event = NEW.id_event), 
                '" diperbarui menjadi ', NEW.status, '.');
        END IF;

        INSERT INTO notifikasi (id_mahasiswa, pesan, tanggal, status_baca)
        VALUES (NEW.id_mahasiswa, pesan, NOW(), 'Belum');
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `saran`
--

CREATE TABLE `saran` (
  `id_saran` int(11) NOT NULL,
  `id_mahasiswa` int(11) DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `isi_saran` text DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `saran`
--

INSERT INTO `saran` (`id_saran`, `id_mahasiswa`, `kategori`, `isi_saran`, `tanggal`) VALUES
(1, 1, 'Akademik', 'Perlu tambahan kelas praktikum.', '2025-01-15'),
(2, 2, 'Fasilitas', 'Wifi kampus sering lambat.', '2025-02-12'),
(3, 3, 'Kebersihan', 'Ruang kelas perlu dibersihkan setiap hari.', '2025-03-08'),
(4, 4, 'Kegiatan', 'Perbanyak seminar karir.', '2025-04-01'),
(5, 5, 'Kantin', 'Menu kantin kurang variatif.', '2025-05-05'),
(6, 6, 'Administrasi', 'Proses surat agak lama.', '2025-06-18'),
(7, 7, 'Fasilitas', 'Perlu tambahan colokan listrik di kelas.', '2025-07-11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id_event`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id_notifikasi`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`);

--
-- Indexes for table `pendaftaran_event`
--
ALTER TABLE `pendaftaran_event`
  ADD PRIMARY KEY (`id_pendaftaran_event`),
  ADD KEY `id_event` (`id_event`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`);

--
-- Indexes for table `saran`
--
ALTER TABLE `saran`
  ADD PRIMARY KEY (`id_saran`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pendaftaran_event`
--
ALTER TABLE `pendaftaran_event`
  MODIFY `id_pendaftaran_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `saran`
--
ALTER TABLE `saran`
  MODIFY `id_saran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD CONSTRAINT `notifikasi_ibfk_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id_mahasiswa`);

--
-- Constraints for table `pendaftaran_event`
--
ALTER TABLE `pendaftaran_event`
  ADD CONSTRAINT `pendaftaran_event_ibfk_1` FOREIGN KEY (`id_event`) REFERENCES `event` (`id_event`),
  ADD CONSTRAINT `pendaftaran_event_ibfk_2` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id_mahasiswa`);

--
-- Constraints for table `saran`
--
ALTER TABLE `saran`
  ADD CONSTRAINT `saran_ibfk_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id_mahasiswa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
