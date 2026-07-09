# Sistema de Gestão de Inventário 📦

[cite_start]Este é o **Projeto Prático Final** desenvolvido para a disciplina de **Programação Web** do curso de **Engenharia Informática** no **Instituto de Tecnologias de Informação e Comunicação (Universidade de Luanda)**[cite: 1, 2, 4, 6, 7].

[cite_start]O sistema é uma aplicação web completa desenvolvida em **PHP Orientado a Objetos (PHP-OO)** e **MySQL**, focada no controlo e gestão de stock de uma organização[cite: 8, 32].

---

## 🚀 Funcionalidades Principais

[cite_start]O sistema está dividido em módulos funcionais interligados[cite: 45, 46]:

* [cite_start]**Autenticação Segura:** Controlo de acesso por sessões com 3 perfis de utilizador (Administrador, Operador e Utilizador comum)[cite: 44, 47].
* [cite_start]**Gestão de Produtos (CRUD):** Registo completo com upload de imagens e atributos vinculados (categorias, unidades e localizações)[cite: 44, 47, 52].
* [cite_start]**Conversão de Câmbio em Tempo Real:** Integração com a API externa *Exchange Rate* para converter automaticamente os preços de Kwanzas (AOA) para Dólares (USD).
* [cite_start]**Movimentações de Stock:** Registo histórico (Kardex) de entradas e saídas de produtos para auditoria[cite: 44, 47].
* [cite_start]**Relatórios & Dashboard:** Indicadores visuais na tela inicial e geração de relatórios estratégicos (produtos cadastrados, stock baixo, movimentações mensais)[cite: 44, 47].

---

## 🛠️ Tecnologias Utilizadas

* [cite_start]**Backend:** PHP 8.x (Orientado a Objetos com padrão MVC adaptado) [cite: 8, 34]
* [cite_start]**Base de Dados:** MySQL (utilizando PDO e *Prepared Statements* para máxima segurança) [cite: 4, 38]
* [cite_start]**Frontend:** HTML5, CSS3 (Design Responsivo com Media Queries) e JavaScript [cite: 44, 55]
* [cite_start]**API Externa:** Exchange Rate API (`open.er-api.com`) [cite: 44, 55]

---

## 📐 Arquitetura do Projeto

[cite_start]O projeto segue o padrão arquitetural em camadas (**Model-View-Controller**) estruturado da seguinte forma[cite: 34, 54]:

```text
sistema-inventario/
├── config/          # Configuração e conexão Singleton PDO [cite: 44, 64]
├── controllers/     # Controladores da lógica de negócio [cite: 34, 64]
├── models/          # Modelos de dados e manipulação do Banco de Dados [cite: 34, 64]
├── services/        # Integração com APIs externas 
├── views/           # Interfaces em HTML/CSS apresentadas ao utilizador [cite: 34, 64]
├── assets/          # Ficheiros estáticos (CSS, JS, Imagens, Uploads) 
├── database/        # Script SQL de criação do banco de dados (`sistema_inventario.sql`) 
└── index.php        # Front Controller / Router principal do sistema [cite: 54, 65]
