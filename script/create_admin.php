<?php 
  include 'config_db.php';
  use Ramsey\Uuid\Uuid;


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

if (isset($_POST['login'])) {

  $email = $_POST['email'];
  $password = $_POST['password'];
  
  if (empty($email) || empty($password))
  {
    echo "Por favor, preencha todos os campos";
  }
  else
  {
    $uuid = Uuid::uuid4() -> toString();

    $hashed_password= password_hash($password, PASSWORD_DEFAULT);
    
    $sql_insert_admin = "INSERT INTO Users (uuid, email, password) VALUES (?, ?, ?)";

    $stmt = $db_conn -> prepare($sql_insert_admin);

    if ($stmt)
    {
      $stmt -> bind_param("sss", $uuid, $email, $hashed_password);

      if ($stmt -> execute())
      {
        echo "Usuário registrado com sucesso.";
      }
      else 
      {
        echo "Erro ao resgistrarr usuario" . $stmt -> error;
      }

      $stmt -> close();
    }
    else
    {
      echo "Erro na preparação da consulta";
    }
  }
}
