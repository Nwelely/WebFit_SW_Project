<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Us</title>
    <link rel="stylesheet" href="../public/css/About-Contact-Form-Style.css" />
</head>
<body>

    <?php include 'partials/Navigation-Index.php'; ?>

    <div class="container">
        <h2>Contact Us</h2>
        <form action="" method="POST">
            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" required />

            <label for="email">Your Email:</label>
            <input type="email" id="email" name="email" required />

            <label for="message">Your Message:</label>
            <textarea id="message" name="message" rows="6" required></textarea>

            <input type="submit" value="Send Message" />
        </form>
    </div>

    <script src="../public/js/About-Contact-Form-JavaScript.js"></script>
</body>
</html>
