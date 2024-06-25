<?php 
  include 'config_db.php';
  use Ramsey\Uuid\Uuid;

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
