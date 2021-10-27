-- MySQL Workbench Synchronization
-- Generated: 2021-10-22 09:31
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: rolac

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE TABLE IF NOT EXISTS `vinodb`.`vino__type` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `type` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


CREATE TABLE IF NOT EXISTS `vinodb`.`vino__action` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `vinodb`.`vino__usager` (
  `id_usager` INT(11) NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NULL DEFAULT NULL,
  `prenom` VARCHAR(45) NULL DEFAULT NULL,
  `courriel` VARCHAR(50) NULL DEFAULT NULL,
  `telephone` VARCHAR(45) NULL DEFAULT NULL,
  `mot_passe` VARCHAR(200) NULL DEFAULT NULL,
  `est_admin` TINYINT(4) NULL DEFAULT NULL,
  PRIMARY KEY (`id_usager`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = '			';

CREATE TABLE IF NOT EXISTS `vinodb`.`vino__cellier` (
  `usager_id` INT(11) NOT NULL,
  `id_cellier` INT(11) NOT NULL AUTO_INCREMENT,
  `emplacement` VARCHAR(45) NULL DEFAULT NULL,
  `temperature` FLOAT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_cellier`),
  INDEX `fk_cellier_usager_idx` (`usager_id` ASC) ,
  CONSTRAINT `fk_cellier_usager`
    FOREIGN KEY (`usager_id`)
    REFERENCES `vinodb`.`vino__usager` (`id_usager`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


CREATE TABLE IF NOT EXISTS `vinodb`.`vino__bouteille` (
  `usager_id_usager` INT(11) NOT NULL,
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(200) NULL DEFAULT NULL,
  `code_saq` VARCHAR(50) NULL DEFAULT NULL,
  `pays` VARCHAR(50) NULL DEFAULT NULL,
  `millesime` INT(11) NULL DEFAULT NULL,
  `description` VARCHAR(200) NULL DEFAULT NULL,
  `url_saq` VARCHAR(200) NULL DEFAULT NULL,
  `url_img` VARCHAR(200) NULL DEFAULT NULL,
  `format` VARCHAR(20) NULL DEFAULT NULL,
  `vino__type_id` INT(11) NOT NULL,
  `garde_jusqua` VARCHAR(45) NULL DEFAULT NULL,
  `note_degustation` VARCHAR(200) NULL DEFAULT NULL,
  `date_ajout` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_vino__bouteille_vino__type1_idx` (`vino__type_id` ASC) ,
  INDEX `fk_vino__bouteille_usager1_idx` (`usager_id_usager` ASC) ,
  CONSTRAINT `fk_vino__bouteille_vino__type1`
    FOREIGN KEY (`vino__type_id`)
    REFERENCES `vinodb`.`vino__type` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vino__bouteille_usager1`
    FOREIGN KEY (`usager_id_usager`)
    REFERENCES `vinodb`.`vino__usager` (`id_usager`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 11
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `vinodb`.`vino__cellier_historique` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_usager` INT(11) NOT NULL,
  `id_cellier` INT(11) NOT NULL,
  `bouteille_id` INT(11) NOT NULL,
  `action_id` INT(11) NOT NULL,
  `date_action` DATE NULL DEFAULT NULL,
  `prix` DECIMAL NULL DEFAULT NULL,
  `quantite` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_vino__cellier_mouv_vino__bouteille1_idx` (`bouteille_id` ASC) ,
  INDEX `fk_vino__cellier_mouv_cellier1_idx` (`id_cellier` ASC) ,
  INDEX `fk_vino__cellier_mouv_type_mouv1_idx` (`action_id` ASC) ,
  INDEX `fk_vino__cellier_mouv_usager1_idx` (`id_usager` ASC) ,
  CONSTRAINT `fk_vino__cellier_mouv_vino__bouteille1`
    FOREIGN KEY (`bouteille_id`)
    REFERENCES `vinodb`.`vino__bouteille` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vino__cellier_mouv_cellier1`
    FOREIGN KEY (`id_cellier`)
    REFERENCES `vinodb`.`vino__cellier` (`id_cellier`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vino__cellier_mouv_type_mouv1`
    FOREIGN KEY (`action_id`)
    REFERENCES `vinodb`.`vino__action` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vino__cellier_mouv_usager1`
    FOREIGN KEY (`id_usager`)
    REFERENCES `vinodb`.`vino__usager` (`id_usager`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 10
DEFAULT CHARACTER SET = utf8;


CREATE TABLE IF NOT EXISTS `vinodb`.`vino__cellier_inventaire` (
  `usager_id` INT(11) NOT NULL,
  `id_cellier` INT(11) NOT NULL,
  `bouteille_id` INT(11) NOT NULL,
  `quantite` INT(11) NULL DEFAULT NULL,
  INDEX `fk_solde_cellier_cellier1_idx` (`id_cellier` ASC) ,
  INDEX `fk_vino__inventaire_cellier_vino__bouteille1_idx` (`usager_id` ASC, `bouteille_id` ASC) ,
  CONSTRAINT `fk_solde_cellier_cellier1`
    FOREIGN KEY (`id_cellier`)
    REFERENCES `vinodb`.`vino__cellier` (`id_cellier`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vino__inventaire_cellier_vino__bouteille1`
    FOREIGN KEY (`usager_id` , `bouteille_id`)
    REFERENCES `vinodb`.`vino__bouteille` (`usager_id_usager` , `id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `vinodb`.`vino__bouteille_saq` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(200) NULL DEFAULT NULL,
  `image` VARCHAR(200) NULL DEFAULT NULL,
  `code_saq` VARCHAR(50) NULL DEFAULT NULL,
  `pays` VARCHAR(50) NULL DEFAULT NULL,
  `description` VARCHAR(200) NULL DEFAULT NULL,
  `prix_saq` DECIMAL NULL DEFAULT NULL,
  `url_saq` VARCHAR(200) NULL DEFAULT NULL,
  `url_img` VARCHAR(200) NULL DEFAULT NULL,
  `format` VARCHAR(20) NULL DEFAULT NULL,
  `type` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 11
DEFAULT CHARACTER SET = utf8;

INSERT INTO `vinodb`.`vino__type` (`type`) VALUES ('vin rouge');
INSERT INTO `vinodb`.`vino__type` (`type`) VALUES ('vin blanc');
INSERT INTO `vinodb`.`vino__type` (`type`) VALUES ('vin rosé');


INSERT INTO `vinodb`.`vino__usager` (`prenom`, `courriel`, `est_admin`) VALUES ('Robert', 'bobus@gmail.com', '1');

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
