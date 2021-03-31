<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>REGISTER</title>
</head>

<body>
  <div class="container">
    <form action="./process/register-inc.php" method="post" novalidate>
      <div>
        <h3>Registration form</h3>

        <?php if (@$_GET['error'] == true) {
        ?>
          <div style="margin: 1rem 0; color: red"><?php echo $_GET['error']  ?></div>
        <?php }  ?>
        <label for="name">Name</label><br>
        <input type="text" name="name" id="name" required><br>

        <label for="email">E-mail</label><br>
        <input type="email" name="email" id="email" required><br>

        <label for="password">Password</label><br>
        <input type="password" name="password" id="password" required><br><br>

        <button type="submit" name="register_btn">Register</button><br><br>

        <div>
          Already have an account? <a href="./login.php">Log In</a>
        </div>
      </div>
    </form>
  </div>
</body>

</html>