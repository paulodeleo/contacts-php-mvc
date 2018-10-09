SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `contacts` (`id`, `name`, `phone`, `created_at`) VALUES
(1, 'Maria Pereira', '(41) 99999-8888',  '2018-10-07 20:46:22'),
(2, 'José Santos', '(41) 99999-7777', '2018-10-07 20:47:22'),
(3, 'João da Silva',  '(41) 99999-6666',  '2018-10-07 20:48:40');

