CREATE TABLE IF NOT EXISTS `tbl_representations`
(
    `ID` 	        INT NOT NULL AUTO_INCREMENT,
    `REPID`	        VARCHAR(50) UNIQUE NOT NULL,
    `source`	    VARCHAR(10),
    `description`	VARCHAR(255),
    PRIMARY KEY (`ID`)
);