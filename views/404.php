<?php
http_response_code(404);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "Page Not Found"; ?></title>
    <link rel="stylesheet" href="/css/404-Style.css"> 
</head>
<body>
    <div class="container">
        <h1><?php echo "404"; ?></h1>
        <p><?php echo "Oops! The page you are looking for does not exist."; ?></p>
        <p><?php echo "It might have been removed, had its name changed, or is temporarily unavailable."; ?></p>
        <p><a href="/"><?php echo "Go to Homepage"; ?></a></p>
    </div>
</body>
</html>
