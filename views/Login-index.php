<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="../public/css/Login-Style.css">
</head>

<body>
  <?php include('partials/Navigation-Index.php'); ?>

  <div class="parent-container">
    <div class="form-container" id="login-container">
      <h2>Login Form</h2>
      <form id="login-form" action="/auth/login.php" method="post"> 
        <input type="text" id="username" name="username">
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        
        <input type="submit" id="login-button" value="Login">
        <input type="button" id="signup-button" onclick="window.location.href='/auth/signup.php';" value="Signup">
        
        <a href="/auth/reset-password.php" id="forgot-password">Forgot Password?</a> 
      </form>
    </div>
  </div>

  <script src="../public/js/Login-JavaScript.js"></script>
</body>

</html>