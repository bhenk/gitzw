CREATE TABLE IF NOT EXISTS `%tbl_name%`
(
    `ID`          INT                NOT NULL AUTO_INCREMENT,
    `EXHID`       VARCHAR(25) UNIQUE NOT NULL,
    `title_en`    VARCHAR(255),
    `title_nl`    VARCHAR(255),
    `preferred`   VARCHAR(2),
    `subtitle`    VARCHAR(255),
    `date`        DATE,
    `d_format`    VARCHAR(10),
    `description` VARCHAR(1020),
    PRIMARY KEY (`ID`)
);