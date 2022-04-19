
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- perguntas
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `perguntas`;

CREATE TABLE `perguntas`
(
    `ID` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `PERGUNTA` TEXT NOT NULL,
    `CREATED_AT` DATETIME,
    `UPDATED_AT` DATETIME,
    PRIMARY KEY (`ID`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- respostas
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `respostas`;

CREATE TABLE `respostas`
(
    `ID` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `SESSION_ID` VARCHAR(255) NOT NULL,
    `IP` VARCHAR(255) NOT NULL,
    `RESPOSTAS` TEXT NOT NULL,
    `RESULTADOS` VARCHAR(255),
    `CREATED_AT` DATETIME,
    `UPDATED_AT` DATETIME,
    PRIMARY KEY (`ID`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
