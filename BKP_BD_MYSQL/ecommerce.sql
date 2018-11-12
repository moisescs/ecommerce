-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tempo de Geração: 12/11/2018 às 23:13
-- Versão do servidor: 5.5.53-0ubuntu0.14.04.1
-- Versão do PHP: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `ecommerce`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `Categoria`
--

DROP TABLE IF EXISTS `Categoria`;
CREATE TABLE IF NOT EXISTS `Categoria` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(20) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Fazendo dump de dados para tabela `Categoria`
--

INSERT INTO `Categoria` (`id_categoria`, `nome`) VALUES
(1, 'Smartphone'),
(2, 'Notebooks'),
(3, 'TV''s'),
(4, 'PC''s'),
(5, 'Outos');

-- --------------------------------------------------------

--
-- Estrutura para tabela `Cliente`
--

DROP TABLE IF EXISTS `Cliente`;
CREATE TABLE IF NOT EXISTS `Cliente` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `sobrenome` varchar(50) NOT NULL,
  `rg` varchar(13) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `data_nasci` date NOT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Fazendo dump de dados para tabela `Cliente`
--

INSERT INTO `Cliente` (`id_cliente`, `nome`, `sobrenome`, `rg`, `cpf`, `data_nasci`) VALUES
(1, 'Moises', 'Silva', '59.980.890-90', '111.111.111-11', '2017-06-15'),
(2, 'Pedro', 'amorim', '52.978.671-0', '443.546.983-09', '1997-12-22'),
(3, 'MC GUIMÊ', 'SAGAZ', '90.090.090-9', '009.909.090-99', '1996-06-05'),
(4, 'MC GUIMÊ', 'SAGAZ', '90.090.090-9', '000.000.000-00', '2016-11-30'),
(5, 'MC GUIMÊ', 'SAGAZ', '90.090.090-9', '009.909.090-93', '0223-03-31');

-- --------------------------------------------------------

--
-- Estrutura para tabela `End_Cliente`
--

DROP TABLE IF EXISTS `End_Cliente`;
CREATE TABLE IF NOT EXISTS `End_Cliente` (
  `id_endereco` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `logradouro` varchar(100) NOT NULL,
  `numero` varchar(5) NOT NULL,
  `complemento` varchar(100) DEFAULT NULL,
  `bairro` varchar(50) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `uf` char(2) DEFAULT NULL,
  `pais` varchar(50) DEFAULT NULL,
  `tipo` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_endereco`),
  KEY `FK_end_cliente_id_cliente` (`id_cliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- RELACIONAMENTOS PARA TABELAS `End_Cliente`:
--   `id_cliente`
--       `Cliente` -> `id_cliente`
--

--
-- Fazendo dump de dados para tabela `End_Cliente`
--

INSERT INTO `End_Cliente` (`id_endereco`, `id_cliente`, `logradouro`, `numero`, `complemento`, `bairro`, `cep`, `cidade`, `uf`, `pais`, `tipo`) VALUES
(1, 2, 'r.eusebio mario da silva', '345', 'proximo ao carrefour', 'jardins', '04193-055', 'sao paulo', NULL, 'Brasil', 'Entrega'),
(2, 1, 'Rua abc', '12', 'casa 04', 'JD carrumbé', '23409-900', 'são paoulo', 'PI', 'Brasil', 'Entrega');

-- --------------------------------------------------------

--
-- Estrutura para tabela `Entrega`
--

DROP TABLE IF EXISTS `Entrega`;
CREATE TABLE IF NOT EXISTS `Entrega` (
  `id_entrega` int(11) NOT NULL AUTO_INCREMENT,
  `id_endereco` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `data_entrega` date DEFAULT NULL,
  `status` varchar(15) NOT NULL,
  `numero_nf` varchar(10) DEFAULT NULL,
  `observacao` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_entrega`),
  KEY `FK_entrega_id_endereco` (`id_endereco`),
  KEY `FK_entrega_id_clienete` (`id_cliente`),
  KEY `FK_entrega_id_pedido` (`id_pedido`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- RELACIONAMENTOS PARA TABELAS `Entrega`:
--   `id_cliente`
--       `Cliente` -> `id_cliente`
--   `id_endereco`
--       `End_Cliente` -> `id_endereco`
--   `id_pedido`
--       `Pedido` -> `id_pedido`
--

--
-- Fazendo dump de dados para tabela `Entrega`
--

INSERT INTO `Entrega` (`id_entrega`, `id_endereco`, `id_cliente`, `id_pedido`, `data_entrega`, `status`, `numero_nf`, `observacao`) VALUES
(1, 2, 1, 3, '2016-12-24', 'Entregue', '', ''),
(2, 2, 1, 5, '2016-12-13', 'Pendente', '', ''),
(3, 1, 2, 1, '2016-12-13', 'Pendente', '', ''),
(4, 1, 2, 2, '2016-12-13', 'Pendente', '', ''),
(5, 1, 2, 4, '2016-12-13', 'Pendente', '', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `Itens_Pedido`
--

DROP TABLE IF EXISTS `Itens_Pedido`;
CREATE TABLE IF NOT EXISTS `Itens_Pedido` (
  `id_pedido` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `qtd` int(11) NOT NULL,
  PRIMARY KEY (`id_pedido`,`id_produto`),
  KEY `FK_itens_pedido_id_produto` (`id_produto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONAMENTOS PARA TABELAS `Itens_Pedido`:
--   `id_pedido`
--       `Pedido` -> `id_pedido`
--   `id_produto`
--       `Produto` -> `id_produto`
--

--
-- Fazendo dump de dados para tabela `Itens_Pedido`
--

INSERT INTO `Itens_Pedido` (`id_pedido`, `id_produto`, `qtd`) VALUES
(1, 3, 2),
(2, 3, 2),
(3, 3, 1),
(3, 14, 2),
(3, 15, 1),
(4, 3, 2),
(5, 3, 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `Pedido`
--

DROP TABLE IF EXISTS `Pedido`;
CREATE TABLE IF NOT EXISTS `Pedido` (
  `id_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `data_pedido` date NOT NULL,
  `forma_pag` varchar(15) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `status` varchar(15) NOT NULL,
  PRIMARY KEY (`id_pedido`),
  KEY `FK_pedido_id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- RELACIONAMENTOS PARA TABELAS `Pedido`:
--   `id_user`
--       `User_Cliente` -> `id_user`
--

--
-- Fazendo dump de dados para tabela `Pedido`
--

INSERT INTO `Pedido` (`id_pedido`, `id_user`, `data_pedido`, `forma_pag`, `valor`, `status`) VALUES
(1, 2, '2016-12-05', 'Boleto', '999.00', 'Aprovado'),
(2, 2, '2016-12-05', 'Boleto', '1998.00', 'Aprovado'),
(3, 1, '2016-12-05', 'Boleto', '4198.00', 'Aprovado'),
(4, 2, '2016-12-05', 'Boleto', '1998.00', 'Aprovado'),
(5, 1, '2016-12-05', 'Boleto', '4995.00', 'Aprovado');

-- --------------------------------------------------------

--
-- Estrutura para tabela `Produto`
--

DROP TABLE IF EXISTS `Produto`;
CREATE TABLE IF NOT EXISTS `Produto` (
  `id_produto` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `qtd` int(11) NOT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `data_cad` date DEFAULT NULL,
  PRIMARY KEY (`id_produto`),
  KEY `FK_produto_id_categoria` (`id_categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- RELACIONAMENTOS PARA TABELAS `Produto`:
--   `id_categoria`
--       `Categoria` -> `id_categoria`
--

--
-- Fazendo dump de dados para tabela `Produto`
--

INSERT INTO `Produto` (`id_produto`, `id_categoria`, `nome`, `preco`, `qtd`, `descricao`, `foto`, `data_cad`) VALUES
(1, 3, 'Tv Samsung 42"', '2200.00', 11, 'Tela Curva', 'img/1479764111.jpg', '2016-11-21'),
(2, 1, 'ASUS Zenfone 3', '1400.00', 38, 'Mais Vendidos. ASUS Zenfone 3 5,2" 3GB/32GB Preto Safira. Tela: 5,2" Full HD Câmera: 16 MP / 8 MP Me', 'img/1480799999.jpg', '2016-12-03'),
(3, 1, 'Samsung J7', '999.00', 34, 'Alcatel · Android · Tela de 4,7 polegadas · 13 megapixels · 4G LTE ·m 16 GB', 'img/1480800243.jpg', '2016-12-03'),
(4, 1, 'Alcatel ', '699.00', 20, 'Alcatel · Android · Tela de 4,7 polegadas · 13 megapixels · 4G LTE ·m 16 GB', 'img/1480813428.jpg', '2016-12-04'),
(5, 1, 'Sony Xperia ', '599.00', 15, 'Sony · Android · Tela de 5 polegadas · 20,7 megapixels · 4G LTE', 'img/1480800394.jpg', '2016-12-03'),
(6, 2, 'Notebook Dell i3 ', '2098.00', 6, 'nspiron 14 5000 (Intel®) c/ HD1TB, 8GB de RAM e Intel Core', 'img/1480801333.jpg', '2016-12-03'),
(7, 1, 'Samsung Galaxy S7', '2300.00', 30, 'Marca: Samsung Tamanho da tela: Tela de 5,1 polegadas Resolução da câmera traseira: 12 mp', 'img/1480812928.jpg', '2016-12-04'),
(8, 1, 'Motorola X Geração II', '1268.99', 25, '       Smartphone Motorola Moto X 2ª Geração Desbloqueado Android 4.4 Tela 5.2" 32GB 4G Wi-Fi Câmera', 'img/1480813133.png', '2016-12-04'),
(9, 1, 'ASUS Selfie', '1099.98', 20, 'Tamanho da tela: Tela de 5,5 polegadas Resolução da câmera traseira: 13 megapixels Recurso: 4G LTE ', 'img/1480816600.jpg', '2016-12-04'),
(10, 5, 'Impressora HP LaserJet Pro', '1100.00', 10, 'A impressora HP LaserJet Pro P1102w é perfeita para atender a demanda diária de usuários domésticos ', 'img/1480816791.jpg', '2016-12-04'),
(11, 5, 'Roteador e Repetidor D-link Dir-809 ', '119.94', 11, 'O Roteador Wireless AC 750Mbps DIR-809 é uma solução de rede wireless econômica mas poderosa, que co', 'img/1480816911.jpg', '2016-12-04'),
(12, 4, 'Computador Gamer Bulldozer', '2199.98', 6, 'Quad Core 3.8 Ghz, 8gb Ram, Geforce 4gb, Ssd 1 tb', 'img/1480817009.jpg', '2016-12-04'),
(13, 4, 'Computador Intel Core I5 Haswell', '2898.99', 4, 'Intel Core I5 Haswell 3.3 Ghz, 16gb Ram, Hd 1tb, Windows 10', 'img/1480817100.jpg', '2016-12-04'),
(14, 5, 'Mouse Gamer Black Hawk', '100.00', 13, 'Optico Usb 2400 Dpi Om703 Fortrek', 'img/1480817217.jpg', '2016-12-04'),
(15, 2, 'Notebook Dell i7', '2999.00', 9, 'Notebook 2 em 1 Dell Inspiron 13 i13-7359-A40 - Intel Core i7 8GB 500TB LED 13,3" Windows 10', 'img/1480973069.jpg', '2016-12-05'),
(16, 2, 'Notebook Lenovo', '2199.99', 60, 'ntel® Core™ i7, 8GB, 1TB, Tela de 14”, Ideapad 310 - 80UG0001BR', 'img/1480973286.png', '2016-12-05'),
(17, 3, 'TV 70" Samsung', '70000.00', 5, 'Smart TV LED Samsung 70" S9 Ultra HD 4HDMI / USB 240htz', 'img/1480973497.jpg', '2016-12-05'),
(18, 3, 'TV 32" Samsung', '1300.00', 50, 'Smart TV LED Samsung 32" S9 Ultra HD 4HDMI / USB 240htz', 'Erro 4', '2016-12-05');

-- --------------------------------------------------------

--
-- Estrutura para tabela `Tel_Cliente`
--

DROP TABLE IF EXISTS `Tel_Cliente`;
CREATE TABLE IF NOT EXISTS `Tel_Cliente` (
  `id_tel` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `dd` char(4) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `tipo` varchar(15) NOT NULL,
  PRIMARY KEY (`id_tel`),
  KEY `FK_tel_cliente_id_cliente_` (`id_cliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- RELACIONAMENTOS PARA TABELAS `Tel_Cliente`:
--   `id_cliente`
--       `Cliente` -> `id_cliente`
--

--
-- Fazendo dump de dados para tabela `Tel_Cliente`
--

INSERT INTO `Tel_Cliente` (`id_tel`, `id_cliente`, `dd`, `numero`, `tipo`) VALUES
(1, 1, '11', '97870-9876', 'Celular'),
(2, 2, '12', '89890-8976', 'cel');

-- --------------------------------------------------------

--
-- Estrutura para tabela `User_Adm`
--

DROP TABLE IF EXISTS `User_Adm`;
CREATE TABLE IF NOT EXISTS `User_Adm` (
  `id_adm` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `rg` varchar(13) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`id_adm`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Fazendo dump de dados para tabela `User_Adm`
--

INSERT INTO `User_Adm` (`id_adm`, `nome`, `rg`, `cpf`, `email`, `senha`, `status`) VALUES
(1, 'Moises Silva', '56.789.789-0', '756.908.098-10', 'moisescs1234@hotmail.com', '1234', 'Ativo'),
(2, 'master', '56.293.287-99', '111.000.111-90', 'master@master.com', 'master', 'Ativo'),
(3, 'Pedro', '45.323.763-02', '783.398.987-03', 'pedroamorimh4@gmail.com', '123', 'Ativo');

-- --------------------------------------------------------

--
-- Estrutura para tabela `User_Cliente`
--

DROP TABLE IF EXISTS `User_Cliente`;
CREATE TABLE IF NOT EXISTS `User_Cliente` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `senha` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`id_user`),
  KEY `FK_user_cliente_id_cliente` (`id_cliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- RELACIONAMENTOS PARA TABELAS `User_Cliente`:
--   `id_cliente`
--       `Cliente` -> `id_cliente`
--

--
-- Fazendo dump de dados para tabela `User_Cliente`
--

INSERT INTO `User_Cliente` (`id_user`, `id_cliente`, `login`, `senha`, `status`) VALUES
(1, 1, 'moises.silva_ads@outlook.com', 'teste', 'Ativo'),
(2, 2, 'pedroamorimh4@gmail.com', '123', 'Ativo'),
(3, 4, 'leke._@hotmail.com', '12', 'Ativo');

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `End_Cliente`
--
ALTER TABLE `End_Cliente`
  ADD CONSTRAINT `FK_end_cliente_id_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `Cliente` (`id_cliente`);

--
-- Restrições para tabelas `Entrega`
--
ALTER TABLE `Entrega`
  ADD CONSTRAINT `FK_entrega_id_clienete` FOREIGN KEY (`id_cliente`) REFERENCES `Cliente` (`id_cliente`),
  ADD CONSTRAINT `FK_entrega_id_endereco` FOREIGN KEY (`id_endereco`) REFERENCES `End_Cliente` (`id_endereco`),
  ADD CONSTRAINT `FK_entrega_id_pedido` FOREIGN KEY (`id_pedido`) REFERENCES `Pedido` (`id_pedido`);

--
-- Restrições para tabelas `Itens_Pedido`
--
ALTER TABLE `Itens_Pedido`
  ADD CONSTRAINT `FK_itens_pedido_id_pedido` FOREIGN KEY (`id_pedido`) REFERENCES `Pedido` (`id_pedido`),
  ADD CONSTRAINT `FK_itens_pedido_id_produto` FOREIGN KEY (`id_produto`) REFERENCES `Produto` (`id_produto`);

--
-- Restrições para tabelas `Pedido`
--
ALTER TABLE `Pedido`
  ADD CONSTRAINT `FK_pedido_id_user` FOREIGN KEY (`id_user`) REFERENCES `User_Cliente` (`id_user`);

--
-- Restrições para tabelas `Produto`
--
ALTER TABLE `Produto`
  ADD CONSTRAINT `FK_produto_id_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `Categoria` (`id_categoria`);

--
-- Restrições para tabelas `Tel_Cliente`
--
ALTER TABLE `Tel_Cliente`
  ADD CONSTRAINT `FK_tel_cliente_id_cliente_` FOREIGN KEY (`id_cliente`) REFERENCES `Cliente` (`id_cliente`);

--
-- Restrições para tabelas `User_Cliente`
--
ALTER TABLE `User_Cliente`
  ADD CONSTRAINT `FK_user_cliente_id_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `Cliente` (`id_cliente`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
