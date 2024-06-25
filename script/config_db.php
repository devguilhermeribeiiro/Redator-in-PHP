<?php
require 'vendor/autoload.php';

$server_name = 'localhost';
$db_username = 'guilherme';
$db_password = 'Guilherme:20032014';
$db_name = 'php_redator';

$db_conn = new mysqli($server_name, $db_username, $db_password);

if ($db_conn->connect_error) {
    die("Connection failed: " . $db_conn->connect_error);
}

$sql_create_db = "CREATE DATABASE IF NOT EXISTS $db_name";
if ($db_conn->query($sql_create_db) === TRUE) {
    echo "Database created or already exists successfully<br>";
} else {
    echo "Error creating database: " . $db_conn->error . "<br>";
}

mysqli_select_db($db_conn, $db_name);

$sql_create_table = "CREATE TABLE IF NOT EXISTS Users (
    uuid CHAR(36) PRIMARY KEY,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
)";
if ($db_conn->query($sql_create_table) === TRUE) {
    echo "Table Users created or already exists successfully<br>";
} else {
    echo "Error creating table: " . $db_conn->error . "<br>";
}

