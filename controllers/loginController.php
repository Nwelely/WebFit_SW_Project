<?php
session_start();
$servername = "localhost";  // Make sure it's 'localhost' if you're using XAMPP
$username = "root";         // Default XAMPP MySQL user is 'root'
$password = "";             // No password for 'root' by default in XAMPP
$dbname = "sw_project";
// Establish a connection to the MySQL database using XAMPP
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize input
function sanitizeInput($data) {
    global $conn;
    return mysqli_real_escape_string($conn, htmlspecialchars(trim($data)));
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
            header("Location: login.php?error=invalid_credentials");
            exit();
        }
    } else {
        // User not found
        header("Location: login.php?error=invalid_credentials");
        exit();
    }
}

// Handle the logout process
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    // Destroy the session
    session_destroy();

    // Redirect to the login page
    header("Location: login.php");
    exit();
}
?>
