<?php
require_once('./db/connection.php');

session_start();

if (!isset($_SESSION['id']) || !isset($_SESSION['name']) || !isset($_SESSION['loggedAt'])) {
  header('location: ./login.php');
}

$stmt = mysqli_stmt_init($conn);
$query = "SELECT * FROM images";

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    .container {
      position: relative;
    }

    .images {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      margin-bottom: 5rem;
      margin-top: 2rem;
    }


    .images img {
      width: 350px;
      height: 350px;
      object-fit: cover;
      padding: 5px;
    }

    h3,
    h4 {
      display: inline-block;
    }

    h4 {
      text-align: right;
      position: absolute;
      right: 2rem;
    }

    h4 a {
      text-decoration: none;
      color: royalblue;
    }
  </style>
</head>

<body>
  <div class="container">
    <h3>Uploaded Images</h3>
    <h4><a href="./upload.php">Upload Image</a></h4>
    <div class="images">
      <?php

      if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        while ($row = mysqli_fetch_assoc($result)) { ?>
          <?php
          $url = "./uploads/{$row['url']}";
          ?>
          <img src="<?php echo $url ?>" alt="">

      <?php }
      }
      ?>
    </div>
  </div>

</body>

</html>