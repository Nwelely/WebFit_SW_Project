<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../public/css/Login-Style.css">
</head>

<body>
<?php
// Enable error reporting for debugging purposes
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sw_project";

// Establish database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize input function
function sanitizeInput($data) {
    global $conn;
    return $data !== null ? mysqli_real_escape_string($conn, trim($data)) : '';
} 

// Handle the login process
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'login') {
    $username = sanitizeInput($_POST['username']);
    $password = sanitizeInput($_POST['password']);

    // Check if the user exists
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Verify the password
        if (password_verify($password, $user['userpassword'])) {
            // Store user information in session
            $_SESSION['user'] = $user;
            $_SESSION['isLoggedIn'] = true;
            $_SESSION['isAdmin'] = $user['role'];

            // Redirect to the home page
            header("Location: index.php");
            exit();
        } else {
            // Invalid password
            $loginError = "Invalid username or password.";
        }
    } else {
        // User not found
        $loginError = "Invalid username or password.";
    }
}

// Close the database connection
$conn->close();
?>
    <?php include('partials/Navigation-Index.php'); ?>

    <div class="parent-container">
        <div class="form-container" id="login-container">
            <h2>Login Form</h2>

            <!-- Display error message if set -->
            <?php if (isset($loginError)): ?>
                <p style="color: red;"><?php echo $loginError; ?></p>
            <?php endif; ?>

            <form id="login-form" action="login.php" method="post">
                <input type="hidden" name="action" value="login"> <!-- Hidden field for action -->
                
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                
                <input type="submit" id="login-button" value="Login">
                <input type="button" id="signup-button" onclick="window.location.href='/WebFit_SW_Project/views/SignUp-index.php';" value="Signup">

                
                <a href="/auth/reset-password.php" id="forgot-password">Forgot Password?</a>
            </form>
        </div>
    </div>

    <script src="../public/js/Login-JavaScript.js"></script>
</body>

</html>