-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20/05/2024 às 04:07
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `grupo003_pi`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `dias`
--

CREATE TABLE `dias` (
  `idAgendamento` int(11) NOT NULL,
  `Dias` varchar(10) NOT NULL,
  `Data` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `dias`
--

INSERT INTO `dias` (`idAgendamento`, `Dias`, `Data`) VALUES
(1, 'Domingo', '2024-05-19'),
(2, 'Segunda', '2024-05-20'),
(3, 'Terça', '2024-05-21'),
(4, 'Quarta', '2024-05-22'),
(5, 'Quinta', '2024-05-23'),
(6, 'Sexta', '2024-05-24'),
(7, 'Sabado', '2024-05-25');

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `Nome` varchar(60) NOT NULL,
  `RG` int(11) NOT NULL,
  `Senha` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `horas`
--

CREATE TABLE `horas` (
  `idHoras` int(11) NOT NULL,
  `Horas` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `horas`
--

INSERT INTO `horas` (`idHoras`, `Horas`) VALUES
(1, '11:00'),
(2, '13:00'),
(3, '15:00'),
(4, '17:00'),
(5, '19:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `quadras`
--

CREATE TABLE `quadras` (
  `idQuadras` int(11) NOT NULL,
  `Nome` varchar(30) NOT NULL,
  `Aberta` varchar(10) NOT NULL,
  `Fechada` varchar(10) NOT NULL,
  `Atividade` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `quadras`
--

INSERT INTO `quadras` (`idQuadras`, `Nome`, `Aberta`, `Fechada`, `Atividade`) VALUES
(1, 'II Futebol', '11:00', '19:00', 'Livre');

-- --------------------------------------------------------

--
-- Estrutura para tabela `reservas`
--

CREATE TABLE `reservas` (
  `idReservas` int(11) NOT NULL,
  `idAgendamento` int(11) NOT NULL,
  `idHoras` int(11) NOT NULL,
  `idQuadras` int(11) NOT NULL,
  `IdUsuarios` int(11) DEFAULT NULL,
  `reserva` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `reservas`
--

INSERT INTO `reservas` (`idReservas`, `idAgendamento`, `idHoras`, `idQuadras`, `IdUsuarios`, `reserva`) VALUES
(1, 1, 1, 1, NULL, 'Reservado'),
(2, 2, 1, 1, NULL, 'Livre'),
(3, 3, 1, 1, NULL, 'Livre'),
(4, 4, 1, 1, NULL, 'Livre'),
(5, 5, 1, 1, NULL, 'Livre'),
(6, 6, 1, 1, NULL, 'Livre'),
(7, 7, 1, 1, NULL, 'Livre'),
(8, 1, 2, 1, NULL, 'Livre'),
(9, 2, 2, 1, NULL, 'Livre'),
(10, 3, 2, 1, NULL, 'Livre'),
(11, 4, 2, 1, NULL, 'Reservado'),
(12, 5, 2, 1, NULL, 'Livre'),
(13, 6, 2, 1, NULL, 'Livre'),
(14, 7, 2, 1, NULL, 'Livre'),
(15, 1, 3, 1, NULL, 'Livre'),
(16, 2, 3, 1, NULL, 'Livre'),
(17, 3, 3, 1, NULL, 'Livre'),
(18, 4, 3, 1, NULL, 'Livre'),
(19, 5, 3, 1, NULL, 'Livre'),
(20, 6, 3, 1, NULL, 'Livre'),
(21, 7, 3, 1, NULL, 'Livre'),
(22, 1, 4, 1, NULL, 'Livre'),
(23, 2, 4, 1, NULL, 'Livre'),
(24, 3, 4, 1, NULL, 'Livre'),
(25, 4, 4, 1, NULL, 'Livre'),
(26, 5, 4, 1, NULL, 'Livre'),
(27, 6, 4, 1, NULL, 'Livre'),
(28, 7, 4, 1, NULL, 'Livre'),
(29, 1, 5, 1, NULL, 'Livre'),
(30, 2, 5, 1, NULL, 'Livre'),
(31, 3, 5, 1, NULL, 'Livre'),
(32, 4, 5, 1, NULL, 'Livre'),
(33, 5, 5, 1, NULL, 'Reservado'),
(34, 6, 5, 1, NULL, 'Livre'),
(35, 7, 5, 1, NULL, 'Reservado');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuarios` int(11) NOT NULL,
  `Nome` varchar(60) NOT NULL,
  `Email` varchar(60) NOT NULL,
  `Telefone` int(11) NOT NULL,
  `Nascimento` date NOT NULL,
  `Senha` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`idUsuarios`, `Nome`, `Email`, `Telefone`, `Nascimento`, `Senha`) VALUES
(1, 'Teste Testando', 'teste@teste.com', 2147483647, '1111-11-11', '$2y$10$eeyLMw/FhZt8tv9iwzp6ievfMCiNDUEWeigOlzWs/14/PhEvkUIQG'),
(2, 'DANIEL VALVERDE SILVA', 'daniel.valverde.silva.1987@gmail.com', 2147483647, '1111-11-11', '$2y$10$7GF.MVgEjVsi9Amn81WkquRHgZn.Shvd0pnIezsnIQlIbwh03nZoC');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `dias`
--
ALTER TABLE `dias`
  ADD PRIMARY KEY (`idAgendamento`);

--
-- Índices de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`RG`);

--
-- Índices de tabela `horas`
--
ALTER TABLE `horas`
  ADD PRIMARY KEY (`idHoras`);

--
-- Índices de tabela `quadras`
--
ALTER TABLE `quadras`
  ADD PRIMARY KEY (`idQuadras`);

--
-- Índices de tabela `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`idReservas`),
  ADD KEY `idAgendamento` (`idAgendamento`),
  ADD KEY `idQuadras` (`idQuadras`),
  ADD KEY `IdUsuarios` (`IdUsuarios`),
  ADD KEY `idHoras` (`idHoras`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuarios`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `reservas`
--
ALTER TABLE `reservas`
  MODIFY `idReservas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `horas`
--
ALTER TABLE `horas`
  ADD CONSTRAINT `fk_Horas_Dias` FOREIGN KEY (`idHoras`) REFERENCES `dias` (`idAgendamento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`idAgendamento`) REFERENCES `dias` (`idAgendamento`),
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`idQuadras`) REFERENCES `quadras` (`idQuadras`),
  ADD CONSTRAINT `reservas_ibfk_3` FOREIGN KEY (`IdUsuarios`) REFERENCES `usuarios` (`idUsuarios`),
  ADD CONSTRAINT `reservas_ibfk_4` FOREIGN KEY (`idHoras`) REFERENCES `horas` (`idHoras`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
