CREATE TABLE IF NOT EXISTS %1$soccupations (
  `occupation_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `occupation_name` VARCHAR(128) NOT NULL,
  `lovecraftian_sw` BOOLEAN NOT NULL DEFAULT FALSE,
  `deleted_dt` TIMESTAMP NULL DEFAULT NULL,

  UNIQUE INDEX (occupation_name)
)
ENGINE = MyISAM
COMMENT = 'References to all supported occupations. ';
