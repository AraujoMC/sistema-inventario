-- =============================================================================
-- CRIAÇÃO DA BASE DE DADOS E SELEÇÃO
-- =============================================================================
CREATE DATABASE IF NOT EXISTS inventario_db
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE inventario_db;

-- =============================================================================
-- 1. TABELAS DE CONFIGURAÇÃO E UTILIZADORES
-- =============================================================================

-- Perfis de utilizador (Administrador, Operador, Utilizador comum)
CREATE TABLE IF NOT EXISTS perfis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL UNIQUE,
    descricao VARCHAR(255)
) ENGINE=InnoDB;

-- Utilizadores do sistema
CREATE TABLE IF NOT EXISTS utilizadores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    perfil_id INT NOT NULL,
    foto VARCHAR(255) DEFAULT NULL,
    ativo TINYINT(1) NOT NULL DEFAULT 1,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (perfil_id) REFERENCES perfis(id) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

-- =============================================================================
-- 2. TABELAS DE SUPORTE AO PRODUTO
-- =============================================================================

-- Categorias de produtos
CREATE TABLE IF NOT EXISTS categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao VARCHAR(255)
) ENGINE=InnoDB;

-- Unidades de medida (unidade, kg, litro, caixa...)
CREATE TABLE IF NOT EXISTS unidades_medida (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    sigla VARCHAR(10) NOT NULL
) ENGINE=InnoDB;

-- Localizações físicas (armazém, prateleira...)
CREATE TABLE IF NOT EXISTS localizacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao VARCHAR(255)
) ENGINE=InnoDB;

-- =============================================================================
-- 3. TABELA PRINCIPAL DE PRODUTOS
-- =============================================================================

-- Produtos
CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    codigo VARCHAR(50) NOT NULL UNIQUE,
    categoria_id INT,
    unidade_id INT,
    localizacao_id INT,
    quantidade INT NOT NULL DEFAULT 0,
    quantidade_minima INT NOT NULL DEFAULT 0,
    preco DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    foto VARCHAR(255) DEFAULT NULL,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (unidade_id) REFERENCES unidades_medida(id) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (localizacao_id) REFERENCES localizacoes(id) ON DELETE SET NULL ON UPDATE CASCADE,
    INDEX idx_produtos_categoria (categoria_id),
    INDEX idx_produtos_codigo (codigo)
) ENGINE=InnoDB;

-- =============================================================================
-- 4. MOVIMENTAÇÕES E SEGURANÇA
-- =============================================================================

-- Movimentos de stock (entradas e saídas)
CREATE TABLE IF NOT EXISTS movimentos_stock (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produto_id INT NOT NULL,
    utilizador_id INT NOT NULL,
    tipo ENUM('entrada', 'saida') NOT NULL,
    quantidade INT NOT NULL,
    motivo VARCHAR(255),
    data TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (produto_id) REFERENCES produtos(id) ON DELETE CASCADE,
    FOREIGN KEY (utilizador_id) REFERENCES utilizadores(id) ON DELETE RESTRICT,
    INDEX idx_movimentos_produto (produto_id),
    INDEX idx_movimentos_data (data)
) ENGINE=InnoDB;

-- Tokens de recuperação de senha
CREATE TABLE IF NOT EXISTS recuperacoes_senha (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilizador_id INT NOT NULL,
    token VARCHAR(255) NOT NULL,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    usado TINYINT(1) NOT NULL DEFAULT 0,
    FOREIGN KEY (utilizador_id) REFERENCES utilizadores(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Logs de atividade (auditoria)
CREATE TABLE IF NOT EXISTS logs_atividade (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilizador_id INT,
    acao VARCHAR(255) NOT NULL,
    detalhes VARCHAR(500),
    data TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (utilizador_id) REFERENCES utilizadores(id) ON DELETE SET NULL,
    INDEX idx_logs_data (data)
) ENGINE=InnoDB;

-- =============================================================================
-- 5. INSERÇÃO DE DADOS INICIAIS (SEEDERS)
-- =============================================================================

-- Dados iniciais dos perfis (Ignora se já existirem para evitar duplicados)
INSERT IGNORE INTO perfis (id, nome, descricao) VALUES
(1, 'Administrador', 'Acesso total ao sistema'),
(2, 'Operador', 'Gere produtos e movimentos de stock'),
(3, 'Utilizador comum', 'Apenas consulta');

-- Utilizador admin inicial (senha: admin123)
INSERT IGNORE INTO utilizadores (id, nome, email, senha, perfil_id, ativo) VALUES
(1, 'Administrador', 'admin@instic.local', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1);