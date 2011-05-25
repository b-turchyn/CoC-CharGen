CREATE TABLE IF NOT EXISTS %sgovernments (
	`government_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`name` VARCHAR(64) NOT NULL,
	`description` VARCHAR(255) NULL DEFAULT NULL,
	`deleted_dt` TIMESTAMP NULL DEFAULT NULL,
	UNIQUE (
		`name`
	)
)
ENGINE = MyISAM
COMMENT = 'Tracks the different forms of governments associated with countries.';