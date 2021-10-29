CREATE DATABASE TpFinal;

USE TpFinal;

CREATE TABLE companies
(
	copmanyId INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    name NVARCHAR(50) NOT NULL,
    cuit NVARCHAR(12) NOT NULL,
    adress VARCHAR(50) NOT NULL,
    founded DATE NOT NULL,
    constraint unq_cuit unique (cuit)
)Engine=InnoDB;

CREATE TABLE career if not exists career
(
	careerId INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    description NVARCHAR(50) NOT NULL,
    active BOOLEAN NOT NULL
)Engine=InnoDB;
