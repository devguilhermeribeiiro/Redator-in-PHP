<?php 
  include 'config_db.php';

  if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password= $_POST['password'];
  }
