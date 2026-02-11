drop database if exists voto;
create database voto;
use voto;
--
-- Struttura della tabella `candidati`
--
CREATE TABLE `candidati` (
`id_candidato` bigint(20) NOT NULL auto_increment,
`cognome` varchar(30) NOT NULL default '',
`nome` varchar(25) NOT NULL default '',
`id_lista` bigint(20) NOT NULL default '0',
`voti` bigint(20) NOT NULL default '0',
PRIMARY KEY (`id_candidato`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;
--
-- Dump dei dati per la tabella `candidati`
--
INSERT INTO `candidati` VALUES (1, 'Marietti', 'Giovanni', 2, 3);
INSERT INTO `candidati` VALUES (2, 'Giannini', 'Maurizio', 5, 2);
INSERT INTO `candidati` VALUES (3, 'Calvino', 'Simona', 5, 4); INSERT
INTO `candidati` VALUES (4, 'Santolini', 'Michele', 1, 7); INSERT INTO
`candidati` VALUES (5, 'Mazzetti', 'Luigi', 1, 2); INSERT INTO
`candidati` VALUES (6, 'Attucci', 'Paola', 2, 3); INSERT INTO
`candidati` VALUES (7, 'Mazzi', 'Vittorio', 4, 4); INSERT INTO
`candidati` VALUES (8, 'Masseti', 'Gianni', 4, 4); INSERT INTO
`candidati` VALUES (9, 'D''Antonio', 'Ugo Alberto', 2, 3); INSERT INTO
`candidati` VALUES (10, 'Paolini', 'Pietro', 3, 3); INSERT INTO
`candidati` VALUES (11, 'Corsani', 'Patrizia', 3, 0); INSERT INTO
`candidati` VALUES (12, 'Kindelas', 'Walter', 1, 2); INSERT INTO
`candidati` VALUES (13, 'Barlucci', 'Urbano', 2, 1); INSERT INTO
`candidati` VALUES (14, 'Filippini', 'Otello', 3, 1); INSERT INTO
`candidati` VALUES (15, 'Nantegacci', 'Francesco', 5, 0); INSERT INTO
`candidati` VALUES (16, 'Pollini', 'Andrea', 2, 0); INSERT INTO
`candidati` VALUES (17, 'Sassi', 'Marzia', 4, 1); INSERT INTO
`candidati` VALUES (18, 'Grechi', 'Roberto', 2, 0); INSERT INTO
`candidati` VALUES (19, 'Greco', 'Lucia', 5, 0); INSERT INTO
`candidati` VALUES (20, 'Viciani', 'Daniele', 1, 1); INSERT INTO
`candidati` VALUES (21, 'Bruschi', 'Nicoletta', 4, 1); INSERT INTO
`candidati` VALUES (22, 'Manichi', 'Silvano', 3, 1);
-- --------------------------------------------------------
--
-- Struttura della tabella `liste`
--
CREATE TABLE `liste` (
`id_lista` bigint(20) NOT NULL auto_increment,
`nome_lista` varchar(50) NOT NULL default '',
PRIMARY KEY (`id_lista`)

) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;
--
-- Dump dei dati per la tabella `liste`
--
INSERT INTO `liste` VALUES (1, 'Per il bene della gente');
INSERT INTO `liste` VALUES (2, 'Democrazia sempre');
INSERT INTO `liste` VALUES (3, 'Viva l''Italia'); INSERT
INTO `liste` VALUES (4, 'Repubblica nuova'); INSERT INTO
`liste` VALUES (5, 'Facciamo politica');