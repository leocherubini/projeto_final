CREATE DATABASE projeto_final;

USE projeto_final;

CREATE TABLE grupos (
	id INT NOT NULL AUTO_INCREMENT,
	nome VARCHAR(255) NOT NULL,
	slug VARCHAR(255) NOT NULL,
	PRIMARY KEY(id)
);

INSERT INTO grupos (nome, slug) VALUES ('Administrador do Sistema', 'amd');
INSERT INTO grupos (nome, slug) VALUES ('Gerente de conteúdo do sistema', 'mantenedor');

CREATE TABLE usuarios (
	id INT NOT NULL AUTO_INCREMENT,
	grupo_id INT NOT NULL,
	nome VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL,
	senha VARCHAR(255) NOT NULL,
	perfil VARCHAR(255) NULL,
	descricao VARCHAR(255) NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(grupo_id) REFERENCES grupos(id)
);

CREATE TABLE conteudos (
	id INT NOT NULL AUTO_INCREMENT,
	usuario_id INT NOT NULL,
	titulo VARCHAR(255) NOT NULL,
	descricao VARCHAR(255) NULL,
	imagem VARCHAR(255) NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(usuario_id) REFERENCES usuarios(id)
);