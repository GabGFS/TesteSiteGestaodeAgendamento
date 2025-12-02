-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 02/12/2025 às 01:23
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `Lastversion`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientesnovos`
--

CREATE TABLE `clientesnovos` (
  `id_cliente` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `celular` varchar(15) DEFAULT NULL,
  `data_de_cadastro` datetime DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `genero` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientesnovos`
--

INSERT INTO `clientesnovos` (`id_cliente`, `nome`, `email`, `celular`, `data_de_cadastro`, `nascimento`, `genero`) VALUES
(1, 'Gab', 'faz@gmail.com', '44997418687', NULL, NULL, NULL),
(2, 'Gab', 'faz@gmail.com', 'affsa', NULL, NULL, NULL),
(3, 'Gabrielle', 'teste34@email.com', '(44) 997443028', NULL, NULL, NULL),
(4, 'Gabrielle', 'teste34@email.com', '(44) 997443028', NULL, NULL, NULL),
(5, 'Gabrielle', 'teste734@email.com', '(44) 997443028', NULL, NULL, NULL),
(6, 'Gabrielle', 'teste73d4@email.com', '44997443028', NULL, NULL, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `clientesnovos`
--
ALTER TABLE `clientesnovos`
  ADD PRIMARY KEY (`id_cliente`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientesnovos`
--
ALTER TABLE `clientesnovos`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
