SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS agencies;
DROP TABLE IF EXISTS contacts;
DROP TABLE IF EXISTS managers;
DROP TABLE IF EXISTS estates;

SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE `agencies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `contacts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phones` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `managers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idAgency` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `managers_idAgency_foreign` (`idAgency`),
  CONSTRAINT `managers_idAgency_foreign` FOREIGN KEY (`idAgency`) REFERENCES `agencies` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `estates` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `rooms` int NOT NULL,
  `floor` int NOT NULL,
  `houseFloors` int NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `idContact` bigint unsigned NOT NULL,
  `idManager` bigint unsigned NOT NULL,
  `originalId` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `estates_idContact_foreign` (`idContact`),
  KEY `estates_idManager_foreign` (`idManager`),
  CONSTRAINT `estates_idContact_foreign` FOREIGN KEY (`idContact`) REFERENCES `contacts` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `estates_idManager_foreign` FOREIGN KEY (`idManager`) REFERENCES `managers` (`id`)  ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
