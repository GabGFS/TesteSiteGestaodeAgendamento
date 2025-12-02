-- ...new file...
CREATE TABLE IF NOT EXISTS `clientesnovos` (
  `id_cliente` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` VARCHAR(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `celular` VARCHAR(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `data_de_cadastro` DATETIME DEFAULT NULL,
  `nascimento` DATE DEFAULT NULL,
  `genero` VARCHAR(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
