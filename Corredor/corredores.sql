CREATE DATABASE IF NOT EXISTS corredores;
use corredores;

create table participantes(
id int auto_increment primary key,
nome varchar(50) not null,
idade int(3) not null,
numero int(3) not null);

select * from corredores.participantes;
/*verifica se está sendo inserido dentro da tabela as informações necessárias*/