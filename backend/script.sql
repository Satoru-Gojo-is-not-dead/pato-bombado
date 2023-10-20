CREATE DATABASE IF NOT EXISTS apatolipse;

USE apatolipse;

DROP TABLE hospedeiro;

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
