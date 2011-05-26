CREATE TABLE IF NOT EXISTS %snames (
	`name_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`name` VARCHAR(64) NOT NULL,
	`gender` CHAR(1) NOT NULL DEFAULT 'B' COMMENT 'M for Male, F for Female, B for Both',
	`isfirst` BOOL NOT NULL DEFAULT '1' COMMENT 'True for first name, false for last name',
	`era_id` INT NOT NULL COMMENT 'Reference to applicable era',
        `meaning` VARCHAR(255) NOT NULL DEFAULT "",
        `origin` VARCHAR(100) NOT NULL,
	`deleted_dt` TIMESTAMP NULL DEFAULT NULL,
	INDEX (
		`gender`,
		`isfirst`,
		`era_id`
	)
)
ENGINE = MyISAM
COMMENT = 'First and last names for characters';
