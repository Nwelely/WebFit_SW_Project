<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password</title>
  <link rel="stylesheet" href="../public/css/Login-Style.css">
</head>
<body>
  <?php include('partials/Navigation-Index.php'); ?> <!-- Replaced EJS include with PHP include -->

  <div class="parent-container">
    <div class="form-container" id="reset-password-container">
      <h2>Reset Password</h2>
      <form id="reset-password-form" action="/auth/reset-password.php" method="post"> <!-- Updated form action to point to PHP file -->
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>"> <!-- Updated to use PHP echo for token -->
        
        <label for="password">New Password:</label>
        <input type="password" id="password" name="password" required>
        
        <input type="submit" id="reset-password-button" value="Reset Password">
      </form>
    </div>
  </div>

  <script src="../public/js/Login-JavaScript.js"></script>
</body>
</html>