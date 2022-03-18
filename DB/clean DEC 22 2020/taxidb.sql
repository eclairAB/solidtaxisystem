-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2020 at 07:19 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taxidb`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `a_id` int(11) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `m_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ac_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`a_id`, `f_name`, `m_name`, `l_name`, `username`, `password`, `ac_id`) VALUES
(1, 'Michael Angelo', '', 'Nacario', 'admin', 'admin', 1),
(2, 'Gas', '', 'Abelgas', 'gas', 'gas', 3),
(3, 'Money', '', 'Pakyaw', 'cashier', 'cashier', 2),
(4, 'Noli', '', 'De Castro', 'broadcaster', 'broadcaster', 7),
(5, 'Guardo', '', 'Versosa', 'guard', 'guard', 4),
(6, 'Despacito', '', 'Espinosa', 'dispatcher', 'dispatcher', 5),
(7, 'Mekaniko', '', 'Martilyo', 'mechanic', 'mechanic', 6),
(8, 'Mike', '', 'Enqriquez', 'reports', 'reports', 8),
(9, 'Mario', '', 'Enco', 'encoder', 'encoder', 14),
(10, 'Demetria', '', 'Remita', 'remit', 'remit', 12),
(11, 'Grasia', '', 'Montimayor', 'gasmon', 'gasmon', 16);

-- --------------------------------------------------------

--
-- Table structure for table `account_class`
--

CREATE TABLE `account_class` (
  `ac_id` int(11) NOT NULL,
  `ac_text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_class`
--

INSERT INTO `account_class` (`ac_id`, `ac_text`) VALUES
(1, 'Admin'),
(2, 'Cashier'),
(3, 'Gas Boy/Girl'),
(4, 'Guard'),
(5, 'Dispatcher'),
(6, 'Maintenance'),
(7, 'Monitoring'),
(8, 'Reports'),
(12, 'Remit Officer'),
(14, 'Encoder'),
(16, 'Gas Monitoring');

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `b_id` int(11) NOT NULL,
  `d_id` int(11) NOT NULL,
  `others_reason` text DEFAULT NULL,
  `others_amount` decimal(18,2) NOT NULL,
  `discount_reason` text DEFAULT NULL,
  `discount_amount` decimal(18,2) NOT NULL,
  `overall_total` decimal(18,2) NOT NULL,
  `b_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `billing_payments`
--

CREATE TABLE `billing_payments` (
  `b_pay_id` int(11) NOT NULL,
  `b_id` int(11) NOT NULL,
  `amount_payed` decimal(18,2) NOT NULL,
  `pay_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `billing_products`
--

CREATE TABLE `billing_products` (
  `bp_id` int(11) NOT NULL,
  `b_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `p_current_price` decimal(18,2) NOT NULL,
  `p_current_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `billing_receipt`
--

CREATE TABLE `billing_receipt` (
  `br_id` int(11) NOT NULL,
  `d_id` int(11) NOT NULL,
  `receipt_name` varchar(255) NOT NULL,
  `receipt_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `billing_taxi`
--

CREATE TABLE `billing_taxi` (
  `bt_id` int(11) NOT NULL,
  `b_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `t_current_rent_price` decimal(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `d_id` int(11) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `m_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `birthdate` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `dc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`d_id`, `f_name`, `m_name`, `l_name`, `gender`, `birthdate`, `address`, `contact_no`, `profile_pic`, `dc_id`) VALUES
(1, 'Manuelito', '', 'Ampit', 'Male', '1999-02-01', '', '09357257432', 'Ampit2018 03 22 10 06 02.jpg', 1),
(2, 'Reggei', '', 'Betonio', 'Male', '1988-02-04', '', '09351983590', 'Betonio2018 03 22 10 07 39.jpg', 1),
(3, 'Pompeo', '', 'Turtur', 'Male', '1987-03-27', '', '09079055418', 'Turtur2018 03 22 10 10 03.jpg', 1),
(4, 'Marlon', '', 'Malait', 'Male', '1999-06-22', '', '09072569494', 'Malait2018 03 22 10 11 49.jpg', 1),
(5, 'Giovanne', '', 'Manlangit', 'Male', '1977-06-02', '', '09321986477', 'Manlangit2018 03 22 10 15 08.jpg', 1),
(6, 'Eng', '', 'Pedro', 'Male', '1983-06-04', '', '09997792756', 'Pedro2018 03 22 10 17 11.jpg', 1),
(7, 'Mick', '', 'Saavedra', 'Male', '1990-08-22', '', '09102730001', 'Saavedra2018 03 22 10 20 22.jpg', 1),
(8, 'Perlito', '', 'Penaso', 'Male', '1977-11-23', '', '09265951962', 'Penaso2018 03 22 10 21 13.jpg', 1),
(9, 'Isagani', '', 'Gomez', 'Male', '1970-08-22', '', '09367267143', 'Gomez2018 03 22 10 21 48.jpg', 1),
(10, 'Allan', '', 'Moralla', 'Male', '1966-12-23', '', '09192605173', 'Moralla2018 03 22 10 22 20.jpg', 1),
(11, 'Noel', '', 'Ratilla', 'Male', '1990-08-22', '', '09067082534', 'Ratilla2018 03 22 10 23 04.jpg', 1),
(12, 'Julius', '', 'Seriguilla', 'Male', '1954-03-02', '', '09295227970', 'Seriguilla2018 03 22 10 30 29.jpg', 1),
(13, 'Ramil', '', 'Baquilta', 'Male', '1997-03-22', '', 'X0955400215', 'Baquilta2018 03 22 10 32 20.jpg', 1),
(14, 'Romeo', '', 'Gonzales', 'Male', '1977-09-30', '', '09358982194', 'Gonzales2018 03 22 10 32 59.jpg', 1),
(15, 'Alfredo', '', 'Fernandez', 'Male', '1988-06-13', '', '09982550701', 'Fernandez2018 03 22 10 33 40.jpg', 1),
(16, 'Alarini', '', 'Casicas', 'Male', '1991-08-09', '', '09952221985', 'Casicas2018 03 22 10 34 39.jpg', 1),
(17, 'Aurelio', '', 'Laurente', 'Male', '1967-10-16', '', '09099593097', 'Laurente2018 03 22 10 39 50.jpg', 1),
(18, 'Almar', '', 'Bautista', 'Male', '1989-03-26', '', '09070155035', 'Bautista2018 03 22 10 43 11.jpg', 1),
(19, 'Ladislao', '', 'Caraquel', 'Male', '1988-06-24', '', '09754429536', 'Caraquel2018 03 22 10 43 58.jpg', 1),
(20, 'Samuel', '', 'Vilalva', 'Male', '1974-08-16', '', '09097536150', 'Vilalva2018 03 22 10 44 52.jpg', 1),
(21, 'Kim', '', 'Vitudazo', 'Male', '1995-05-12', '', '09105610577', 'Vitudazo2018 03 22 10 45 31.jpg', 1),
(22, 'Manuel', '', 'Samontina', 'Male', '1999-02-14', '', '09098047755', 'Samontina2018 03 22 10 47 05.jpg', 1),
(23, 'Richard', '', 'Romero', 'Male', '1967-07-21', '', '09331932339', 'Richard2018 03 22 10 51 54.jpg', 1),
(24, 'Francis', '', 'Marto', 'Male', '1965-08-12', '', '09101253733', 'Marto2018 03 22 10 52 37.jpg', 1),
(25, 'Domingo', '', 'Bonotan', 'Male', '1977-04-04', '', '09153026977', 'Bonotan2018 03 22 10 53 15.jpg', 1),
(26, 'Marlon', '', 'Quiap', 'Male', '1988-06-26', '', '09120000950', 'Quiap2018 03 22 10 53 57.jpg', 1),
(27, 'Mitchel', '', 'Edrina', 'Male', '1968-09-28', '', '09484745853', 'Edrina2018 03 22 10 55 40.jpg', 1),
(28, 'Marvin', '', 'Masangay', 'Male', '1972-09-29', '', '09091903553', 'Masangay2018 03 22 10 58 04.jpg', 1),
(29, 'Ryneil', '', 'Rabi', 'Male', '1980-05-08', '', '09184280805', 'Rabi2018 03 22 10 59 33.jpg', 1),
(30, 'Erwin', '', 'Amores', 'Male', '1975-12-21', '', '09562746348', 'Amores2018 03 22 11 00 17.jpg', 1),
(31, 'Roger', '', 'Quiamco', 'Male', '1978-03-21', '', '09195678420', 'Quiamco2018 03 22 11 00 45.jpg', 1),
(32, 'Carlito', '', 'Marturillas', 'Male', '1987-02-11', '', '09076075059', 'Marturillas2018 03 22 11 01 32.jpg', 1),
(33, 'Felix', '', 'Apollo', 'Male', '1967-10-22', '', '09182551806', 'Apollo2018 03 22 11 02 19.jpg', 1),
(34, 'Rey', '', 'Unajan', 'Male', '1957-02-27', '', '09277227882', 'Unajan2018 03 22 11 02 48.jpg', 1),
(35, 'Luisito', '', 'Alotata', 'Male', '1993-07-15', '', '09109397509', 'Alotata2018 03 22 11 03 30.jpg', 1),
(36, 'Renato', '', 'Rosal', 'Male', '1989-08-19', '', '09774340162', 'Rosal2018 03 22 11 04 11.jpg', 1),
(37, 'Roque', '', 'Ayoc', 'Male', '2000-08-12', '', '09427596378', 'Ayoc2018 03 22 11 04 36.jpg', 1),
(38, 'Jonasis', '', 'Juaton', 'Male', '1976-08-21', '', '09369451632', 'Juaton2018 03 22 11 05 14.jpg', 1),
(39, 'Jayson', '', 'Sagrados', 'Male', '2003-01-02', '', '09090302227', 'Sagrados2018 03 22 11 06 03.jpg', 1),
(40, 'Norlito', '', 'Banez', 'Male', '1963-06-22', '', '09755884385', 'Banez2018 03 22 11 06 48.jpg', 1),
(41, 'Genevibo', '', 'Bersano', 'Male', '1972-04-17', '', '09991234561', 'Bersano2018 03 22 11 07 37.jpg', 1),
(42, 'Jenny', '', 'Panamogan', 'Male', '1992-02-01', '', '09774340162', 'Panamogan2018 03 22 11 08 58.jpg', 1),
(43, 'Dante', '', 'Corig', 'Male', '1948-09-19', '', '09486766534', 'Corig2018 03 22 11 09 28.jpg', 1),
(44, 'Gerald', '', 'Remoto', 'Male', '1966-05-04', '', '09774340256', 'Remoto2018 03 22 11 10 15.jpg', 1),
(45, 'Gorgonio', '', 'Braga', 'Male', '1992-02-02', '', '09120000814', 'Braga2018 03 22 11 11 06.jpg', 1),
(46, 'Richard', '', 'Coquia', 'Male', '1967-02-25', '', '09309516842', 'Coquia2018 03 22 11 11 53.jpg', 1),
(47, 'Michael', '', 'Lapating', 'Male', '1986-07-17', '', '09995955478', 'Lapating2018 03 22 11 12 30.jpg', 1),
(48, 'Leo', '', 'Leparto', 'Male', '1977-10-24', '', '09483980570', 'Leparto2018 03 22 11 13 28.jpg', 1),
(49, 'Olegario', '', 'Navarro', 'Male', '1978-03-12', '', '09365979309', 'Navarro2018 03 22 11 13 56.jpg', 1),
(50, 'Aljem', '', 'Maligon', 'Male', '1982-11-21', '', '09559628429', 'Maligon2018 03 22 11 14 22.jpg', 1),
(51, 'Irigo', '', 'Sumaliling', 'Male', '1981-05-21', '', '09167510425', 'Sumaliling2018 03 22 11 16 41.jpg', 1),
(52, 'Rodel', '', 'Casayas', 'Male', '1988-11-02', '', '09103422663', 'Casayas2018 03 22 11 17 15.jpg', 1),
(53, 'Alejandro', '', 'Bajala', 'Male', '1966-01-12', '', '09071748311', 'Bajala2018 03 22 11 18 01.jpg', 1),
(54, 'Roberto', '', 'Gallano', 'Male', '1999-12-01', '', '09120000869', 'Gallano2018 03 22 11 19 43.jpg', 1),
(55, 'Roberto', '', 'Langi', 'Male', '1977-05-06', '', '09292093219', 'Langi2018 03 22 11 20 12.jpg', 1),
(56, 'Renante', '', 'Macirin', 'Male', '2000-05-21', '', '00912000072', 'Macirin2018 03 22 11 21 14.jpg', 1),
(57, 'Carlos', '', 'Quino', 'Male', '1969-08-12', '', '09362813799', 'Quino2018 03 22 11 21 40.jpg', 1),
(58, 'Richard', '', 'Unajan', 'Male', '1988-05-24', '', '09109862404', 'Unajan2018 03 22 11 22 59.jpg', 1),
(59, 'Ponciano', '', 'Arendain', 'Male', '1973-07-21', '', '09277227848', 'Arendain2018 03 22 11 23 35.jpg', 1),
(60, 'Melvin', '', 'Sampiano', 'Male', '1958-02-24', '', '09121630008', 'Sampiano2018 03 22 11 24 57.jpg', 1),
(61, 'Arserio', '', 'Agusto', 'Male', '1998-04-21', '', '09351306575', 'Agusto2018 03 22 11 27 55.jpg', 1),
(62, 'Jaime', '', 'Agravante', 'Male', '1967-04-21', '', '09098047755', 'Agravante2018 03 22 11 28 28.jpg', 1),
(63, 'Placido', '', 'Albite', 'Male', '1932-03-31', '', '09774306731', 'Albite2018 03 22 11 29 13.jpg', 1),
(64, 'Jaime', '', 'Gokotano', 'Male', '1991-02-01', '', '09097238251', 'Gokotano2018 03 22 11 29 54.jpg', 1),
(65, 'Nino', '', 'Vergara', 'Male', '1992-06-24', '', '09774338081', 'Vergara2018 03 22 11 30 45.jpg', 1),
(66, 'Moriel', '', 'Palmera', 'Male', '1978-11-29', '', '09487866852', 'Palmera2018 03 22 11 31 16.jpg', 1),
(67, 'Orlando', '', 'Vasquez', 'Male', '1967-04-21', '', '09098436330', 'Vasquez2018 03 22 11 34 28.jpg', 1),
(68, 'Jonatan', '', 'Uy', 'Male', '1977-06-21', '', '09213956196', 'Uy2018 03 22 11 34 57.jpg', 1),
(69, 'Ricardo', '', 'Uytico', 'Male', '1976-03-21', '', '09109910600', 'Uytico2018 03 22 11 35 23.jpg', 1),
(70, 'Cristino', '', 'Lagura', 'Male', '1978-03-18', '', '09067249345', 'Lagura2018 03 22 11 39 00.jpg', 1),
(71, 'Jhonny', '', 'Alonzo', 'Male', '1987-06-21', '', '09265425458', 'Alonzo2018 03 22 11 42 15.jpg', 1),
(72, 'Russel', '', 'Dona', 'Male', '2000-07-21', '', '09508624026', 'Dona2018 03 22 11 42 43.jpg', 1),
(73, 'Josito', '', 'Del Rosario', 'Male', '1981-08-12', '', '09100227800', 'Del Rosario2018 03 22 11 43 28.jpg', 1),
(74, 'Leo', '', 'Pequit', 'Male', '1954-05-04', '', '09335384349', 'Pequit2018 03 22 11 43 58.jpg', 1),
(75, 'Edgardo', '', 'Salinas', 'Male', '1967-02-28', '', '09774340415', 'Salinas2018 03 22 11 44 27.jpg', 1),
(76, 'Dadizon', '', 'XXX', 'Male', '1989-02-21', '', '09214526554', 'XXX2018 03 22 11 45 26.jpg', 1),
(77, 'Danilo', '', 'Lapriza', 'Male', '1990-06-21', '', '09309952393', 'Lapriza2018 03 22 11 46 25.jpg', 1),
(78, 'Aries', '', 'Magallon', 'Male', '1967-12-12', '', '09217768402', 'Magallon2018 03 22 11 47 01.jpg', 1),
(79, 'Lito', '', 'Doyugan', 'Male', '1976-05-12', '', '09777788750', 'Doyugan2018 03 22 11 47 36.jpg', 1),
(80, 'Enrique', '', 'Balibalos', 'Male', '1956-12-21', '', '09198721044', 'Balibalos2018 03 22 11 48 13.jpg', 1),
(81, 'Rene', '', 'Sumabal', 'Male', '1987-07-21', '', '09196509007', 'Sumabal2018 03 22 11 48 42.jpg', 1),
(82, 'Danilo', '', 'Mesias', 'Male', '1997-05-21', '', '09103778002', 'Mesias2018 03 22 11 49 09.jpg', 1),
(83, 'Ben', '', 'Hortillano', 'Male', '1967-08-21', '', '09485409841', 'Hortillano2018 03 22 11 49 47.jpg', 1),
(84, 'Rosalito', '', 'Opilio', 'Male', '1965-08-21', '', '09358282751', 'Opilio2018 03 22 11 50 27.jpg', 1),
(85, 'Jeffrey', '', 'Martinez', 'Male', '1973-04-24', '', '09432044038', 'Martinez2018 03 22 11 51 15.jpg', 1),
(86, 'Douglas', '', 'Empic', 'Male', '1977-03-28', '', '09972278465', 'Empic2018 03 22 11 51 55.jpg', 1),
(87, 'Edelberto', '', 'Peralta', 'Male', '1986-05-12', '', '09266645922', 'Peralta2018 03 22 11 52 35.jpg', 1),
(88, 'Dennis', '', 'Mayol', 'Male', '1976-08-13', '', '09424317972', 'Mayol2018 03 22 11 53 22.jpg', 1),
(89, 'Nilo', '', 'Leopardas', 'Male', '1965-12-23', '', '09100448653', 'Leopardas2018 03 22 11 54 06.jpg', 1),
(90, 'Arthur', '', 'Lozada', 'Male', '1976-07-06', '', '09072069968', 'Lozada2018 03 22 11 54 41.jpg', 1),
(91, 'Jude', '', 'Patalinghug', 'Male', '1968-03-01', '', '09107957296', 'Patalinghug2018 03 22 11 55 09.jpg', 1),
(92, 'Charlito', '', 'Erojo', 'Male', '1979-02-17', '', '09358961794', 'Erojo2018 03 22 11 55 49.jpg', 1),
(93, 'Lloyd', '', 'Ronquillo', 'Male', '1992-03-26', '', '09058748974', 'Ronquillo2018 03 22 11 56 20.jpg', 1),
(94, 'Reynald', '', 'Nuevo', 'Male', '1976-01-12', '', '09554813843', 'Nuevo2018 03 22 11 56 46.jpg', 1),
(95, 'Elmer', '', 'Givertas', 'Male', '1963-03-21', '', '09075148283', 'Givertas2018 03 22 11 57 22.jpg', 1),
(96, 'Ricky', '', 'Nuez', 'Male', '1966-08-12', '', '09066172668', 'Nuez2018 03 22 11 58 13.jpg', 1),
(97, 'Roldan', '', 'Lumapas', 'Male', '1965-12-04', '', '09071414115', 'Lumapas2018 03 22 11 59 01.jpg', 1),
(98, 'Mario', '', 'Penduko', 'Male', '2006-06-14', 'Sasa, Davao', '09221126523', 'Penduko2020 12 03 17 05 15.jpg', 1),
(99, 'Jose', '', 'Manalo', 'Male', '1993-03-03', 'Agdao, Davao City', '09214327538', 'Manalo2020 12 22 07 06 11.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `driver_class`
--

CREATE TABLE `driver_class` (
  `dc_id` int(11) NOT NULL,
  `dc_text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `driver_class`
--

INSERT INTO `driver_class` (`dc_id`, `dc_text`) VALUES
(1, 'Regular'),
(2, 'Extrador'),
(3, 'Floater');

-- --------------------------------------------------------

--
-- Table structure for table `driver_remitance`
--

CREATE TABLE `driver_remitance` (
  `d_rem_id` int(11) NOT NULL,
  `d_id` int(11) NOT NULL,
  `remit` decimal(18,2) NOT NULL,
  `d_rem_date` datetime NOT NULL,
  `remitance_type` varchar(255) NOT NULL,
  `remarks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `driver_years`
--

CREATE TABLE `driver_years` (
  `dy_id` int(11) NOT NULL,
  `year_start` int(11) NOT NULL,
  `year_end` int(11) NOT NULL,
  `d_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gas`
--

CREATE TABLE `gas` (
  `g_id` int(11) NOT NULL,
  `d_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `gas_amount` decimal(18,2) NOT NULL,
  `current_gas_price` decimal(18,2) NOT NULL,
  `odo` decimal(18,2) NOT NULL,
  `total_trip` decimal(18,2) NOT NULL,
  `gas_time` datetime NOT NULL,
  `b_id` int(11) NOT NULL,
  `tank_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gas_inventory`
--

CREATE TABLE `gas_inventory` (
  `gt_id` int(11) NOT NULL,
  `refill_amount` decimal(18,2) NOT NULL,
  `gt_date` datetime NOT NULL,
  `tank_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gas_monitoring`
--

CREATE TABLE `gas_monitoring` (
  `gm_id` int(11) NOT NULL,
  `gas_amount` decimal(11,2) NOT NULL,
  `monitored_date` datetime NOT NULL,
  `tank_no` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gas_price`
--

CREATE TABLE `gas_price` (
  `gp_id` int(11) NOT NULL,
  `gp_price` decimal(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gas_price`
--

INSERT INTO `gas_price` (`gp_id`, `gp_price`) VALUES
(1, '50.00');

-- --------------------------------------------------------

--
-- Table structure for table `in_out`
--

CREATE TABLE `in_out` (
  `io_id` int(11) NOT NULL,
  `d_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `in_time` datetime DEFAULT NULL,
  `out_time` datetime DEFAULT NULL,
  `b_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `l_id` int(11) NOT NULL,
  `action` text NOT NULL,
  `l_time` datetime NOT NULL,
  `a_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `p_id` int(11) NOT NULL,
  `p_text` varchar(255) NOT NULL,
  `p_price` decimal(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `taxi`
--

CREATE TABLE `taxi` (
  `t_id` int(11) NOT NULL,
  `body_no` varchar(255) NOT NULL,
  `plate_no` varchar(255) NOT NULL,
  `start_date` varchar(255) NOT NULL,
  `tc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `taxi`
--

INSERT INTO `taxi` (`t_id`, `body_no`, `plate_no`, `start_date`, `tc_id`) VALUES
(1, '01', 'AAG1660', '2015-01-01', 3),
(2, '02', 'AAG1645', '2015-01-01', 3),
(3, '03', 'AAG1647', '2015-01-01', 3),
(4, '04', 'AAG1924', '2015-01-01', 3),
(5, '05', 'AAG1646', '2015-01-01', 3),
(6, '06', 'AAG1362', '2015-01-01', 3),
(7, '07', 'AAG1388', '2015-01-01', 3),
(8, '08', 'AAG1360', '2015-01-01', 3),
(9, '09', 'AAG1922', '2015-01-01', 3),
(10, '10', 'AAG1923', '2015-01-01', 3),
(11, '11', 'AAG1386', '2015-01-01', 3),
(12, '12', 'AAG1627', '2015-01-01', 3),
(13, '14', 'AAG1260', '2015-01-01', 3),
(14, '15', 'AAG1557', '2015-01-01', 3),
(15, '16', 'AAG1553', '2015-01-01', 3),
(16, '17', 'AAG1555', '2015-01-01', 3),
(17, '18', 'AAG1550', '2015-01-01', 3),
(18, '19', 'AAG1559', '2015-01-01', 3),
(19, '20', 'AAG1556', '2015-01-01', 3),
(20, '21', 'AAG1549', '2015-01-01', 3),
(21, '22', 'AAG1562', '2015-01-01', 3),
(22, '23', 'AAG1560', '2015-01-01', 3),
(23, '24', 'AAG1558', '2015-01-01', 3),
(24, '25', 'AAG3082', '2015-01-01', 3),
(25, '26', 'AAG3085', '2015-01-01', 3),
(26, '27', 'AAG3084', '2015-01-01', 3),
(27, '28', 'AAG2744', '2015-01-01', 3),
(28, '29', 'AAG3086', '2015-01-01', 3),
(29, '30', 'AAG3083', '2015-01-01', 3),
(30, '31', 'AAG3530', '2015-01-01', 3),
(31, '32', 'AAG3371', '2015-01-01', 3),
(32, '33', 'AAG3368', '2015-01-01', 3),
(33, '34', 'AAG3534', '2015-01-01', 3),
(34, '35', 'AAG3359', '2015-01-01', 3),
(35, '36', 'AAG3369', '2015-01-01', 3),
(36, '37', 'AAG3370', '2015-01-01', 3),
(37, '38', 'AAG4724', '2015-01-01', 3),
(38, '39', 'AAG4721', '2015-01-01', 3),
(39, '40', 'AAG4729', '2015-01-01', 3),
(40, '41', 'AAG4725', '2015-01-01', 3),
(41, '42', 'AAG4726', '2015-01-01', 3),
(42, '43', 'AAG4727', '2015-01-01', 3),
(43, '44', 'AAG4715', '2015-01-01', 3),
(44, '45', 'AAG4717', '2015-01-01', 3),
(45, '46', 'AAG4723', '2015-01-01', 3),
(46, '47', 'AAG4728', '2015-01-01', 3),
(47, '48', 'AAG4712', '2015-01-01', 3),
(48, '49', 'AAG4718', '2015-01-01', 3),
(49, '50', 'AAG4735', '2015-01-01', 3),
(50, '51', 'AAG4720', '2015-01-01', 3),
(51, '52', 'AAG6035', '2015-01-01', 2),
(52, '53', 'AAG6032', '2015-01-01', 2),
(53, '54', 'AAG6036', '2015-01-01', 2),
(54, '55', 'AAG6034', '2015-01-01', 2),
(55, '56', 'AAG6031', '2015-01-01', 2),
(56, '57', 'AAG3037', '2015-01-01', 2),
(57, '58', 'AAG6223', '2015-01-01', 2),
(58, '59', 'AAG6030', '2015-01-01', 2),
(59, '60', 'AAG6239', '2015-01-01', 2),
(60, '171', 'AAC3211', '2020-02-15', 2),
(61, '88', 'MFB653', '2010-01-01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `taxi_change_oil`
--

CREATE TABLE `taxi_change_oil` (
  `tco_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `odo` decimal(18,2) NOT NULL,
  `tco_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `taxi_class`
--

CREATE TABLE `taxi_class` (
  `tc_id` int(11) NOT NULL,
  `tc_text` varchar(255) NOT NULL,
  `rental_price` decimal(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `taxi_class`
--

INSERT INTO `taxi_class` (`tc_id`, `tc_text`, `rental_price`) VALUES
(1, 'TTSI-Regular', '1200.00'),
(2, 'TTSI-RTO', '1200.00'),
(3, 'SDTI-RTO', '1200.00');

-- --------------------------------------------------------

--
-- Table structure for table `taxi_maintenance`
--

CREATE TABLE `taxi_maintenance` (
  `tm_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `tmp_id` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `tm_date` datetime NOT NULL,
  `job_order_number` varchar(255) DEFAULT NULL,
  `others` text DEFAULT NULL,
  `amount` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `taxi_maintenance_jobs`
--

CREATE TABLE `taxi_maintenance_jobs` (
  `tmp_id` int(11) NOT NULL,
  `tmp_text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `taxi_maintenance_jobs`
--

INSERT INTO `taxi_maintenance_jobs` (`tmp_id`, `tmp_text`) VALUES
(1, 'Change Battery'),
(2, 'Change Tire'),
(3, 'Change Wiper Blade'),
(4, 'Change Headlight'),
(5, 'Others');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`a_id`),
  ADD UNIQUE KEY `a_id` (`a_id`);

--
-- Indexes for table `account_class`
--
ALTER TABLE `account_class`
  ADD PRIMARY KEY (`ac_id`),
  ADD UNIQUE KEY `ac_id` (`ac_id`);

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`b_id`),
  ADD UNIQUE KEY `b_id` (`b_id`);

--
-- Indexes for table `billing_payments`
--
ALTER TABLE `billing_payments`
  ADD PRIMARY KEY (`b_pay_id`),
  ADD UNIQUE KEY `b_pay_id` (`b_pay_id`);

--
-- Indexes for table `billing_products`
--
ALTER TABLE `billing_products`
  ADD PRIMARY KEY (`bp_id`),
  ADD UNIQUE KEY `bp_id` (`bp_id`);

--
-- Indexes for table `billing_receipt`
--
ALTER TABLE `billing_receipt`
  ADD PRIMARY KEY (`br_id`),
  ADD UNIQUE KEY `br_id` (`br_id`);

--
-- Indexes for table `billing_taxi`
--
ALTER TABLE `billing_taxi`
  ADD PRIMARY KEY (`bt_id`),
  ADD UNIQUE KEY `bt_id` (`bt_id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`d_id`),
  ADD UNIQUE KEY `d_id` (`d_id`);

--
-- Indexes for table `driver_class`
--
ALTER TABLE `driver_class`
  ADD PRIMARY KEY (`dc_id`),
  ADD UNIQUE KEY `dc_id` (`dc_id`);

--
-- Indexes for table `driver_remitance`
--
ALTER TABLE `driver_remitance`
  ADD PRIMARY KEY (`d_rem_id`);

--
-- Indexes for table `driver_years`
--
ALTER TABLE `driver_years`
  ADD PRIMARY KEY (`dy_id`),
  ADD UNIQUE KEY `dy_id` (`dy_id`);

--
-- Indexes for table `gas`
--
ALTER TABLE `gas`
  ADD PRIMARY KEY (`g_id`),
  ADD UNIQUE KEY `g_id` (`g_id`);

--
-- Indexes for table `gas_inventory`
--
ALTER TABLE `gas_inventory`
  ADD PRIMARY KEY (`gt_id`),
  ADD UNIQUE KEY `gt_id` (`gt_id`);

--
-- Indexes for table `gas_monitoring`
--
ALTER TABLE `gas_monitoring`
  ADD PRIMARY KEY (`gm_id`);

--
-- Indexes for table `gas_price`
--
ALTER TABLE `gas_price`
  ADD PRIMARY KEY (`gp_id`),
  ADD UNIQUE KEY `gp_id` (`gp_id`);

--
-- Indexes for table `in_out`
--
ALTER TABLE `in_out`
  ADD PRIMARY KEY (`io_id`),
  ADD UNIQUE KEY `io_id` (`io_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`l_id`),
  ADD UNIQUE KEY `l_id` (`l_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`p_id`),
  ADD UNIQUE KEY `p_id` (`p_id`);

--
-- Indexes for table `taxi`
--
ALTER TABLE `taxi`
  ADD PRIMARY KEY (`t_id`),
  ADD UNIQUE KEY `t_id` (`t_id`);

--
-- Indexes for table `taxi_change_oil`
--
ALTER TABLE `taxi_change_oil`
  ADD PRIMARY KEY (`tco_id`),
  ADD UNIQUE KEY `tco_id` (`tco_id`);

--
-- Indexes for table `taxi_class`
--
ALTER TABLE `taxi_class`
  ADD PRIMARY KEY (`tc_id`),
  ADD UNIQUE KEY `tc_id` (`tc_id`);

--
-- Indexes for table `taxi_maintenance`
--
ALTER TABLE `taxi_maintenance`
  ADD PRIMARY KEY (`tm_id`),
  ADD UNIQUE KEY `tm_id` (`tm_id`);

--
-- Indexes for table `taxi_maintenance_jobs`
--
ALTER TABLE `taxi_maintenance_jobs`
  ADD PRIMARY KEY (`tmp_id`),
  ADD UNIQUE KEY `tmp_id` (`tmp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `account_class`
--
ALTER TABLE `account_class`
  MODIFY `ac_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `billing_payments`
--
ALTER TABLE `billing_payments`
  MODIFY `b_pay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `billing_products`
--
ALTER TABLE `billing_products`
  MODIFY `bp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `billing_receipt`
--
ALTER TABLE `billing_receipt`
  MODIFY `br_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `billing_taxi`
--
ALTER TABLE `billing_taxi`
  MODIFY `bt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `driver_class`
--
ALTER TABLE `driver_class`
  MODIFY `dc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `driver_remitance`
--
ALTER TABLE `driver_remitance`
  MODIFY `d_rem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `driver_years`
--
ALTER TABLE `driver_years`
  MODIFY `dy_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gas`
--
ALTER TABLE `gas`
  MODIFY `g_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `gas_inventory`
--
ALTER TABLE `gas_inventory`
  MODIFY `gt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gas_monitoring`
--
ALTER TABLE `gas_monitoring`
  MODIFY `gm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `gas_price`
--
ALTER TABLE `gas_price`
  MODIFY `gp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `in_out`
--
ALTER TABLE `in_out`
  MODIFY `io_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `l_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `taxi`
--
ALTER TABLE `taxi`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `taxi_change_oil`
--
ALTER TABLE `taxi_change_oil`
  MODIFY `tco_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `taxi_class`
--
ALTER TABLE `taxi_class`
  MODIFY `tc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `taxi_maintenance`
--
ALTER TABLE `taxi_maintenance`
  MODIFY `tm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `taxi_maintenance_jobs`
--
ALTER TABLE `taxi_maintenance_jobs`
  MODIFY `tmp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
