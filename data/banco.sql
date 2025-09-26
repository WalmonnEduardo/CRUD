CREATE DATABASE dbRobotica;

USE dbRobotica;

CREATE TABLE Turma (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL
);

CREATE TABLE Categoria (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL
);

CREATE TABLE Equipe (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL
);

CREATE TABLE Robo (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    id_categoria INT,
    id_equipe INT,
    FOREIGN KEY (id_categoria) REFERENCES Categoria(id) ON DELETE SET NULL,
    FOREIGN KEY (id_equipe) REFERENCES Equipe(id) ON DELETE SET NULL
);

CREATE TABLE Estudante (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    data_nascimento DATE NOT NULL,
    id_turma INT,
    id_robo INT,
    id_equipe INT,
    FOREIGN KEY (id_turma) REFERENCES Turma(id) ON DELETE SET NULL,
    FOREIGN KEY (id_robo) REFERENCES Robo(id) ON DELETE SET NULL,
    FOREIGN KEY (id_equipe) REFERENCES Equipe(id) ON DELETE SET NULL
);
