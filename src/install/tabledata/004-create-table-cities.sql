CREATE TABLE IF NOT EXISTS %scities (
	`city_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`name` VARCHAR(64) NOT NULL,
	`population` INT(9) NULL,
	`country_id` INT NOT NULL,
	`deleted_dt` TIMESTAMP NULL DEFAULT NULL,
	INDEX (
		`country_id`
	)
)
ENGINE = MyISAM
COMMENT = 'Cities related to countries';