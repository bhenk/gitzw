CREATE TABLE IF NOT EXISTS `tbl_res_rep`
(
    `ID` 	INT NOT NULL AUTO_INCREMENT,
    `RESID`	INT NOT NULL,
    `REPID`	INT NOT NULL,
    `ordinal`	INT,
    `hidden`	BOOLEAN,
    `preferred`	BOOLEAN,
    PRIMARY KEY (`ID`) #,
    # FOREIGN KEY (RESID) REFERENCES tbl_resources(ID) ON DELETE CASCADE,
    # FOREIGN KEY (REPID) REFERENCES tbl_representations(ID) ON DELETE CASCADE
);