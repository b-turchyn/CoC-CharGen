CREATE TABLE IF NOT EXISTS %scountries (
	`country_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`name` VARCHAR(64) NOT NULL,
	`population` BIGINT(15) NOT NULL,
	`era_id` INT NOT NULL,
	`government_id` INT NOT NULL,
	`deleted_dt` TIMESTAMP NULL DEFAULT NULL,
	INDEX (
		`name`,
		`era_id`,
		`government_id`
	)
)
ENGINE = MyISAM;