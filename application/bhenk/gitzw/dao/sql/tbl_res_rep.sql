CREATE TABLE IF NOT EXISTS `tbl_res_rep`
(
    `ID` 	INT NOT NULL AUTO_INCREMENT,
    `resourceID`	    INT NOT NULL,
    `representationID`  INT NOT NULL,
    `ordinal`	        INT,
    `hidden`	        BOOLEAN,
    `preferred`	        BOOLEAN,
    `deleted`           BOOLEAN,
    PRIMARY KEY (`ID`) #,
    # FOREIGN KEY (resourceID) REFERENCES tbl_resources(ID) ON DELETE CASCADE,
    # FOREIGN KEY (representationID) REFERENCES tbl_representations(ID) ON DELETE CASCADE
);