create database cadastros default character set utf8 
default collate utf8_general_ci;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    primary key (id)
)default charset = utf8;

insert into usuarios (nome, email, telefone, senha)
values ('Luiz', 'luiz@gmail.com', '79999203669', 'luiz' );

select * from usuarios;

update usuarios
set 
	nome = 'Luiz Victor Melo Santos' ,
    email = 'luizvictormelo.lv@hotmail.com'
where 
nome = 'Luiz'
;

delete from usuarios
where nome = 'Luiz Victor Melo Santos';

;