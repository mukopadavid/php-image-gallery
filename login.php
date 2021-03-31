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
    <form action="./process/login-inc.php" method="post">
      <div>
        <h3>Login form</h3>

        <?php if (@$_GET['error'] == true) {
        ?>
          <div style="margin: 1rem 0; color: red"><?php echo $_GET['error']  ?></div>
        <?php }  ?>

        <label for="email">E-mail</label><br>
        <input type="email" name="email" id="email" value="<?php echo @$_GET['email'] ?>"><br>

        <label for="password">Password</label><br>
        <input type="password" name="password" id="password"><br><br>

        <button type="submit" name="login_btn">Login</button><br><br>

        <div>
          Don't have an account? <a href="./register.php">Sign Up</a>
        </div>
      </div>
    </form>
  </div>
</body>

</html>