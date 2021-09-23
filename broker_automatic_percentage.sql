-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 22, 2021 at 11:25 AM
-- Server version: 10.3.31-MariaDB-log-cll-lve
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `condruwn_condieinvestmentslimited`
--

-- --------------------------------------------------------

--
-- Table structure for table `invested`
--

CREATE TABLE `invested` (
  `invested_id` int(11) NOT NULL,
  `uuid` varchar(300) NOT NULL,
  `amount` int(11) NOT NULL,
  `method` varchar(300) NOT NULL,
  `plan` varchar(30) DEFAULT NULL,
  `type` varchar(300) NOT NULL,
  `status` enum('pending','approved','declined') NOT NULL,
  `snapshot` varchar(300) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invested`
--

INSERT INTO `invested` (`invested_id`, `uuid`, `amount`, `method`, `plan`, `type`, `status`, `snapshot`, `date`) VALUES
(37, '9a6ef0c717245a77b1df58fd1e0f96d6', 50, 'Bitcoin', '', 'withdrawal', 'pending', '', '2021-09-15 00:00:00'),
(36, '9a6ef0c717245a77b1df58fd1e0f96d6', 100, 'Bitcoin', NULL, 'deposit', 'approved', 'https://condieinvestmentslimited.com/public/users/payment/1631709962_25ce9d7ac991246a1e37.png', '2021-09-15 00:00:00'),
(35, 'a54bdeb8c8c3fdc2fe278b619adf495f', 500, 'USDT', NULL, 'deposit', 'approved', 'https://condieinvestmentslimited.com/public/users/payment/1631533104_7875fd9af80ae1899cb0.jpeg', '2021-09-13 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `master`
--

CREATE TABLE `master` (
  `id` int(11) NOT NULL,
  `btc_id` varchar(300) NOT NULL DEFAULT '0',
  `ltc_id` varchar(255) NOT NULL DEFAULT '0',
  `eth_id` varchar(255) NOT NULL DEFAULT '0',
  `usdt_id` varchar(255) NOT NULL DEFAULT '0',
  `referral` varchar(255) NOT NULL DEFAULT '0',
  `basic_percentage` varchar(255) NOT NULL DEFAULT '0',
  `silver_percentage` varchar(255) NOT NULL DEFAULT '0',
  `business_percentage` varchar(255) NOT NULL DEFAULT '0',
  `premium_percentage` varchar(255) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `edited_by` varchar(300) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master`
--

INSERT INTO `master` (`id`, `btc_id`, `ltc_id`, `eth_id`, `usdt_id`, `referral`, `basic_percentage`, `silver_percentage`, `business_percentage`, `premium_percentage`, `created_at`, `updated_at`, `edited_by`) VALUES
(1, '15nLEFE3RmzCDZbyDb4YyKxnn68CrYoqHp', 'LecGGJ2y73GjrHJH5KuXgV19frZMqARG7q', '0x24e2de5b26bc899c6934eebac545a9ac0204559d', '0x7F48d6d08fA72eF51Ef00BeEcB8CBC247cd09483', '20', '0.58', '0.76', '1', '1.5', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `plan_id` int(11) NOT NULL,
  `plan_name` varchar(300) NOT NULL,
  `invest` varchar(300) NOT NULL,
  `withdraw` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(300) NOT NULL,
  `lastname` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `userType` enum('user','admin') NOT NULL,
  `uuid` text NOT NULL,
  `profile_pics` text NOT NULL,
  `document` text NOT NULL,
  `subscription` enum('None','Basic','Silver','Business','Premium') NOT NULL DEFAULT 'None',
  `account_status` enum('pending','verified','suspended','declined') NOT NULL,
  `wallet_bal` int(200) NOT NULL,
  `bonus` int(200) NOT NULL,
  `invested` int(200) NOT NULL,
  `withdrawal` int(200) NOT NULL,
  `username` varchar(300) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(200) NOT NULL,
  `website` text NOT NULL,
  `password` varchar(300) NOT NULL,
  `status` int(11) NOT NULL,
  `country` varchar(300) NOT NULL,
  `referred_by` varchar(255) DEFAULT NULL,
  `btc_address` varchar(255) DEFAULT NULL,
  `wallet_type` varchar(255) DEFAULT NULL,
  `paypal_tag` varchar(255) DEFAULT NULL,
  `zelle_tag` varchar(255) DEFAULT NULL,
  `cashapp_tag` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `userType`, `uuid`, `profile_pics`, `document`, `subscription`, `account_status`, `wallet_bal`, `bonus`, `invested`, `withdrawal`, `username`, `address`, `phone`, `website`, `password`, `status`, `country`, `referred_by`, `btc_address`, `wallet_type`, `paypal_tag`, `zelle_tag`, `cashapp_tag`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'okon', 'mike', 'nkimajie2@gmail.com', 'admin', 'bbae65c41d38af9a7d2584c00e881fa1', '', '', 'None', 'verified', 0, 0, 0, 0, '', '33333', '2344444445', '', '$2y$10$QIGNrHxWICQDlzMDqkrZfOEPmRjbuZt3lQ/lpjbzN2SAv.nJOk06q', 1, 'Anguilla', '', 'bvghjujyrhdtgrsq', NULL, 'N/A', 'N/A', 'N/A', '2021-09-09 15:07:29', '2021-08-30 01:20:00', '0000-00-00 00:00:00'),
(6, 'Admin', 'Admin', 'admin@admin.com', 'admin', 'aebc062dc92da3b61aff1a57bbf9ac21', '', '', 'None', 'verified', 0, 0, 0, 0, '', '', '9672782827', '', '$2y$10$35UCkMHbo3Goddvre52IAeje.b.MJkdOLv3Xn5EEMbwgku.ctkj0K', 1, 'United Arab Emirates', '', 'Cagagahshsjjs', NULL, 'N/A', 'N/A', 'N/A', '2021-09-07 20:43:31', '2021-09-02 03:34:23', '0000-00-00 00:00:00'),
(24, 'Miao', 'Li', 'limiao0521@gmail.com', 'user', 'a54bdeb8c8c3fdc2fe278b619adf495f', '', 'https://condieinvestmentslimited.com/public/users/id/1631532657_0b640f39d83a7d5220b7.jpeg', 'Basic', 'verified', 530, 0, 500, 0, '', '', '+61405700521', '', '$2y$10$C0xwzdpel/rwDP1ajq4QweA/YHRfPOH0gI2ooGSXabH4m0Trv13AK', 1, 'Australia', '', NULL, NULL, 'N/A', 'N/A', 'N/A', '2021-09-22 04:00:25', '2021-09-13 16:30:57', '0000-00-00 00:00:00'),
(25, 'james', 'parker', 'lamejamescul@gmail.com', 'user', '7acd474697136deacb8b9090637f8983', '', 'https://condieinvestmentslimited.com/public/users/id/1631650152_dffc6f95ef6eb44436c4.jpeg', 'None', 'pending', 0, 0, 0, 0, '', '', '6465718509', '', '$2y$10$kOyNsZFPgE.thToZMUzBQ.Di0wscuDApNRlheZwJHdbHvqzWNDAF6', 1, 'Belgium', '', NULL, NULL, 'N/A', 'N/A', 'N/A', '2021-09-15 01:09:12', '2021-09-15 01:09:12', '0000-00-00 00:00:00'),
(26, 'test', 'test', 'nkimajie@gmail.com', 'user', '9a6ef0c717245a77b1df58fd1e0f96d6', '', 'https://condieinvestmentslimited.com/public/users/id/1631695418_34616fe06ea7104f8b1e.jpg', 'Basic', 'verified', 107, 0, 100, 0, '', '', '08168496216', '', '$2y$10$RS9029miQni5EAmAsXuN6.TWL5qT1cDvTbfgV23UU4YCA.a5GTvFG', 1, 'Angola', '', 'sssdddcccc', 'Etherum', '@testpaypal', '@testzelle', '@testcashapp', '2021-09-22 04:00:25', '2021-09-15 13:43:38', '0000-00-00 00:00:00'),
(27, 'Will', 'Sam', 'johnnyfx360@gmail.com', 'user', '93251063c6d37db8d128c899dc51edb5', '', 'https://condieinvestmentslimited.com/public/users/id/1632249501_29dff155a26975960cc0.jpg', 'None', 'declined', 0, 0, 0, 0, '', '', '+4823482507086', '', '$2y$10$MlqMGrL78r5AuSPtfwf5x.W6ySQNV.H1W/RWR5IWO354G3FVFgP3e', 1, 'United States', '', NULL, NULL, NULL, NULL, NULL, '2021-09-21 18:39:56', '2021-09-21 23:38:21', '0000-00-00 00:00:00'),
(28, 'james', 'harvery', 'harvey.coulter09@gmail.com', 'user', 'a727de0dfe842a4d53e8fb3aa9231c9f', '', 'https://condieinvestmentslimited.com/public/users/id/1632254911_2622a9c07e111fceed1b.jpeg', 'None', 'suspended', 0, 0, 0, 0, '', '', '8765678987656789', '', '$2y$10$kkCSmWHR7PWD20cQ1bhoD.IBPRwX9duqlFprXeFwm7PFuSWSjTnci', 1, 'Bahamas', '', NULL, NULL, NULL, NULL, NULL, '2021-09-21 21:08:56', '2021-09-22 01:08:32', '0000-00-00 00:00:00'),
(29, 'NKIM', 'AJIE', '54naija@gmail.com', 'user', 'dc53cc413ec28f24a3a85158688efd72', '', 'https://condieinvestmentslimited.com/public/users/id/1632266799_732e70c177a1ad94a6ec.jpeg', 'None', 'verified', 0, 0, 0, 0, '', '', '08168496216', '', '$2y$10$q2zl0EbL9sUHeKZzUZ9mc.EJDKs3oyo9hiK2q9Q4SWbsH1rlGo/I.', 1, 'Nigeria', '', NULL, NULL, NULL, NULL, NULL, '2021-09-21 23:38:19', '2021-09-22 04:26:39', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invested`
--
ALTER TABLE `invested`
  ADD PRIMARY KEY (`invested_id`);

--
-- Indexes for table `master`
--
ALTER TABLE `master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`plan_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invested`
--
ALTER TABLE `invested`
  MODIFY `invested_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `master`
--
ALTER TABLE `master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
