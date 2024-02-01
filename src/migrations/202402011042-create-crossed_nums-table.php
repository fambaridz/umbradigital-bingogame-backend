<?php

require_once('../../config/dbConfig.php');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE TABLE crossed_nums (
    id INT AUTO_INCREMENT PRIMARY KEY,
    letter CHAR(1),
    number INT,
    game_id INT,
    card_id INT,
    FOREIGN KEY (game_id) REFERENCES games(id),
    FOREIGN KEY (card_id) REFERENCES cards(id)
)";

if ($conn->query($sql) === TRUE) {
    echo "Games table created successfully.";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();

?>
