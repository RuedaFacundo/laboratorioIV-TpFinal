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

CREATE TABLE careers 
(
	careerId int auto_increment not null primary key,
    description NVARCHAR(50) NOT NULL
)Engine=InnoDB;

CREATE TABLE jobPositions
(
	jobPositionId int auto_increment not null primary key,
    careerId int,
    description NVARCHAR(50) NOT NULL,
    constraint fk_careerId foreign key (careerId) references careers (careerId)
)Engine=InnoDB;

CREATE TABLE users 
(
	userId int auto_increment not null primary key,
	email NVARCHAR(50) NOT NULL,
    password NVARCHAR(50) NOT NULL,
    profile NVARCHAR(50) NOT NULL,
    constraint unq_email unique (email)
)Engine=InnoDB;

CREATE TABLE jobOffers
(
	jobOfferId int auto_increment not null primary key,
    jobPositionId int,
    copmanyId int,
	datePublished date,
    remote boolean,
    salary float,
    skills NVARCHAR(50) NOT NULL,
    projectDescription NVARCHAR(100) NOT NULL,
    active boolean,
    constraint fk_jobPositionId foreign key (jobPositionId) references jobPositions (jobPositionId),
    constraint fk_copmanyId foreign key (copmanyId) references companies (copmanyId)
)Engine=InnoDB;

alter table careers 
add active boolean;

CREATE TABLE appointments
(
	appointmentId int auto_increment not null primary key,
    jobOfferId int,
    studentId int,
    message NVARCHAR(100) NOT NULL,
    cv NVARCHAR(50) NOT NULL,
	constraint fk_jobOfferId foreign key (jobOfferId) references jobOffers (jobOfferId),
    constraint fk_studentId foreign key (studentId) references users (userId)
)Engine=InnoDB;