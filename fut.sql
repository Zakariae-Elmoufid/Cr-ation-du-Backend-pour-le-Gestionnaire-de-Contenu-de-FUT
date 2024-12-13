create database FUT;
use FUT ;

CREATE TABLE player  
(
   id INT AUTO_INCREMENT PRIMARY KEY,
   player_name VARCHAR(50) NOT NULL,
   photo TEXT,
   position_player VARCHAR(50),
   rating TINYINT,
   status_player BOOLEAN
);


-- Table GK Position
CREATE TABLE gk_position 
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    diving TINYINT,
    handling TINYINT,
    kicking TINYINT,
    reflexes TINYINT,
    speed TINYINT,
    positioning TINYINT,
    player_id INT,
    FOREIGN KEY (player_id) REFERENCES player(id)
);
-- Table Other Position
CREATE TABLE other_position 
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    pace TINYINT,
    shooting TINYINT,
    passing TINYINT,
    dribbling TINYINT,
    defending TINYINT,
    physical TINYINT,
    player_id INT,
    FOREIGN KEY (player_id) REFERENCES player(id)
);

create table  club 
(
   id  int auto_increment primary key ,
   name_club varchar(50),
   logo text ,
   club_id INT,
   FOREIGN KEY (club_id) REFERENCES player(id)
);
create table nationality 
(
    id int auto_increment primary key,
    name_nationality varchar(50),
    flag text,
	nationality_id int ,
    foreign key (nationality_id) references player(id)
);


 -- Insertion des joueurs (20 joueurs : 3 GK, 17 autres positions)
INSERT INTO player (player_name, photo, position_player, rating, status_player)
VALUES 
-- Gardien de but (GK)
('Manuel Neuer', 'https://cdn.sofifa.net/players/167/495/25_240.png', 'Goalkeeper', 90, TRUE),
('Jan Oblak', 'https://cdn.sofifa.net/players/200/389/25_240.png', 'Goalkeeper', 89, TRUE),
('Alisson Becker', 'https://cdn.sofifa.net/players/212/831/25_240.png', 'Goalkeeper', 89, TRUE),

-- Autres positions
('Lionel Messi', 'https://cdn.sofifa.net/players/158/023/25_240.png', 'Forward', 93, TRUE),
('Cristiano Ronaldo', 'https://cdn.sofifa.net/players/208/420/25_240.png', 'Forward', 92, TRUE),
('Kylian Mbappe', 'https://cdn.sofifa.net/players/231/747/25_240.png', 'Forward', 91, TRUE),
('Kevin De Bruyne', 'https://cdn.sofifa.net/players/192/985/25_240.png', 'Midfielder', 91, TRUE),
('Robert Lewandowski', 'https://cdn.sofifa.net/players/188/545/25_240.png', 'Forward', 91, TRUE),
('Mohamed Salah', 'https://cdn.sofifa.net/players/209/331/25_240.png', 'Forward', 89, TRUE),
('Virgil van Dijk', 'https://cdn.sofifa.net/players/203/376/25_240.png', 'Defender', 89, TRUE),
('Luka Modric', 'https://cdn.sofifa.net/players/177/003/25_240.png', 'Midfielder', 89, TRUE),
('Erling Haaland', 'https://cdn.sofifa.net/players/231/747/25_240.png', 'Forward', 89, TRUE),
('Neymar Jr', 'https://cdn.sofifa.net/players/190/871/25_240.png', 'Forward', 89, TRUE),
('Joshua Kimmich', 'https://cdn.sofifa.net/players/212/622/25_240.png', 'Midfielder', 89, TRUE),
('Karim Benzema', 'https://cdn.sofifa.net/players/165/153/25_240.png', 'Forward', 89, TRUE),
('Sadio Mane', 'https://cdn.sofifa.net/players/208/722/25_240.png', 'Forward', 88, TRUE),
('Harry Kane', 'https://cdn.sofifa.net/players/202/126/25_240.png', 'Forward', 88, TRUE),
('Andrew Robertson', 'https://cdn.sofifa.net/players/216/267/25_240.png', 'Defender', 87, TRUE),
('Trent Alexander-Arnold', 'https://cdn.sofifa.net/players/231/866/25_240.png', 'Defender', 87, TRUE),
('Ederson Moraes', 'https://cdn.sofifa.net/players/221/700/25_240.png', 'Goalkeeper', 88, TRUE);

-- Insertion des positions GK
INSERT INTO gk_position (diving, handling, kicking, reflexes, speed, positioning, player_id)
VALUES 
(90, 85, 88, 92, 60, 91, 1), -- Manuel Neuer
(89, 87, 85, 91, 58, 88, 2), -- Jan Oblak
(88, 84, 86, 90, 60, 89, 3); -- Alisson Becker

-- Insertion des positions Other
INSERT INTO other_position (pace, shooting, passing, dribbling, defending, physical, player_id)
VALUES 
(85, 91, 87, 96, 35, 70, 4), -- Lionel Messi
(88, 93, 81, 88, 35, 78, 5), -- Cristiano Ronaldo
(97, 89, 80, 92, 40, 77, 6), -- Kylian Mbappe
(74, 82, 93, 87, 60, 70, 7), -- Kevin De Bruyne
(78, 91, 78, 86, 45, 82, 8), -- Robert Lewandowski
(90, 87, 83, 90, 55, 76, 9), -- Mohamed Salah
(76, 62, 71, 70, 91, 84, 10), -- Virgil van Dijk
(72, 79, 90, 85, 65, 70, 11); -- Luka Modric

-- Insertion des clubs
INSERT INTO club (name_club, logo, club_id)
VALUES 
('Bayern Munich', 'https://cdn.sofifa.net/teams/21/60.png', 1), -- Manuel Neuer
('Atletico Madrid', 'https://cdn.sofifa.net/teams/240/60.png', 2), -- Jan Oblak
('Liverpool', 'https://cdn.sofifa.net/teams/9/60.png', 3), -- Alisson Becker
('Paris Saint-Germain', 'https://cdn.sofifa.net/teams/73/60.png', 4), -- Lionel Messi
('Al-Nassr', 'https://cdn.sofifa.net/teams/112/60.png', 5); -- Cristiano Ronaldo

-- Insertion des nationalités
INSERT INTO nationality (name_nationality, flag, nationality_id)
VALUES 
('Germany', 'https://cdn.sofifa.net/flags/21.png', 1), -- Manuel Neuer
('Slovenia', 'https://cdn.sofifa.net/flags/22.png', 2), -- Jan Oblak
('Brazil', 'https://cdn.sofifa.net/flags/54.png', 3), -- Alisson Becker
('Argentina', 'https://cdn.sofifa.net/flags/52.png', 4), -- Lionel Messi
('Portugal', 'https://cdn.sofifa.net/flags/38.png', 5); -- Cristiano Ronaldo


