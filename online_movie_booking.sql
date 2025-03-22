-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 29, 2024 at 01:48 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_movie_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

CREATE TABLE `carousel` (
  `id` int(11) NOT NULL,
  `img_path` varchar(100) NOT NULL,
  `alt` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carousel`
--

INSERT INTO `carousel` (`id`, `img_path`, `alt`) VALUES
(1, '/images/carousel/1.jpg', 'first page'),
(2, '/images/carousel/2.jpg', 'second page'),
(3, '/images/carousel/3.jpg', 'third page');

-- --------------------------------------------------------

--
-- Table structure for table `film_available`
--

CREATE TABLE `film_available` (
  `id` int(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `age` varchar(50) NOT NULL,
  `sub` varchar(50) NOT NULL,
  `release_date` varchar(100) NOT NULL,
  `timeline` varchar(50) NOT NULL,
  `trailer` varchar(225) NOT NULL,
  `image` varchar(150) NOT NULL,
  `director` varchar(100) NOT NULL,
  `actor` varchar(100) NOT NULL,
  `language` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `film_available`
--

INSERT INTO `film_available` (`id`, `name`, `genre`, `age`, `sub`, `release_date`, `timeline`, `trailer`, `image`, `director`, `actor`, `language`) VALUES
(1, 'VÂY HÃM: KẺ TRỪNG PHẠT', 'Action/Adventure/SF Korea', '18.png', 'vietsub', '24/04/2024', '109 minutes', 'https://media.lottecinemavn.com/Media/MovieFile/MovieMedia/202404/11402_301_100001.mp4', 'vay-ham.png', 'Heo Myeong Haeng', 'Ma Dong-seok, Kim Mu-yeol, Lee Joo-bin', 'Korean with Vietnamese and English subtitle'),
(2, 'LUYỆN NGẢI: CÔ HỒN DÃ QUỶ', 'Thriller/Criminal/Horror Thailand', '18.png', 'vietsub', '17/05/2024', '103 minutes', 'https://media.lottecinemavn.com/Media/MovieFile/MovieMedia/202405/11462_301_100001.mp4', 'co-hon-da-quy.png', 'Mate Yimsomboon', ' Punjan Prama, Supawadee Kitisopakul', 'Thai with Vietnamese and English subtitle'),
(3, 'MÈO MẬP MANG 10 MẠNG', 'Animation USA', 'p.png', 'vietsub', '26/04/2024', '88 minutes', 'https://media.lottecinemavn.com/Media/MovieFile/MovieMedia/202403/11434_301_100001.mp4', 'meo-map-mang-10-mang.jpg', ' Christopher Jenkins', 'Mo Gilligan, Simone Ashley, Sophie Okonedo, Zayn Malik, Dylan Llewellyn, Jeremy Swift và Bill Nighy.', 'English with Vietnamese subtitle, dubbing'),
(4, 'HAIKYU: TRẬN CHIẾN BÃI PHẾ LIỆU', 'Animation Japan', 'p.png', 'vietsub', '15/05/2024', '85 minutes', 'https://media.lottecinemavn.com/Media/MovieFile/MovieMedia/202405/11461_301_100001.mp4', 'haikyu.png', 'Susumu Mitsunaka', '', 'Japanese with English & Vietnamese subtitles'),
(5, 'DORAEMON: NOBITA VÀ BẢN GIAO HƯỞNG ĐỊA CẦU', 'Animation Japan', 'p.png', 'vietsub', '24/05/2024', '115 minutes', 'https://media.lottecinemavn.com/Media/MovieFile/MovieMedia/202405/11421_301_100001.mp4', 'doraemon.png', 'Kazuaki Imai\r\n', 'Wasabi Mizuta, Megumi Ôhara, Yumi Kakazu', 'Japanese with Vietnamese subtitle; Dubbing'),
(6, 'NGÔI ĐỀN KỲ QUÁI 4', 'Thriller/Criminal/Horror Thailand', '16.png', 'vietsub', '27/05/2024', '111 minutes', 'https://media.lottecinemavn.com/Media/MovieFile/MovieMedia/202404/11411_301_100001.mp4', 'ngoi-den-ky-quai.jpg', 'Phontharis Chotkijsadarsopon', 'Witthawat Rattanaboonbaramee, Bhuripat Vejvongsatechawat, Phiravich Attachitsataporn', 'Thai with Vietnamese subtitle'),
(7, 'LẬT MẶT 7: MỘT ĐIỀU ƯỚC', 'Drama Vietnam', '13.png', 'vietsub', '24/04/2024', '138 minutes', 'https://media.lottecinemavn.com/Media/MovieFile/MovieMedia/202403/11399_301_100001.mp4', 'lat-mat-7.png', 'Lý Hải', 'Thanh Hiền, Trương Minh Cường, Đinh Y Nhung, Quách Ngọc Tuyên, Trâm Anh, Trần Kim Hải', 'Vietnamese with English subtitle'),
(8, 'PANDA ĐẠI NÁO LÃNH ĐỊA VUA SƯ TỬ', 'Animation USA', 'p.png', 'vietsub', '03/05/2024', '88 minutes', 'https://media.lottecinemavn.com/Media/MovieFile/MovieMedia/202404/11423_301_100002.mp4', 'panda-dai-nao-loan-lanh-dia-vua-su-tu.jpg', 'KARSTEN KIILERICH', '', 'English with Vietnamese subtitle, dubbing'),
(9, 'FURIOSA: CÂU CHUYỆN TỪ MAX ĐIÊN', 'Action/Adventure/SF USA', '18.png', 'vietsub', '22/05/2024', '148 minutes', 'https://media.lottecinemavn.com/Media/MovieFile/MovieMedia/202405/11360_301_100002.mp4', 'furiosa.jpg', ' George Miller', 'Anya Taylor-Joy, Chris Hemsworth, Nathan Jones', 'English with Vietnamese subtitle'),
(10, 'NHỮNG NGƯỜI BẠN TƯỞNG TƯỢNG', 'Animation USA', 'p.png', 'vietsub', '17/05/2024', '104 minutes', 'https://media.lottecinemavn.com/Media/MovieFile/MovieMedia/202402/11387_301_100001.mp4', 'nhung-nguoi-ban-tuong-tuong.png', 'John Krasinski', 'Ryan Reynolds, Cailey Fleming, John Krasinski', 'English with Vietnamese subtitle, dubbing'),
(11, 'HÀNH TINH KHỈ: VƯƠNG QUỐC MỚI', 'Action/Adventure/SF England', '13.png', 'vietsub', '10/05/2024', '144 minutes ', 'https://media.lottecinemavn.com/Media/MovieFile/MovieMedia/202405/11395_301_100001.mp4', 'hanh-tinh-khi-vuong-quoc-moi.jpg', 'Wes Ball', 'Owen Teague, Freya Allan, Kevin Durand, Peter Macon, and William H. Macy', 'English with Vietnamese subtitle');

-- --------------------------------------------------------

--
-- Table structure for table `film_upcoming`
--

CREATE TABLE `film_upcoming` (
  `id` int(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `genre` varchar(50) NOT NULL,
  `sub` varchar(50) NOT NULL,
  `age` varchar(50) NOT NULL,
  `release_date` date NOT NULL,
  `timeline` varchar(50) NOT NULL,
  `trailer` varchar(100) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `film_upcoming`
--

INSERT INTO `film_upcoming` (`id`, `name`, `genre`, `sub`, `age`, `release_date`, `timeline`, `trailer`, `image`) VALUES
(1, 'TOTTO-CHAN: CÔ BÉ BÊN CỬA SỔ', 'Animation Japan', 'Lồng tiếng, vietsub', '13.png', '2024-05-31', '114 minutes', 'https://www.youtube.com/watch?time_continue=1&v=U69Pt4kFNXs&embeds_referring_euri=https%3A%2F%2Fwww.', 'totto-chan.jpg'),
(2, 'STALKER: TỘI ÁC HOÀN HẢO', 'Thriller/Criminal/Horror Korea ', 'vietsub', '16.png', '2024-05-31', '103 minutes', 'https://www.youtube.com/watch?v=3q0-A-JEs4k&pp=ygUpU1RBTEtFUjogVMOUzKNJIEHMgUMgSE9BzIBOIEhBzIlPIHRyY', 'stalker.jpg'),
(3, 'GARFIELD: MÈO BÉO SIÊU QUẬY', 'Animation USA', 'vietsub', '13.png', '2024-05-31', '100 minutes', 'https://media.lottecinemavn.com/Media/MovieFile/MovieMedia/202405/11349_301_100001.mp4', 'garfield.jpg'),
(4, 'MÓNG VUỐT', 'Thriller/Criminal/Horror Vietnam', 'vietsub', '16.png', '2024-06-07', '100 minutes', 'https://media.lottecinemavn.com/Media/MovieFile/MovieMedia/202405/11050_301_100001.mp4', 'mong-vuot.jpg'),
(5, 'NHỮNG GÃ TRAI HƯ: CHƠI HAY BỊ XƠI', 'Action/Adventure/SF USA', 'vietsub', '18.png', '2024-06-07', '126 minutes', 'https://www.youtube.com/watch?v=RGnBFA_g0rg&pp=ygUxdHJpYWxlciBOSOG7rk5HIEfDgyBUUkFJIEjGrzogQ0jGoEkgS', 'nhung-ga-trai-hu.jpg'),
(6, 'GIA TÀI CỦA NGOẠI', 'Melodramatic/Love/Romance Thailand', 'Lồng tiếng, vietsub', '13.png', '2024-06-07', '127 minutes', 'https://media.lottecinemavn.com/Media/MovieFile/MovieMedia/202405/11455_301_100001.mp4', 'gia-tai-cua-ngoai.jpg'),
(7, 'LINH HỒN VŨ NỮ 2: NGHI THỨC HỒI SINH', 'Thriller/Criminal/Horror Australia&Others', 'vietsub', '18.png', '2024-06-07', '137 minutes', 'https://www.youtube.com/watch?v=6e8tnS64MdE&pp=ygU1TElOSCBI4buSTiBWxaggTuG7riAyOiBOR0hJIFRI4buoQyBI4', 'linh-hon-vu-nu-2.jpg'),
(8, 'NHỮNG KẺ THEO DÕI', 'Thriller/Criminal/Horror', 'vietsub', '18.png', '2024-06-14', '120 minutes', 'https://www.youtube.com/watch?v=MOjh9K6lo0M&pp=ygUeTkjhu65ORyBL4bq6IFRIRU8gRMOVSSB0cmFpbGVy', 'nhung-ke-theo-doi.jpg'),
(9, 'NHỮNG MẢNH GHÉP CẢM XÚC 2', 'Comedy USA ', 'Lồng tiếng, vietsub', '13.png', '2024-06-14', '107 minutes', 'https://media.lottecinemavn.com/Media/MovieFile/MovieMedia/202311/11315_301_100001.mp4', 'inside-out-2.jpg'),
(10, 'CỬU LONG THÀNH TRẠI: VÂY THÀNH', 'Action/Adventure/SF Hongkong', 'vietsub', '18.png', '2024-06-14', '130 minutes', 'https://www.youtube.com/watch?v=FDFI9XNfioc&pp=ygUtY-G7rXUgbG9uZyB0aMOgbmggdHLhuqFpIHbDonkgdGjDoG5oI', 'cuu-long-thanh-trai.jpg'),
(11, 'VÙNG ĐẤT CÂM LẶNG: NGÀY MỘT', 'Thriller/Criminal/Horror USA', 'vietsub', '18.png', '2024-06-28', '129 minutes', 'https://media.lottecinemavn.com/Media/MovieFile/MovieMedia/202402/11403_301_100001.mp4', 'vung-dat-cam-lang.jpg'),
(12, 'MÙA HÈ ĐẸP NHẤT', 'Melodramatic/Love/Romance Vietnam', 'Lồng tiếng', '16.png', '2024-06-28', '104 minutes', 'https://www.youtube.com/watch?v=qxutmJaErqU&pp=ygUeTcOZQSBIw4ggxJDhurhQIE5I4bqkVCB0cmFpbGVy', 'mua-he-dep-nhat.jpg'),
(13, 'KẺ TRỘM MẶT TRĂNG 4', 'Animation USA', 'Lồng tiếng, vietsub', '13.png', '2024-07-05', '115 minutes', 'https://media.lottecinemavn.com/Media/MovieFile/MovieMedia/202405/11449_301_100001.mp4', 'ke-trom-mat-trang-4.jpg'),
(14, 'LỐC XOÁY TỬ THẦN', 'Action/Adventure/SF USA', 'vietsub', '16.png', '2024-07-19', '130 minutes', 'https://www.youtube.com/watch?v=dvycs6rXILc&pp=ygUfTOG7kEMgWE_DgVkgVOG7rCBUSOG6pk4gdHJhaWxlcg%3D%3D', 'loc-xoay-tu-than.jpg'),
(15, 'DEADPOOL & WOLVERINE', 'Action/Adventure/SF USA', 'vietsub', '18.png', '2024-07-23', '124 minutes', 'https://www.youtube.com/watch?v=inIVdZSFfc0&pp=ygUUREVBRFBPT0wgJiBXT0xWRVJJTkU%3D', 'deadpool-wolverine.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'admin', 'admin', '$2y$10$UA6d8dqFhh5T1WWWNZGeDetmVrMw8rGwndxxQijdKfBdte8z4l9wm'),
(17, 'jack', 'jack1010@mail.com', '$2y$10$SvEss3P3jeolQsTZIXOumeW63Gocva4f5lLFO44jALHSOmUW0YOwS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `film_available`
--
ALTER TABLE `film_available`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `film_upcoming`
--
ALTER TABLE `film_upcoming`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carousel`
--
ALTER TABLE `carousel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `film_available`
--
ALTER TABLE `film_available`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `film_upcoming`
--
ALTER TABLE `film_upcoming`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
