-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Mar 11, 2012 as 12:16 AM
-- Versão do Servidor: 5.5.10
-- Versão do PHP: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `speedinfo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `plugin_produtos`
--

CREATE TABLE `plugin_produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idCat` int(11) DEFAULT '0',
  `nome` varchar(200) NOT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `descricao` text NOT NULL,
  `destaque` enum('0','1') DEFAULT '0',
  `status` enum('0','1') DEFAULT '1',
  `tipo` enum('1','2') NOT NULL,
  `permicao` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idCat` (`idCat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `plugin_produtos_fotos`
--

CREATE TABLE `plugin_produtos_fotos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idProd` int(11) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `descricao` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;
