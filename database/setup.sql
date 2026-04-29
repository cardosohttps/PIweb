CREATE DATABASE IF NOT EXISTS routine_hacker;
USE routine_hacker;


CREATE TABLE IF NOT EXISTS cursos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT
);


CREATE TABLE IF NOT EXISTS recompensas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    icone_url VARCHAR(255) 
);



CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL, 
    id_curso INT,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_curso) REFERENCES cursos(id) ON DELETE SET NULL
);


CREATE TABLE IF NOT EXISTS checklists (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    data_criacao DATE NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE
);


CREATE TABLE IF NOT EXISTS sugestoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_curso INT NOT NULL,
    nome VARCHAR(100) NOT NULL,
    tipo ENUM('Afazer', 'Compromisso', 'Aula') NOT NULL,
    descricao TEXT,
    FOREIGN KEY (id_curso) REFERENCES cursos(id) ON DELETE CASCADE
);


CREATE TABLE IF NOT EXISTS atividades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    nome VARCHAR(100) NOT NULL,
    tipo VARCHAR(50) NOT NULL, 
    descricao TEXT,
    data_registro DATE NOT NULL,
    concluida BOOLEAN DEFAULT FALSE,
    id_checklist INT,
    id_sugestao INT, 
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (id_checklist) REFERENCES checklists(id) ON DELETE CASCADE,
    FOREIGN KEY (id_sugestao) REFERENCES sugestoes(id) ON DELETE SET NULL
);


CREATE TABLE IF NOT EXISTS historico (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_atividade INT NOT NULL,
    data_conclusao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (id_atividade) REFERENCES atividades(id) ON DELETE CASCADE
);


CREATE TABLE IF NOT EXISTS usuario_recompensas (
    id_usuario INT NOT NULL,
    id_recompensa INT NOT NULL,
    data_conquista TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_usuario, id_recompensa), 
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (id_recompensa) REFERENCES recompensas(id) ON DELETE CASCADE
);




INSERT INTO cursos (nome, descricao) VALUES 
('Técnico em Informática', 'Foco em programação, redes e banco de dados.'),
('Técnico em Química', 'Foco em laboratório, análises e reações químicas.'),
('Técnico em Vestuário', 'Foco em modelagem, costura e design de moda.');


INSERT INTO recompensas (id, nome, descricao, icone_url) VALUES 
(1, 'Bronze: Primeiro Passo!', 'Concluiu sua primeira atividade no Routine Hacker.', '/img/medalha-bronze.png'),
(2, 'Ouro: Mestre da Rotina!', 'Atingiu a incrível marca de 50 atividades concluídas.', '/img/medalha-ouro.png');


INSERT INTO sugestoes (id_curso, nome, tipo, descricao) VALUES 
(1, 'Revisar Lógica de Programação', 'Afazer', 'Resolver 3 exercícios de algoritmos.'),
(1, 'Aula de Banco de Dados', 'Aula', 'Modelagem Entidade-Relacionamento e SQL.');