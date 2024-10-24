<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="../public/css/Login-Style.css">
</head>

<body>
    <?php include('partials/Navigation-Index.php'); ?>

    <div class="form-container" id="signup-container">
        <h2>Signup</h2>
        <form id="signup-form" action="/auth/signup.php" method="post" enctype="multipart/form-data"> <!-- Change action to point to PHP file handling signup -->
            <div class="row">
                <div class="left-column">
                    <label for="signup-fullname">Full Name:</label>
                    <input type="text" id="signup-fullname" name="fullname" required><br />

                    <label for="signup-username">Username:</label>
                    <input type="text" id="signup-username" name="username" required><br />

                    <label for="signup-phone">Phone:</label>
                    <input type="text" id="signup-phone" name="userphone" required><br />

                    <label for="signup-password">Password:</label>
                    <input type="password" id="signup-password" name="userpassword" required><br />

                    <label for="signup-address">Address:</label>
                    <input type="text" id="signup-address" name="address" required><br />
                </div>

                <div class="right-column">
                    <label for="signup-email">Email:</label>
                    <input type="email" id="signup-email" name="useremail" required><br />

                    <label for="signup-age">Age:</label>
                    <input type="number" id="signup-age" name="age" required><br />

                    <label for="signup-gender">Gender:</label>
                    <select id="signup-gender" name="gender" required>
                        <option value="">Select</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select><br />

                    <label for="confirm-password">Confirm Password:</label>
                    <input type="password" id="confirm-password" name="confirm-password" required><br />

                    <label for="signup-img">Profile Image:</label>
                    <input type="file" id="signup-img" name="img" accept="image/*" required><br />
                </div>
            </div>

            <button type="submit" class="signup-container-button">Signup</button>
            <button type="button" class="back-to-login" onclick="window.location.href='/auth/login.php';">Back to Login</button> <!-- Updated to point to PHP login file -->
        </form>
    </div>

    <script src="../public/js/Login-JavaScript.js"></script>
</body>

</html>