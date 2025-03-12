<?php

require "../connection/connection.php";

$query = "CREATE TABLE photos(
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            user_id INT(11) NOT NULL,
            title VARCHAR(255) NOT NULL,
            description TEXT,
            tags VARCHAR(255),
            image_path VARCHAR(255) NOT NULL,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
            )";

$start = $conn->prepare($query);
$start->execute();
