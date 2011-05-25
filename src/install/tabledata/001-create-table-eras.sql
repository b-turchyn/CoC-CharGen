CREATE TABLE IF NOT EXISTS %seras (
	`era_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
	`era_name` VARCHAR(128) NOT NULL,
	`deleted_dt` TIMESTAMP NULL DEFAULT NULL 
)
ENGINE = MyISAM
COMMENT = 'References to all supported eras. ';