-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09-Jul-2026 às 15:58
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `inventario_db`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`, `descricao`) VALUES
(1, 'Informática', 'Computadores, periféricos e acessórios'),
(2, 'Papelaria', 'Material de escritório e consumíveis de papel'),
(3, 'Mobiliário', 'Móveis de escritório'),
(4, 'Limpeza', 'Produtos e material de limpeza'),
(5, 'Eletrodomésticos', 'Equipamentos eletrodomésticos de apoio ao escritório'),
(6, 'Rede e Comunicações', 'Equipamento de rede e telecomunicações');

-- --------------------------------------------------------

--
-- Estrutura da tabela `localizacoes`
--

CREATE TABLE `localizacoes` (
  `id` int(11) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `localizacoes`
--

INSERT INTO `localizacoes` (`id`, `codigo`, `nome`) VALUES
(1, 'LOC-01', 'Armazém Central - Prateleira A1'),
(2, 'LOC-02', 'Armazém Central - Prateleira B2'),
(3, 'LOC-03', 'Sala de TI'),
(4, 'LOC-04', 'Depósito Anexo'),
(5, 'LOC-05', 'Escritório Administrativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `logs_atividade`
--

CREATE TABLE `logs_atividade` (
  `id` int(11) NOT NULL,
  `utilizador_id` int(11) DEFAULT NULL,
  `acao` varchar(255) NOT NULL,
  `detalhes` varchar(500) DEFAULT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `logs_atividade`
--

INSERT INTO `logs_atividade` (`id`, `utilizador_id`, `acao`, `detalhes`, `data`) VALUES
(1, 1, 'login', 'Autenticação com sucesso', '2026-01-10 07:55:00'),
(2, 1, 'criar_produto', 'Criou o produto INV-0001 - Portátil Dell Latitude 5440', '2026-01-10 08:00:00'),
(3, 2, 'login', 'Autenticação com sucesso', '2026-02-15 13:25:00'),
(4, 2, 'registar_movimento', 'Saída de 3 unidades do produto INV-0001', '2026-02-15 13:30:00'),
(5, 3, 'login', 'Autenticação com sucesso', '2026-05-01 07:40:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `movimentos_stock`
--

CREATE TABLE `movimentos_stock` (
  `id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `utilizador_id` int(11) NOT NULL,
  `tipo` enum('entrada','saida') NOT NULL,
  `quantidade` int(11) NOT NULL,
  `motivo` varchar(255) DEFAULT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `movimentos_stock`
--

INSERT INTO `movimentos_stock` (`id`, `produto_id`, `utilizador_id`, `tipo`, `quantidade`, `motivo`, `data`) VALUES
(1, 1, 1, 'entrada', 15, 'Compra inicial de stock', '2026-01-10 08:00:00'),
(2, 1, 2, 'saida', 3, 'Atribuição de portátil a colaborador', '2026-02-15 13:30:00'),
(3, 2, 1, 'entrada', 25, 'Reposição de stock de monitores', '2026-01-12 09:15:00'),
(4, 3, 2, 'saida', 6, 'Requisição do departamento de TI', '2026-03-05 10:00:00'),
(5, 5, 2, 'saida', 1, 'Avaria - substituição de impressora', '2026-04-02 15:20:00'),
(6, 6, 3, 'saida', 20, 'Consumo mensal de papelaria', '2026-05-01 07:45:00'),
(7, 9, 1, 'entrada', 12, 'Compra de mobiliário novo', '2026-02-20 08:30:00'),
(8, 10, 2, 'saida', 3, 'Montagem de novo posto de trabalho', '2026-06-10 12:10:00'),
(9, 13, 1, 'entrada', 3, 'Compra para a copa do escritório', '2026-03-15 14:00:00'),
(10, 15, 1, 'entrada', 5, 'Expansão da rede interna', '2026-06-25 16:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfis`
--

CREATE TABLE `perfis` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `perfis`
--

INSERT INTO `perfis` (`id`, `nome`, `descricao`) VALUES
(1, 'Administrador', 'Acesso total ao sistema'),
(2, 'Operador', 'Gere produtos e movimentos de stock'),
(3, 'Utilizador comum', 'Apenas consulta');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `unidade_id` int(11) DEFAULT NULL,
  `localizacao_id` int(11) DEFAULT NULL,
  `quantidade` int(11) NOT NULL DEFAULT 0,
  `quantidade_minima` int(11) NOT NULL DEFAULT 0,
  `preco` decimal(10,2) NOT NULL DEFAULT 0.00,
  `foto` varchar(255) DEFAULT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `codigo`, `categoria_id`, `unidade_id`, `localizacao_id`, `quantidade`, `quantidade_minima`, `preco`, `foto`, `data_criacao`) VALUES
(1, 'Portátil Dell Latitude 5440', 'INV-0001', 1, 1, 3, 12, 5, 850000.00, NULL, '2026-07-09 11:36:44'),
(2, 'Monitor LG 24\" Full HD', 'INV-0002', 1, 1, 3, 20, 5, 145000.00, NULL, '2026-07-09 11:36:44'),
(3, 'Teclado sem fio Logitech K380', 'INV-0003', 1, 1, 3, 4, 10, 18500.00, NULL, '2026-07-09 11:36:44'),
(4, 'Rato ótico USB', 'INV-0004', 1, 1, 3, 40, 10, 8500.00, NULL, '2026-07-09 11:36:44'),
(5, 'Impressora HP LaserJet M110', 'INV-0005', 1, 1, 1, 2, 3, 210000.00, NULL, '2026-07-09 11:36:44'),
(6, 'Resma de Papel A4 (500 folhas)', 'INV-0006', 2, 2, 1, 80, 20, 6500.00, NULL, '2026-07-09 11:36:44'),
(7, 'Caneta Esferográfica Azul (cx 50)', 'INV-0007', 2, 2, 1, 25, 5, 12000.00, NULL, '2026-07-09 11:36:44'),
(9, 'Cadeira de Escritório Ergonómica', 'INV-0009', 3, 1, 4, 10, 2, 95000.00, 'assets/uploads/produto_6a4f976cc3289.jpeg', '2026-07-09 11:36:44'),
(10, 'Secretária em L', 'INV-0010', 3, 1, 4, 1, 2, 180000.00, NULL, '2026-07-09 11:36:44'),
(11, 'Detergente Multiusos 5L', 'INV-0011', 4, 4, 5, 18, 5, 4200.00, NULL, '2026-07-09 11:36:44'),
(12, 'Kit de Limpeza para Escritório', 'INV-0012', 4, 3, 5, 22, 5, 7800.00, NULL, '2026-07-09 11:36:44'),
(13, 'Frigorífico Compacto 90L', 'INV-0013', 5, 1, 5, 3, 1, 165000.00, NULL, '2026-07-09 11:36:44'),
(14, 'Micro-ondas 20L', 'INV-0014', 5, 1, 5, 2, 1, 78000.00, NULL, '2026-07-09 11:36:44'),
(15, 'Switch de Rede 24 Portas Gigabit', 'INV-0015', 6, 1, 3, 5, 2, 320000.00, NULL, '2026-07-09 11:36:44');

-- --------------------------------------------------------

--
-- Estrutura da tabela `recuperacoes_senha`
--

CREATE TABLE `recuperacoes_senha` (
  `id` int(11) NOT NULL,
  `utilizador_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `usado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `recuperacoes_senha`
--

INSERT INTO `recuperacoes_senha` (`id`, `utilizador_id`, `token`, `data_criacao`, `usado`) VALUES
(1, 3, 'a1b2c3d4e5f60718293a4b5c6d7e8f90', '2026-05-01 08:00:00', 1),
(2, 2, 'f0e9d8c7b6a5948372615f4e3d2c1b0a', '2026-06-20 17:22:00', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `unidades_medida`
--

CREATE TABLE `unidades_medida` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `sigla` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `unidades_medida`
--

INSERT INTO `unidades_medida` (`id`, `nome`, `sigla`) VALUES
(1, 'Unidade', 'un'),
(2, 'Caixa', 'cx'),
(3, 'Pacote', 'pct'),
(4, 'Litro', 'L'),
(5, 'Quilograma', 'kg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizadores`
--

CREATE TABLE `utilizadores` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `perfil_id` int(11) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `utilizadores`
--

INSERT INTO `utilizadores` (`id`, `nome`, `email`, `senha`, `perfil_id`, `foto`, `ativo`, `data_criacao`) VALUES
(1, 'Administrador', 'admin@instic.local', '$2y$10$iL7/peW6DMYk/r99qm1ct.1/ruKT7YXFWm0tlYchf27ESFUM6hSpO', 1, NULL, 1, '2026-07-09 11:28:52'),
(2, 'Lesly Mapa', 'operador@instic.local', '$2y$10$rDEg.mACH/Ik16Cejp3zu.q.lQ1C3lp499kJqQk2hJg32j0u2bU0i', 2, NULL, 1, '2026-07-09 11:36:44'),
(3, 'Beatriz Sousa', 'comum@instic.local', '$2y$10$KWuZu6v/m5JQ5tjvg/OPJuDpZOLL6JD6TazLYNQhHjl5e2nbS9xGS', 3, NULL, 1, '2026-07-09 11:36:44');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `localizacoes`
--
ALTER TABLE `localizacoes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Índices para tabela `logs_atividade`
--
ALTER TABLE `logs_atividade`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utilizador_id` (`utilizador_id`),
  ADD KEY `idx_logs_data` (`data`);

--
-- Índices para tabela `movimentos_stock`
--
ALTER TABLE `movimentos_stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utilizador_id` (`utilizador_id`),
  ADD KEY `idx_movimentos_produto` (`produto_id`),
  ADD KEY `idx_movimentos_data` (`data`);

--
-- Índices para tabela `perfis`
--
ALTER TABLE `perfis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD KEY `unidade_id` (`unidade_id`),
  ADD KEY `localizacao_id` (`localizacao_id`),
  ADD KEY `idx_produtos_categoria` (`categoria_id`),
  ADD KEY `idx_produtos_codigo` (`codigo`);

--
-- Índices para tabela `recuperacoes_senha`
--
ALTER TABLE `recuperacoes_senha`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utilizador_id` (`utilizador_id`);

--
-- Índices para tabela `unidades_medida`
--
ALTER TABLE `unidades_medida`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `perfil_id` (`perfil_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `localizacoes`
--
ALTER TABLE `localizacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `logs_atividade`
--
ALTER TABLE `logs_atividade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `movimentos_stock`
--
ALTER TABLE `movimentos_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `perfis`
--
ALTER TABLE `perfis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `recuperacoes_senha`
--
ALTER TABLE `recuperacoes_senha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `unidades_medida`
--
ALTER TABLE `unidades_medida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `logs_atividade`
--
ALTER TABLE `logs_atividade`
  ADD CONSTRAINT `logs_atividade_ibfk_1` FOREIGN KEY (`utilizador_id`) REFERENCES `utilizadores` (`id`) ON DELETE SET NULL;

--
-- Limitadores para a tabela `movimentos_stock`
--
ALTER TABLE `movimentos_stock`
  ADD CONSTRAINT `movimentos_stock_ibfk_1` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `movimentos_stock_ibfk_2` FOREIGN KEY (`utilizador_id`) REFERENCES `utilizadores` (`id`);

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `produtos_ibfk_2` FOREIGN KEY (`unidade_id`) REFERENCES `unidades_medida` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `produtos_ibfk_3` FOREIGN KEY (`localizacao_id`) REFERENCES `localizacoes` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limitadores para a tabela `recuperacoes_senha`
--
ALTER TABLE `recuperacoes_senha`
  ADD CONSTRAINT `recuperacoes_senha_ibfk_1` FOREIGN KEY (`utilizador_id`) REFERENCES `utilizadores` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  ADD CONSTRAINT `utilizadores_ibfk_1` FOREIGN KEY (`perfil_id`) REFERENCES `perfis` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
