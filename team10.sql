-- phpMyAdmin SQL Dump
-- version 4.7.6
-- https://www.phpmyadmin.net/
--
-- 主機: localhost
-- 產生時間： 2017 年 12 月 30 日 00:33
-- 伺服器版本: 5.7.20-0ubuntu0.16.04.1
-- PHP 版本： 5.6.32-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `team10`
--

-- --------------------------------------------------------

--
-- 資料表結構 `Administrator`
--

CREATE TABLE `Administrator` (
  `admin_id` int(20) NOT NULL,
  `admin_account` char(20) NOT NULL,
  `pwd` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `Administrator`
--

INSERT INTO `Administrator` (`admin_id`, `admin_account`, `pwd`) VALUES
(1, 'admin1', '1234'),
(2, 'admin2', '1234');

-- --------------------------------------------------------

--
-- 資料表結構 `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `cart`
--

INSERT INTO `cart` (`cart_id`, `owner_id`) VALUES
(1, 1),
(2, 2),
(3, 10);

-- --------------------------------------------------------

--
-- 資料表結構 `cart_info`
--

CREATE TABLE `cart_info` (
  `cart_info_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `cart_info`
--

INSERT INTO `cart_info` (`cart_info_id`, `cart_id`, `ticket_id`, `amount`) VALUES
(4, 2, 3, 5),
(5, 2, 2, 6),
(13, 1, 3, 9),
(16, 1, 2, 5),
(21, 1, 10, 5);

-- --------------------------------------------------------

--
-- 資料表結構 `contact`
--

CREATE TABLE `contact` (
  `message_id` int(255) NOT NULL,
  `sender` char(50) NOT NULL,
  `content` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `contact`
--

INSERT INTO `contact` (`message_id`, `sender`, `content`) VALUES
(1, 'xxxx@xxxx.com', 'Hello, I would like to know the possibility that you guys start a new plan to LA. Thanks '),
(5, 'yyyy@yyyy.com', 'Do you plan to have any campaign in the future?');

-- --------------------------------------------------------

--
-- 資料表結構 `record`
--

CREATE TABLE `record` (
  `record_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `record`
--

INSERT INTO `record` (`record_id`, `buyer_id`, `ticket_id`, `amount`) VALUES
(1, 1, 3, 3),
(2, 2, 1, 5),
(3, 1, 11, 5),
(4, 1, 4, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `ticket`
--

CREATE TABLE `ticket` (
  `ticket_id` int(20) NOT NULL,
  `destination` char(20) NOT NULL,
  `quantity` int(100) NOT NULL,
  `sale` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `ticket`
--

INSERT INTO `ticket` (`ticket_id`, `destination`, `quantity`, `sale`) VALUES
(1, 'London', 34, 5),
(2, 'Paris', 25, 0),
(3, 'Tokyo', 28, 3),
(4, 'New York', 21, 0),
(10, 'Taipei', 23, 0),
(11, 'Los Angles', 49, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `account` char(50) NOT NULL,
  `pwd` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `user`
--

INSERT INTO `user` (`user_id`, `account`, `pwd`) VALUES
(1, 'xxxx@xxxx.com', 'xxxx'),
(2, 'yyyy@yyyy.com', 'yyyy'),
(10, 'zzzz@zzzz.com', 'zzzz');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `Administrator`
--
ALTER TABLE `Administrator`
  ADD PRIMARY KEY (`admin_id`);

--
-- 資料表索引 `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- 資料表索引 `cart_info`
--
ALTER TABLE `cart_info`
  ADD PRIMARY KEY (`cart_info_id`),
  ADD KEY `ticket_id` (`ticket_id`),
  ADD KEY `cart_id` (`cart_id`);

--
-- 資料表索引 `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`message_id`);

--
-- 資料表索引 `record`
--
ALTER TABLE `record`
  ADD PRIMARY KEY (`record_id`),
  ADD KEY `buyer_id` (`buyer_id`),
  ADD KEY `ticket_id` (`ticket_id`);

--
-- 資料表索引 `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_id`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `Administrator`
--
ALTER TABLE `Administrator`
  MODIFY `admin_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表 AUTO_INCREMENT `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表 AUTO_INCREMENT `cart_info`
--
ALTER TABLE `cart_info`
  MODIFY `cart_info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- 使用資料表 AUTO_INCREMENT `contact`
--
ALTER TABLE `contact`
  MODIFY `message_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 使用資料表 AUTO_INCREMENT `record`
--
ALTER TABLE `record`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表 AUTO_INCREMENT `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticket_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- 使用資料表 AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 已匯出資料表的限制(Constraint)
--

--
-- 資料表的 Constraints `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `user` (`user_id`);

--
-- 資料表的 Constraints `cart_info`
--
ALTER TABLE `cart_info`
  ADD CONSTRAINT `cart_info_ibfk_2` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`ticket_id`),
  ADD CONSTRAINT `cart_info_ibfk_3` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`cart_id`);

--
-- 資料表的 Constraints `record`
--
ALTER TABLE `record`
  ADD CONSTRAINT `record_ibfk_1` FOREIGN KEY (`buyer_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `record_ibfk_2` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`ticket_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
