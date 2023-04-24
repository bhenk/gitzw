CREATE TABLE IF NOT EXISTS `%tbl_name%`
(
    `ID`          INT NOT NULL AUTO_INCREMENT,
    `FK_LEFT`     INT,
    `FK_RIGHT`    INT,
    `deleted`     BOOLEAN,
    `description` VARCHAR(510),
    `hidden`      BOOLEAN,
    `preferred`   BOOLEAN,
    `ordinal`     INT,
    FOREIGN KEY (FK_LEFT) REFERENCES tbl_works (ID),
    FOREIGN KEY (FK_RIGHT) REFERENCES tbl_representations (ID),
    PRIMARY KEY (`ID`)
);