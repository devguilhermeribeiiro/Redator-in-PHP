<?php

require 'vendor/autoload.php';
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;


$server_name = 'localhost';
$db_username = 'guilherme';
$db_password = 'Guilherme:20032014';
$db_name = 'redator';

$db_conn = new mysqli($server_name, $db_username, $db_password);

if ($db_conn -> connect_error) {
    die("Connection failed: " . $db_conn -> connect_error);
}

$sql_create_db = "CREATE DATABASE  IF NOT EXISTS $db_name";
$sql_create_table = "CREATE TABLE IF NOT EXISTS Users 
(
    uuid CHAR(36) NOT NULL,
    username VARCHAR(25) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(25) NOT NULL,
    CONSTRAINT Users UNIQUE(id, email)
)";

$db_conn -> close();