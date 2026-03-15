DROP DATABASE IF EXISTS assicurazioni;
CREATE DATABASE assicurazioni;

USE assicurazioni;

CREATE TABLE Proprietario(
    codice_fiscale varchar(20) PRIMARY KEY NOT NULL,
    cognome varchar(64) NOT NULL,
    nome varchar(64) NOT NULL,
    residenza varchar(100) NOT NULL
);

CREATE TABLE Assicurazione(
    codice INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome varchar(64) NOT NULL, 
    sede varchar(64) NOT NULL
);


CREATE TABLE Polizza(
    codice INT NOT NULL PRIMARY KEY AUTO_INCREMENT ,
    data_scadenza DATE NOT NULL, 
    codice_assicurazione INT NOT NULL,

    FOREIGN KEY (codice_assicurazione) REFERENCES Assicurazione(codice)
);

CREATE TABLE Automobile(
    targa VARCHAR(8) PRIMARY KEY NOT NULL,
    marca varchar(64) NOT NULL,
    cilindrata INT NOT NULL, 
    potenza INT NOT NULL,
    cf_proprietario varchar(20) NOT NULL,
    codice_polizza INT NOT NULL,

    FOREIGN KEY (cf_proprietario) REFERENCES Proprietario(codice_fiscale),
    FOREIGN KEY (codice_polizza) REFERENCES Polizza(codice)
);

CREATE TABLE Sinistro(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	data DATE NOT NULL,
	localita VARCHAR(64) NOT NULL
);

CREATE TABLE AutoCoinvolte(
	importo_danno FLOAT NOT NULL,
	id_sinistro INT NOT NULL,
	targa VARCHAR(8) NOT NULL,
	
	FOREIGN KEY (id_sinistro) REFERENCES Sinistro(id),
	FOREIGN KEY (targa) REFERENCES Automobile(targa)
);


INSERT INTO Proprietario VALUES
('RSSMRA80A01H501U','Rossi','Mario','Roma'),
('VRDLGI85B12F205X','Verdi','Luigi','Milano'),
('BNCLRA90C53D612Y','Bianchi','Laura','Torino'),
('NRGMRC75D22A944Z','Neri','Marco','Napoli'),
('GLLFNC88E14H703K','Gialli','Francesca','Bologna');

INSERT INTO Assicurazione (nome, sede) VALUES
('Unipol','Bologna'),
('Generali','Trieste'),
('Allianz','Milano');

INSERT INTO Polizza (data_scadenza, codice_assicurazione) VALUES
('2026-12-31',1),
('2025-06-30',2),
('2026-03-15',3),
('2025-11-20',1),
('2027-01-01',2),
('2026-08-10',3);

INSERT INTO Automobile VALUES
('AA111AA','Fiat',1200,69,'RSSMRA80A01H501U',1),
('BB222BB','Volkswagen',1600,90,'VRDLGI85B12F205X',2),
('CC333CC','Ford',1400,75,'BNCLRA90C53D612Y',3),
('DD444DD','BMW',2000,150,'NRGMRC75D22A944Z',4),
('EE555EE','Audi',1800,120,'RSSMRA80A01H501U',5),
('FF666FF','Toyota',1300,72,'GLLFNC88E14H703K',6);

INSERT INTO Sinistro (data, localita) VALUES
('2025-01-10','Roma'),
('2025-02-15','Milano'),
('2025-03-20','Torino'),
('2025-04-05','Roma'),
('2025-05-18','Napoli');

INSERT INTO AutoCoinvolte VALUES
-- Sinistro 1
(1500,1,'AA111AA'),
(2000,1,'BB222BB'),

-- Sinistro 2
(3000,2,'BB222BB'),
(2500,2,'CC333CC'),

-- Sinistro 3
(1800,3,'AA111AA'),
(2200,3,'DD444DD'),

-- Sinistro 4
(4000,4,'EE555EE'),
(3500,4,'FF666FF'),

-- Sinistro 5
(2700,5,'AA111AA'),
(3200,5,'DD444DD');