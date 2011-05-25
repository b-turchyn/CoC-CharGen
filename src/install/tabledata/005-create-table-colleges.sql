CREATE TABLE IF NOT EXISTS %scolleges (
	`college_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`name` VARCHAR(64) NOT NULL,
	`starting_era_id` INT NOT NULL,
	`ending_era_id` INT NULL DEFAULT NULL,
	`deleted_dt` TIMESTAMP NULL DEFAULT NULL,
	INDEX (
		`starting_era_id`,
		`ending_era_id`
	),
	UNIQUE (
		`name`
	)
)
ENGINE = MyISAM;