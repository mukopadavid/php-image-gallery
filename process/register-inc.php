<?php

$conn = mysqli_connect('localhost', 'root', '', 'prince');

if (!$conn) {
  echo mysqli_connect_error();
}

if (isset($_POST['register_btn'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  if (!empty($name) && !empty($email) && !empty($password)) {
    $stmt = mysqli_stmt_init($conn);
    $query = "SELECT * FROM users WHERE email = ?";
    if (mysqli_stmt_prepare($stmt, $query)) {

      mysqli_stmt_bind_param($stmt, 's', $email);
      mysqli_stmt_execute($stmt);

      mysqli_stmt_store_result($stmt);
      $row = mysqli_stmt_num_rows($stmt);

      if ($row > 0) {
        header('location:../register.php?error=The email is already in use');
      } else {
        $query = "INSERT INTO users (name, email, password) VALUES (?,?,?)";

        if (mysqli_stmt_prepare($stmt, $query)) {
          $hashedPass = password_hash($password, PASSWORD_DEFAULT);
          mysqli_stmt_bind_param($stmt, 'sss', $name, $email, $hashedPass);

          if (mysqli_stmt_execute($stmt)) {
            header('location:../login.php');
          } else {
            header('location:../register.php?error=Registration failed, please try again');
          }
        } else {
          header('location:../register.php?error=An error occured, please try again');
        }
      }
    } else {
      header('location:../register.php?error=An error occured, please try again');
    }
  } else {
    header('location:../register.php?error=Empty fields submitted, ensure that all the fields are filled before submission');
  }
}
