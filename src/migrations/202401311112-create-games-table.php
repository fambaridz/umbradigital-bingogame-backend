<?php

require_once('../../config/dbConfig.php');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE TABLE games (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date_played TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Games table created successfully.";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();

?>
