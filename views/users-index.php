<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Users</title>
  <link rel="stylesheet" href="../public/css/">
</head>

<body>
  <?php include('partials/Navigation-Index.php'); ?>
  <h2 class="title">All the Users</h2>

  <div id="userContainer" class="container">
    <?php if (count($users) > 0): ?>
      <?php foreach ($users as $user): ?>
        <div class="card">
          <div class="card-content">
            <h2><?php echo htmlspecialchars($user['username']); ?></h2>
            <p><?php echo htmlspecialchars($user['useremail']); ?></p>
            <h2><?php echo htmlspecialchars($user['age']); ?></h2>
            <p><?php echo htmlspecialchars($user['address']); ?></p>
            <p><?php echo htmlspecialchars($user['subscription']); ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>No users available.</p>
    <?php endif; ?>
  </div>

  <script src="../public/js/user-index.js"></script>
</body>

</html>
