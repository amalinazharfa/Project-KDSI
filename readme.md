CREATE TABLE alumni (
            id INT PRIMARY KEY AUTO_INCREMENT,
            nim CHAR(11) UNIQUE,
            nama VARCHAR(100),
            prodi VARCHAR(30),
            thlulus INT(4)
        );

INSERT INTO alumni VALUES("", "20106050022", "Azhar Zaidan Fauzi", "Teknik Informatika", "2024");

CREATE TABLE user(
        id INT PRIMARY KEY AUTO_INCREMENT,
        username VARCHAR(50) UNIQUE,
        password VARCHAR(255));
    )

CREATE TABLE alu(
    id INT PRIMARY KEY AUTO_INCREMENT,
        alunim VARCHAR(11) UNIQUE,
        alupassword VARCHAR(255));
