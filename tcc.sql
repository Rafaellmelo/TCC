create database tcc;
use tcc;
create table login(
username varchar(45) not null,
password varchar(30) not null
);

create table membros(
id int auto_increment primary key,
nome varchar(100) not null,
data_nascimento date not null,
numero varchar(20) not null,
batismo enum('Sim','Não') not null,
data_batismo date ,
genero enum('Homem','Mulher') not null,
cargo varchar(50) not null
);

CREATE TABLE financeiro (
    ano YEAR NOT NULL, 
    mes ENUM('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro') NOT NULL, 
    agua DECIMAL(10, 2) CHECK (agua >= 0), 
    luz DECIMAL(10, 2) CHECK (luz >= 0), 
    doacao DECIMAL(10, 2) CHECK (doacao >= 0), 
    eventos DECIMAL(10, 2) CHECK (eventos >= 0), 
    outros_lucro DECIMAL(10, 2) CHECK (outros_lucro >= 0), 
    outros_despesas DECIMAL(10, 2) CHECK (outros_despesas >= 0), 
    saldo DECIMAL(10, 2), 
    lucro_total DECIMAL(10, 2), 
    despesa_total DECIMAL(10, 2), 
    PRIMARY KEY (ano, mes)
);


