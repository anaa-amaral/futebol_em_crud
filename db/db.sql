CREATE DATABASE futebol_db;
USE futebol_db;

CREATE TABLE times (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cidade VARCHAR(100) NOT NULL
);

CREATE TABLE jogadores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    posicao VARCHAR(30) NOT NULL,
    numero_camisa INT NOT NULL,
    time_id INT,
    FOREIGN KEY (time_id) REFERENCES times(id)
);

CREATE TABLE partidas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    time_casa_id INT NOT NULL,
    time_fora_id INT NOT NULL,
    data_jogo DATE NOT NULL,
    FOREIGN KEY (time_casa_id) REFERENCES times(id),
    FOREIGN KEY (time_fora_id) REFERENCES times(id)
);

-- dados inseridos
INSERT INTO times (nome, cidade) VALUES
('Botafogo', 'Rio de Janeiro'),
('Palmeiras', 'São Paulo'),
('Internacional', 'Porto Alegre'),
('Falmengo', 'Rio de Janeiro'),
('São Paulo', 'São Paulo'),
('Santos', 'São Paulo'),
('Sport', 'Recife'),
('Cruzeiro', 'Belo Horizonte'),
('Bahia', 'Salvador'),
('Ceará', 'Fortaleza'),
('Mirassol', 'Mirassol'),
('Corinthians', 'São Paulo'),
('Vitória', 'Salvador'),
('Vasco', 'Rio de Janeiro'),
('Juventude', 'Caxias do Sul'),
('Grêmio', 'Porto Alegre'),
('Fluminense', 'Rio de Janeiro'),
('Atletico MG', 'Belo Horizonte'),
('Bragantino', 'Bragança Paulista'),
('Fortaleza', 'Fortaleza');

INSERT INTO jogadores (nome, posicao, numero_camisa, time_id) VALUES
('Carlos Silva', 'GOL', 1, 1),
('Rafael Souza', 'ATA', 9, 1),
('João Lima', 'MEI', 8, 2),
('Pedro Rocha', 'ZAG', 4, 3);

INSERT INTO partidas (time_casa_id, time_fora_id, data_jogo) VALUES
(15, 1, '2025-08-24'),
(14, 12, '2025-08-24'),
(20, 11, '2025-08-24'),
(8, 3, '2025-08-24'),
(4, 13, '2025-08-25'),
(5, 18, '2025-08-24'),
(9, 6, '2025-08-24'),
(16, 10, '2025-08-23'),
(17, 19, '2025-08-23'),
(2, 7, '2025-08-25');