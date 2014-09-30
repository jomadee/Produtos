-- phpMyAdmin SQL Dump
-- version 2.11.7
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Dez 07, 2011 as 11:19 AM
-- Versão do Servidor: 5.0.51
-- Versão do PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `azoup`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `plugin_produtos`
--

CREATE TABLE `plugin_produtos` (
  `id` int(11) NOT NULL auto_increment,
  `idCat` int(11) default '0',
  `nome` varchar(200) NOT NULL,
  `foto` varchar(200) default NULL,
  `descricao` text NOT NULL,
  `destaque` enum('0','1') default '0',
  `status` enum('0','1') default '1',
  `tipo` enum('1','2') NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `plugin_produtos_fotos`
--

CREATE TABLE `plugin_produtos_fotos` (
  `id` int(11) NOT NULL auto_increment,
  `idProd` int(11) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `descricao` varchar(250) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;
