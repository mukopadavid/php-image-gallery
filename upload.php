<?php
session_start();

if (!isset($_SESSION['id']) || !isset($_SESSION['name']) || !isset($_SESSION['loggedAt'])) {
  header('location: ./login.php');
}


// logging out the user after 15 minutres of inactivity
if (time() - $_SESSION['loggedAt'] > 900) {
  header('location: ./login.php');
} else {
  $_SESSION['loggedAt'] = time();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./main.css">
  <title>FILE UPLOADER</title>
  <style>
    .container {
      position: relative;
    }

    a {
      position: absolute;
      right: 2rem;
      top: 1rem;
      color: #fff;
      padding: 5px;
      text-decoration: none;
    }
  </style>
</head>

<body>
  <div class="container">
    <a href="./process/logout.php">logout</a>
    <form action="./process/upload-inc.php" method="post" enctype="multipart/form-data">
      <div>
        <h2>Choose the file you want to upload</h2>
        <input type="file" name="file" id="file">

        <button type="submit" name="submit">UPLOAD</button>
      </div>
    </form>
  </div>
</body>

</html>