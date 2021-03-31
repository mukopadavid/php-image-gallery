<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '', 'prince');

if (!$conn) {
  echo mysqli_connect_error();
}

if (isset($_POST['login_btn'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $stmt = mysqli_stmt_init($conn);
  $query = "SELECT * FROM users WHERE email = ?";
  if (mysqli_stmt_prepare($stmt, $query)) {
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
      if (password_verify($password, $row['password'])) {

        $_SESSION['id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['loggedAt'] = time();

        header('location:../upload.php');
      } else {
        header('location:../login.php?error=Email and password did not match&email=' . $email);
      }
    } else {
      header('location:../login.php?error=Email is not registered');
    }
  }
}
