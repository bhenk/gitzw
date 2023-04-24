CREATE TABLE IF NOT EXISTS `%tbl_name%`
(
    `ID`          INT                NOT NULL AUTO_INCREMENT,
    `REPID`       VARCHAR(50) UNIQUE NOT NULL,
    `source`      VARCHAR(10),
    `description` VARCHAR(510),
    `date`        DATE,
    `d_format`    VARCHAR(10),
    PRIMARY KEY (`ID`)
);