CREATE TABLE users
(
user_id INT PRIMARY KEY AUTO_INCREMENT,
username VARCHAR(255) UNIQUE
);

CREATE TABLE places
(
place_id INT PRIMARY KEY AUTO_INCREMENT,
place_name VARCHAR(255),
created_by INT,
created_date DATETIME
);