CREATE TABLE IF NOT EXISTS `tbl_resources`
(
    `ID`        INT                NOT NULL AUTO_INCREMENT,
    `RESID`     VARCHAR(25) UNIQUE NOT NULL,
    `title_en`  VARCHAR(255),
    `title_nl`  VARCHAR(255),
    `preferred` VARCHAR(2),
    `media`     VARCHAR(255),
    `width`     FLOAT,
    `height`    FLOAT,
    `depth`     FLOAT,
    `date`      DATE,
    `d_format`  VARCHAR(10),
    `hidden`    BOOLEAN,
    `ordinal`   INT,
    `category`  VARCHAR(10),
    `creatorId` INT,
    PRIMARY KEY (`ID`)
);