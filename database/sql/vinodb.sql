SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- -----------------------------------------------------
-- Table `vinodb`.`vino__type`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `vino__type`;
CREATE TABLE `vino__type` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `type` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;


-- -----------------------------------------------------
-- Table `vinodb`.`vino__bouteille`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `vino__bouteille`;
CREATE TABLE `vino__bouteille` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(200) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `code_saq` varchar(50) DEFAULT NULL,
  `pays` varchar(50) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `prix_saq` varchar(50) DEFAULT NULL,
  `url_saq` varchar(200) DEFAULT NULL,
  `url_img` varchar(200) DEFAULT NULL,
  `format` varchar(20) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;


-- -----------------------------------------------------
-- Table `vinodb`.`vino__usager`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `vino__usager`;
CREATE TABLE `vino__usager` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `courriel` VARCHAR(200) NULL,
  `motdepasse` VARCHAR(200) NULL,
  `date_creation` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

-- -----------------------------------------------------
-- Table `vinodb`.`vino__cellier`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `vino__cellier`;
CREATE TABLE `vino__cellier` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_usager` INT(20) NULL,
  `nom_cellier` VARCHAR(200) NULL,
  PRIMARY KEY (`id`))
ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

-- -----------------------------------------------------
-- Table `vinodb`.`vino__commentaire`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `vino__commentaire`;
CREATE TABLE `vino__commentaire` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_usager` INT(20) NULL,
  `commentaire` VARCHAR(200) NULL,
  `id_bouteille` INT NULL,
  PRIMARY KEY (`id`))
ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

-- -----------------------------------------------------
-- Table `vinodb`.`vino__cellier_has_vino__bouteille`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `vino__cellier_has_vino__bouteille`;
CREATE TABLE `vino__cellier_has_vino__bouteille` (
  `vino__cellier_id` INT NOT NULL,
  `vino__bouteille_id` INT NOT NULL,
  `quantite` VARCHAR(45) NULL)
ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;



-- -----------------------------------------------------
-- Table `vinodb`.`vino__bouteille_personalize`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `vino__bouteille_personalize`;
CREATE TABLE `vino__bouteille_personalize` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(200) NULL,
  `description` VARCHAR(200) NULL,
  `provenance` VARCHAR(45) NULL,
  `couleur` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;



INSERT INTO `vino__cellier` VALUES(1, 1, 'cellier1');
INSERT INTO `vino__cellier` VALUES(2, 1, 'cellier2');
INSERT INTO `vino__type` VALUES(1, 'Vin rouge');
INSERT INTO `vino__type` VALUES(2, 'Vin blanc');
INSERT INTO `vino__type` VALUES(3, 'Vin rosé');


/*pour test seulement A ENLEVER PLUS TARD*/
DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(20) NOT NULL,
  `phone` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;