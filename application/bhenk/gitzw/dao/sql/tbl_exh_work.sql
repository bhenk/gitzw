CREATE TABLE IF NOT EXISTS `%tbl_name%`
(
    `ID`          INT NOT NULL AUTO_INCREMENT,
    `FK_LEFT`     INT,
    `FK_RIGHT`    INT,
    `deleted`     BOOLEAN,
    `ordinal`     INT,
    `reprID`      INT,
    `description` VARCHAR(255),
    `hidden`      BOOLEAN,
    FOREIGN KEY (FK_LEFT) REFERENCES tbl_exhibitions (ID),
    FOREIGN KEY (FK_RIGHT) REFERENCES tbl_works (ID),
    FOREIGN KEY (reprID) REFERENCES tbl_representations (ID),
    PRIMARY KEY (`ID`)
);