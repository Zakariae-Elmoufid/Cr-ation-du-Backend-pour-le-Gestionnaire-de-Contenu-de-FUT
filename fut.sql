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


