-- filepath: /Applications/XAMPP/htdocs/siteoficial/db/migrations/002_create_daily_totals.sql
-- ...new file...
CREATE TABLE IF NOT EXISTS `total_de_clientes_no_dia` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `dia` DATE NOT NULL,
  `total_atendimentos` INT UNSIGNED NOT NULL DEFAULT 0,
  `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ux_dia` (`dia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DELIMITER $$
CREATE TRIGGER `trg_clientesnovos_after_insert`
AFTER INSERT ON `clientesnovos`
FOR EACH ROW
BEGIN
  DECLARE reg_dia DATE;
  IF NEW.data_de_cadastro IS NOT NULL THEN
    SET reg_dia = DATE(NEW.data_de_cadastro);
  ELSE
    SET reg_dia = DATE(NOW());
  END IF;

  INSERT INTO `total_de_clientes_no_dia` (`dia`, `total_atendimentos`)
  VALUES (reg_dia, 1)
  ON DUPLICATE KEY UPDATE
    `total_atendimentos` = `total_atendimentos` + 1,
    `updated_at` = CURRENT_TIMESTAMP;
END$$
DELIMITER ;
