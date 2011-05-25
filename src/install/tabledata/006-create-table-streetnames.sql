CREATE TABLE IF NOT EXISTS %sstreetnames (
	`streetname_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`name` VARCHAR(64) NOT NULL COMMENT 'The name to use',
	`is_suffix` BOOL NOT NULL DEFAULT '0',
	`deleted_dt` TIMESTAMP NULL DEFAULT NULL,
	INDEX (
		`is_suffix`
	),
	UNIQUE (
		`name`
	)
)
ENGINE = MyISAM;