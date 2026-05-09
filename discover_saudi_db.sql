SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `admins` (`id`, `name`, `password`) VALUES
(1, 'admin', 'admin');

CREATE TABLE `places` (
  `id` int(11) NOT NULL,
  `city` varchar(100) NOT NULL,
  `region` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `features` text DEFAULT NULL,
  `activities` text DEFAULT NULL,
  `landmarks` text DEFAULT NULL,
  `main_image` varchar(255) NOT NULL,
  `gallery_image_one` varchar(255) NOT NULL,
  `gallery_image_two` varchar(255) NOT NULL,
  `gallery_image_three` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
                    
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

ALTER TABLE `places`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `places`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;