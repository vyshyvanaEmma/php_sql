create database compito17_03_25;
use compito17_03_25;

CREATE TABLE artista (
id_artista INT NOT NULL PRIMARY KEY auto_increment,
cognome_artista VARCHAR(25) NOT NULL,
nome_artista VARCHAR(30) NOT NULL,
anno_nascita_artista VARCHAR(4) NOT NULL
);
CREATE TABLE opera (
id_opera INT NOT NULL PRIMARY KEY auto_increment,
nome_opera VARCHAR(35) NOT NULL,
tipo_opera VARCHAR(50) NOT NULL,
id_artista INT NOT NULL REFERENCES artista(id_artista)
);

INSERT INTO `opera` (`id_opera`, `nome_opera`, `tipo_opera`, `id_artista`)
VALUES (1, 'Mare', 'Pittura', 1),
(2, 'Montagna blu', 'Scultura', 0),
(3, 'Tramonto', 'Scultura', 3),
(4, 'Alba', 'Pittura', 4),
(5, 'Statua uomo', 'Scultura', 1),
(6, 'Statua uomo 2', 'Scultura', 1),
(7, 'Quadro bello', 'Pittura', 2),
(8, 'Quadro montagna', 'Pittura', 2),
(9, 'Aurora', 'Pittura', 3),
(10, 'Firenze', 'Pittura', 5),
(11, 'Roma', 'Pittura', 5),
(12, 'Napoli', 'Pittura', 5);
INSERT INTO `artista` (`id_artista`, `cognome_artista`, `nome_artista`,`anno_nascita_artista`)
VALUES (1, 'Rossi', 'Mario', '1980'),
(2, 'Verdi', 'Carlo', '1978'),
(3, 'Arancino', 'Giulia', '1977'),
(4, 'Giolitti', 'Bruna', '1976'),
(5, 'Maradona', 'Franco', '1990'),
(6, 'Benigni', 'Mario', '1991');