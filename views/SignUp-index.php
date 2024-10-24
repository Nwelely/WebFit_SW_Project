<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="../public/css/Login-Style.css">
</head>

<body><?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sw_project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function sanitizeInput($data) {
    global $conn;
    return $data !== null ? mysqli_real_escape_string($conn, trim($data)) : '';
}

if (isset($_POST['signup'])) {
    $fullname = sanitizeInput($_POST['fullname']);
    $username = sanitizeInput($_POST['username']);
    $userpassword = sanitizeInput($_POST['userpassword']);
    $userphone = sanitizeInput($_POST['userphone']);
    $useremail = sanitizeInput($_POST['useremail']);
    $role = sanitizeInput($_POST['role']);
    $gender = sanitizeInput($_POST['gender']);
    $age = sanitizeInput($_POST['age']);
    $address = sanitizeInput($_POST['address']);
    $subscription = sanitizeInput($_POST['subscription']);

    if ($_POST['userpassword'] !== $_POST['confirm-password']) {
        echo "Passwords do not match.";
        exit();
    }

    // Handle file upload
    $img = null;
    $targetDir = "uploads/";
    
    // Ensure the upload directory exists and is writable
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
        $img = $targetDir . basename($_FILES["img"]["name"]);
        if (!move_uploaded_file($_FILES["img"]["tmp_name"], $img)) {
            echo "Failed to upload image.";
            exit();
        }
    }

    $checkUser = "SELECT * FROM users WHERE username='$username' OR useremail='$useremail' OR userphone='$userphone'";
    $result = $conn->query($checkUser);

    if ($result->num_rows > 0) {
        echo "User already exists.";
        if ($img) {
            unlink($img); // Remove uploaded image if user exists
        }
    } else {
        $hashedPassword = password_hash($userpassword, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (fullname, username, userpassword, userphone, useremail, role, gender, age, address, img, subscription)
                VALUES ('$fullname', '$username', '$hashedPassword', '$userphone', '$useremail', '$role', '$gender', '$age', '$address', '$img', '$subscription')";

        if ($conn->query($sql) === TRUE) {
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            if ($img) {
                unlink($img);
            }
        }
    }
}
?>
    <?php include('partials/Navigation-Index.php'); ?>-

    <div class="form-container" id="signup-container">
    <h2>Signup</h2>
    <form id="signup-form" action="" method="post" enctype="multipart/form-data">
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

                <label for="signup-role">Role:</label>
                <select id="signup-role" name="role" required>
                    <option value="">Select</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select><br />
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
                <input type="file" id="signup-img" name="img" accept="image/*"><br />

                <label for="signup-subscription">Subscription:</label>
                <select id="signup-subscription" name="subscription" required>
                    <option value="">Select</option>
                    <option value="free">Free</option>
                    <option value="premium">Premium</option>
                </select><br />
            </div>
        </div>

        <button type="submit" name="signup" class="signup-container-button">Signup</button>
        <button type="button" class="back-to-login" onclick="window.location.href='/auth/login.php';">Back to Login</button>
    </form>
</div>

    <script src="../public/js/Login-JavaScript.js"></script>
</body>

</html>
