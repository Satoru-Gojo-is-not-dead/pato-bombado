CREATE DATABASE IF NOT EXISTS apatolipse;

USE apatolipse;

CREATE TABLE IF NOT EXISTS hospedeiro(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    idade INTEGER NOT NULL,
    sexo VARCHAR(9) NOT NULL,
    peso DECIMAL(8, 2) NOT NULL,
    altura DECIMAL(8, 2) NOT NULL,
    tipoSanguineo VARCHAR(5) NOT NULL,
    esportesPraticados VARCHAR(300),
    jogoPreferido VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS zumbi (
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  idHospedeiro INTEGER NOT NULL,
  forca INTEGER NOT NULL,
  velocidade INTEGER NOT NULL,
  inteligencia INTEGER NOT NULL,
  hp INTEGER NOT NULL,
  FOREIGN KEY (idHospedeiro) REFERENCES hospedeiro(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS pato (
	id INTEGER PRIMARY KEY,
    nome VARCHAR(20) NOT NULL UNIQUE,
    healthPoints INTEGER NOT NULL,
    escudoEstaAtivo CHAR(1) NOT NULL
);

CREATE TABLE IF NOT EXISTS habilidades_pato (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    idPato INTEGER NOT NULL,
    codigoHabilidade INTEGER NOT NULL,
    nomeHabilidade VARCHAR(30) NOT NULL,
    dano INTEGER NOT NULL,
    FOREIGN KEY (idPato) REFERENCES pato(id) ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO pato (id, nome, healthPoints, escudoEstaAtivo) VALUES (1, "Quackin", 100, "0");
INSERT INTO pato (id, nome, healthPoints, escudoEstaAtivo) VALUES (2, "Nozzle", 100, "0");
INSERT INTO pato (id, nome, healthPoints, escudoEstaAtivo) VALUES (3, "Ducker", 100, "0");
INSERT INTO pato (id, nome, healthPoints, escudoEstaAtivo) VALUES (4, "Wingson", 100, "0");

INSERT INTO habilidades_pato (idPato, codigoHabilidade, nomeHabilidade, dano) VALUES (1, 1, "Bicada feroz", 15);
INSERT INTO habilidades_pato (idPato, codigoHabilidade, nomeHabilidade, dano) VALUES (1, 2, "Investida Mor", 18);
INSERT INTO habilidades_pato (idPato, codigoHabilidade, nomeHabilidade, dano) VALUES (1, 3, "Rasante elétrico", 20);
INSERT INTO habilidades_pato (idPato, codigoHabilidade, nomeHabilidade, dano) VALUES (1, 4, "Quackada Mortal", 25);

INSERT INTO habilidades_pato (idPato, codigoHabilidade, nomeHabilidade, dano) VALUES (2, 5, "Rajada de água", 13);
INSERT INTO habilidades_pato (idPato, codigoHabilidade, nomeHabilidade, dano) VALUES (2, 6, "Voô flamejante", 20);
INSERT INTO habilidades_pato (idPato, codigoHabilidade, nomeHabilidade, dano) VALUES (2, 7, "Disparo de vento", 22);
INSERT INTO habilidades_pato (idPato, codigoHabilidade, nomeHabilidade, dano) VALUES (2, 8, "Ultimate Nozzle", 26);

INSERT INTO habilidades_pato (idPato, codigoHabilidade, nomeHabilidade, dano) VALUES (3, 9, "Patchê", 14);
INSERT INTO habilidades_pato (idPato, codigoHabilidade, nomeHabilidade, dano) VALUES (3, 10, "Sample of Duck", 21);
INSERT INTO habilidades_pato (idPato, codigoHabilidade, nomeHabilidade, dano) VALUES (3, 11, "Espirro patético", 24);
INSERT INTO habilidades_pato (idPato, codigoHabilidade, nomeHabilidade, dano) VALUES (3, 12, "Morte Patal", 26);

INSERT INTO habilidades_pato (idPato, codigoHabilidade, nomeHabilidade, dano) VALUES (4, 13, "Surprise Wing", 15);
INSERT INTO habilidades_pato (idPato, codigoHabilidade, nomeHabilidade, dano) VALUES (4, 14, "Patada", 22);
INSERT INTO habilidades_pato (idPato, codigoHabilidade, nomeHabilidade, dano) VALUES (4, 15, "Três patinhos na lagoa", 23);
INSERT INTO habilidades_pato (idPato, codigoHabilidade, nomeHabilidade, dano) VALUES (4, 16, "Patality", 27);

CREATE TABLE IF NOT EXISTS player (
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nickName VARCHAR(32) NOT NULL UNIQUE,
    nivel INTEGER NOT NULL
);
