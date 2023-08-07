drop database if exists escola;
create database escola;
use escola;

create table Aluno(
id_aluno smallint primary key auto_increment,
nome_aluno varchar(100),
idade_aluno  smallint,
datanascimento date,
endereco varchar(100),
estatus bool,
matricula varchar(11));

create table Professor(
id_professor smallint primary key auto_increment,
nome_professor varchar(100),
cpf varchar(11),
siape smallint,
idade_professor smallint);

create table Disciplina(
id_disciplina smallint primary key auto_increment,
nome_disciplina varchar(80),
ch char(3),
semestre varchar(5),
id_professor smallint,
foreign key (id_professor) references Professor(id_professor));
