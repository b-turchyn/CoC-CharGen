CREATE TABLE IF NOT EXISTS %1$soccupation_eras (
  `occupation_id` INT NOT NULL,
  `era_id`        INT NOT NULL,
  FOREIGN KEY fk_occupation(occupation_id)
    REFERENCES %1$soccupations(occupation_id)
    ON DELETE CASCADE,
  FOREIGN KEY fk_era(era_id)
    REFERENCES %1$seras(era_id)
    ON DELETE CASCADE,
  UNIQUE KEY (occupation_id, era_id)
)
ENGINE = MyISAM
COMMENT = 'References to all supported occupations. ';
