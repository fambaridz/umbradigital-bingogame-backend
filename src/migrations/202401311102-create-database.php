<?php

require_once('../../config/dbConfig.php');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;

if ($conn->query($sql) === TRUE) {
    echo "Database created successfully.\n";
} else {
    echo "Error creating database: " . $conn->error . "\n";
}

$conn->close();

?>
