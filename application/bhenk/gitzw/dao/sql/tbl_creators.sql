CREATE TABLE IF NOT EXISTS `%tbl_name%`
(
    `ID`          INT NOT NULL AUTO_INCREMENT,
    `CRID`        VARCHAR(255),
    `firstname`   VARCHAR(255),
    `prefixes`    VARCHAR(255),
    `lastname`    VARCHAR(255),
    `description` VARCHAR(255),
    `url`         VARCHAR(255),
    `sameAs`      VARCHAR(255),
    PRIMARY KEY (`ID`)
);