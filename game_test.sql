-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2017-10-16 12:35:22
-- 服务器版本： 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `game_test`
--

-- --------------------------------------------------------

--
-- 表的结构 `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `config` text NOT NULL,
  `remark` text NOT NULL,
  `title` text NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `config`
--

INSERT INTO `config` (`id`, `config`, `remark`, `title`, `create_time`, `update_time`) VALUES
(3, '{\"pai\":[[{\"value\":\"秋\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"中\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"白\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"南\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"白\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"5条\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"秋\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"5万\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"菊\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"6万\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"3筒\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"2条\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"7筒\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"6条\",\"color\":\"#ccc\",\"hover\":false}],[{\"value\":\"8条\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"4条\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"8条\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"1条\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"5万\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"4万\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"菊\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"3筒\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"发\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"3条\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"春\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"西\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"2筒\",\"color\":\"#ccc\",\"hover\":false}],[{\"value\":\"9万\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"2筒\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"3筒\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"兰\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"冬\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"6条\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"3万\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"3筒\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"1筒\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"菊\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"6万\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"西\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"6条\",\"color\":\"#ccc\",\"hover\":false}],[{\"value\":\"西\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"6万\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"春\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"菊\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"2条\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"6条\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"发\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"9条\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"8筒\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"5条\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"1筒\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"发\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"中\",\"color\":\"#ccc\",\"hover\":false}],[{\"value\":\"冬\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"发\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"8万\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"8条\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"7万\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"秋\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"西\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"中\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"3万\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"梅\",\"color\":\"#ccc\",\"hover\":false}]],\"all\":[{\"realValue\":0,\"value\":\"1万\",\"color\":\"#a2b4ba\",\"total\":4},{\"realValue\":1,\"value\":\"2万\",\"color\":\"#a2b4ba\",\"total\":4},{\"realValue\":2,\"value\":\"3万\",\"color\":\"#a2b4ba\",\"total\":2},{\"realValue\":3,\"value\":\"4万\",\"color\":\"#a2b4ba\",\"total\":3},{\"realValue\":4,\"value\":\"5万\",\"color\":\"#a2b4ba\",\"total\":2},{\"realValue\":5,\"value\":\"6万\",\"color\":\"#a2b4ba\",\"total\":1},{\"realValue\":6,\"value\":\"7万\",\"color\":\"#a2b4ba\",\"total\":3},{\"realValue\":7,\"value\":\"8万\",\"color\":\"#a2b4ba\",\"total\":3},{\"realValue\":8,\"value\":\"9万\",\"color\":\"#a2b4ba\",\"total\":3},{\"realValue\":9,\"value\":\"1条\",\"color\":\"#373e40\",\"total\":3},{\"realValue\":10,\"value\":\"2条\",\"color\":\"#373e40\",\"total\":2},{\"realValue\":11,\"value\":\"3条\",\"color\":\"#373e40\",\"total\":3},{\"realValue\":12,\"value\":\"4条\",\"color\":\"#373e40\",\"total\":3},{\"realValue\":13,\"value\":\"5条\",\"color\":\"#373e40\",\"total\":2},{\"realValue\":14,\"value\":\"6条\",\"color\":\"#373e40\",\"total\":0},{\"realValue\":15,\"value\":\"7条\",\"color\":\"#373e40\",\"total\":4},{\"realValue\":16,\"value\":\"8条\",\"color\":\"#373e40\",\"total\":1},{\"realValue\":17,\"value\":\"9条\",\"color\":\"#373e40\",\"total\":3},{\"realValue\":18,\"value\":\"1筒\",\"color\":\"#82abba\",\"total\":2},{\"realValue\":19,\"value\":\"2筒\",\"color\":\"#82abba\",\"total\":2},{\"realValue\":20,\"value\":\"3筒\",\"color\":\"#82abba\",\"total\":0},{\"realValue\":21,\"value\":\"4筒\",\"color\":\"#82abba\",\"total\":4},{\"realValue\":22,\"value\":\"5筒\",\"color\":\"#82abba\",\"total\":4},{\"realValue\":23,\"value\":\"6筒\",\"color\":\"#82abba\",\"total\":4},{\"realValue\":24,\"value\":\"7筒\",\"color\":\"#82abba\",\"total\":3},{\"realValue\":25,\"value\":\"8筒\",\"color\":\"#82abba\",\"total\":3},{\"realValue\":26,\"value\":\"9筒\",\"color\":\"#82abba\",\"total\":4},{\"realValue\":27,\"value\":\"东\",\"color\":\"#00b0f0\",\"total\":4},{\"realValue\":28,\"value\":\"南\",\"color\":\"#00b0f0\",\"total\":3},{\"realValue\":29,\"value\":\"西\",\"color\":\"#00b0f0\",\"total\":0},{\"realValue\":30,\"value\":\"北\",\"color\":\"#00b0f0\",\"total\":4},{\"realValue\":31,\"value\":\"中\",\"color\":\"#00b38c\",\"total\":1},{\"realValue\":32,\"value\":\"发\",\"color\":\"#00b38c\",\"total\":0},{\"realValue\":33,\"value\":\"白\",\"color\":\"#00b38c\",\"total\":2},{\"realValue\":34,\"value\":\"春\",\"color\":\"#ccc\",\"total\":2},{\"realValue\":35,\"value\":\"夏\",\"color\":\"#ccc\",\"total\":4},{\"realValue\":36,\"value\":\"秋\",\"color\":\"#ccc\",\"total\":1},{\"realValue\":37,\"value\":\"冬\",\"color\":\"#ccc\",\"total\":2},{\"realValue\":38,\"value\":\"梅\",\"color\":\"#ccc\",\"total\":3},{\"realValue\":39,\"value\":\"兰\",\"color\":\"#ccc\",\"total\":3},{\"realValue\":40,\"value\":\"竹\",\"color\":\"#ccc\",\"total\":4},{\"realValue\":41,\"value\":\"菊\",\"color\":\"#ccc\",\"total\":0}],\"exclude\":[{\"name\":\"wind\",\"variant\":\"outline-primary\",\"caption\":\"风\",\"state\":false},{\"name\":\"flower\",\"variant\":\"outline-primary\",\"caption\":\"花\",\"state\":false}]}', '测试', '用例2', 1508145023, 1508148695),
(4, '{\"pai\":[[{\"value\":\"1万\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"中\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"8万\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"7万\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"中\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"1筒\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"3万\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"6条\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"9筒\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"5条\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"西\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"4万\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"西\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"中\",\"color\":\"#ccc\",\"hover\":false}],[{\"value\":\"6条\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"3万\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"白\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"3条\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"南\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"6筒\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"6条\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"1条\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"发\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"西\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"3万\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"发\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"发\",\"color\":\"#ccc\",\"hover\":false}],[{\"value\":\"3万\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"3筒\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"5万\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"1条\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"9万\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"7万\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"1条\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"3条\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"发\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"3筒\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"4筒\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"北\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"2筒\",\"color\":\"#ccc\",\"hover\":false}],[{\"value\":\"7条\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"3筒\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"3条\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"9筒\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"6万\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"2筒\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"1万\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"4条\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"6筒\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"7条\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"8条\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"8筒\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"9筒\",\"color\":\"#ccc\",\"hover\":false}],[{\"value\":\"7万\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"4万\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"8筒\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"6条\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"2条\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"7筒\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"1筒\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"4筒\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"西\",\"color\":\"#ccc\",\"hover\":false},{\"value\":\"1万\",\"color\":\"#ccc\",\"hover\":false}]],\"all\":[{\"realValue\":0,\"value\":\"1万\",\"color\":\"#a2b4ba\",\"total\":1},{\"realValue\":1,\"value\":\"2万\",\"color\":\"#a2b4ba\",\"total\":4},{\"realValue\":2,\"value\":\"3万\",\"color\":\"#a2b4ba\",\"total\":0},{\"realValue\":3,\"value\":\"4万\",\"color\":\"#a2b4ba\",\"total\":2},{\"realValue\":4,\"value\":\"5万\",\"color\":\"#a2b4ba\",\"total\":3},{\"realValue\":5,\"value\":\"6万\",\"color\":\"#a2b4ba\",\"total\":3},{\"realValue\":6,\"value\":\"7万\",\"color\":\"#a2b4ba\",\"total\":1},{\"realValue\":7,\"value\":\"8万\",\"color\":\"#a2b4ba\",\"total\":3},{\"realValue\":8,\"value\":\"9万\",\"color\":\"#a2b4ba\",\"total\":3},{\"realValue\":9,\"value\":\"1条\",\"color\":\"#373e40\",\"total\":1},{\"realValue\":10,\"value\":\"2条\",\"color\":\"#373e40\",\"total\":3},{\"realValue\":11,\"value\":\"3条\",\"color\":\"#373e40\",\"total\":1},{\"realValue\":12,\"value\":\"4条\",\"color\":\"#373e40\",\"total\":3},{\"realValue\":13,\"value\":\"5条\",\"color\":\"#373e40\",\"total\":3},{\"realValue\":14,\"value\":\"6条\",\"color\":\"#373e40\",\"total\":0},{\"realValue\":15,\"value\":\"7条\",\"color\":\"#373e40\",\"total\":2},{\"realValue\":16,\"value\":\"8条\",\"color\":\"#373e40\",\"total\":3},{\"realValue\":17,\"value\":\"9条\",\"color\":\"#373e40\",\"total\":4},{\"realValue\":18,\"value\":\"1筒\",\"color\":\"#82abba\",\"total\":2},{\"realValue\":19,\"value\":\"2筒\",\"color\":\"#82abba\",\"total\":2},{\"realValue\":20,\"value\":\"3筒\",\"color\":\"#82abba\",\"total\":1},{\"realValue\":21,\"value\":\"4筒\",\"color\":\"#82abba\",\"total\":2},{\"realValue\":22,\"value\":\"5筒\",\"color\":\"#82abba\",\"total\":4},{\"realValue\":23,\"value\":\"6筒\",\"color\":\"#82abba\",\"total\":2},{\"realValue\":24,\"value\":\"7筒\",\"color\":\"#82abba\",\"total\":3},{\"realValue\":25,\"value\":\"8筒\",\"color\":\"#82abba\",\"total\":2},{\"realValue\":26,\"value\":\"9筒\",\"color\":\"#82abba\",\"total\":1},{\"realValue\":27,\"value\":\"东\",\"color\":\"#00b0f0\",\"total\":4},{\"realValue\":28,\"value\":\"南\",\"color\":\"#00b0f0\",\"total\":3},{\"realValue\":29,\"value\":\"西\",\"color\":\"#00b0f0\",\"total\":0},{\"realValue\":30,\"value\":\"北\",\"color\":\"#00b0f0\",\"total\":3},{\"realValue\":31,\"value\":\"中\",\"color\":\"#00b38c\",\"total\":1},{\"realValue\":32,\"value\":\"发\",\"color\":\"#00b38c\",\"total\":0},{\"realValue\":33,\"value\":\"白\",\"color\":\"#00b38c\",\"total\":3}],\"exclude\":[{\"name\":\"wind\",\"variant\":\"outline-primary\",\"caption\":\"风\",\"state\":false},{\"name\":\"flower\",\"variant\":\"outline-primary\",\"caption\":\"花\",\"state\":true}]}', '测试3', '用例3', 1508145148, 1508145148);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;