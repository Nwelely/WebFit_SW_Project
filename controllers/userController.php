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
    return mysqli_real_escape_string($conn, trim($data));
}

// Display all users
function displayAllUsers() {
    global $conn;

    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "ID: " . $row["id"]. " - Name: " . $row["fullname"]. " - Email: " . $row["useremail"]. "<br>";
        }
    } else {
        echo "0 results";
    }
}

// Handle user signup
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

    // Handle file upload
    $img = null;
    if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
        $targetDir = "uploads/";
        $img = $targetDir . basename($_FILES["img"]["name"]);
        move_uploaded_file($_FILES["img"]["tmp_name"], $img);
    }

    // Check if user exists
    $checkUser = "SELECT * FROM users WHERE username='$username' OR useremail='$useremail' OR userphone='$userphone'";
    $result = $conn->query($checkUser);

    if ($result->num_rows > 0) {
        echo "User already exists.";
        if ($img) {
            unlink($img); // Remove uploaded image if user exists
        }
    } else {
        // Insert new user
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

// Handle user update
if (isset($_POST['updateUser'])) {
    $userId = sanitizeInput($_POST['userId']);
    $updateFields = [];

    if (!empty($_POST['editUsersName'])) $updateFields[] = "username='" . sanitizeInput($_POST['editUsersName']) . "'";
    if (!empty($_POST['newUsersFullName'])) $updateFields[] = "fullname='" . sanitizeInput($_POST['newUsersFullName']) . "'";
    if (!empty($_POST['UsersPassword'])) {
        $hashedPassword = password_hash(sanitizeInput($_POST['UsersPassword']), PASSWORD_DEFAULT);
        $updateFields[] = "userpassword='$hashedPassword'";
    }
    if (!empty($_POST['userphone'])) $updateFields[] = "userphone='" . sanitizeInput($_POST['userphone']) . "'";
    if (!empty($_POST['edituseremail'])) $updateFields[] = "useremail='" . sanitizeInput($_POST['edituseremail']) . "'";
    if (!empty($_POST['role'])) $updateFields[] = "role='" . sanitizeInput($_POST['role']) . "'";
    if (!empty($_POST['gender'])) $updateFields[] = "gender='" . sanitizeInput($_POST['gender']) . "'";
    if (!empty($_POST['editUsersage'])) $updateFields[] = "age='" . sanitizeInput($_POST['editUsersage']) . "'";
    if (!empty($_POST['editUsersaddress'])) $updateFields[] = "address='" . sanitizeInput($_POST['editUsersaddress']) . "'";
    if (!empty($_POST['subscription'])) $updateFields[] = "subscription='" . sanitizeInput($_POST['subscription']) . "'";

    // Handle image update
    if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
        $targetDir = "uploads/";
        $newImgPath = $targetDir . basename($_FILES["img"]["name"]);
        move_uploaded_file($_FILES["img"]["tmp_name"], $newImgPath);

        $oldImgQuery = "SELECT img FROM users WHERE id='$userId'";
        $result = $conn->query($oldImgQuery);
        $row = $result->fetch_assoc();
        if ($row['img']) {
            unlink($row['img']);
        }

        $updateFields[] = "img='$newImgPath'";
    }

    if (!empty($updateFields)) {
        $updateSql = "UPDATE users SET " . implode(", ", $updateFields) . " WHERE id='$userId'";
        if ($conn->query($updateSql) === TRUE) {
            echo "User updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
}

// Delete user
if (isset($_POST['deleteUser'])) {
    $userId = sanitizeInput($_POST['userId']);
    $getImg = "SELECT img FROM users WHERE id='$userId'";
    $result = $conn->query($getImg);
    $row = $result->fetch_assoc();

    if ($row['img']) {
        unlink($row['img']);
    }

    $sql = "DELETE FROM users WHERE id='$userId'";
    if ($conn->query($sql) === TRUE) {
        echo "User deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Close database connection
$conn->close();
?>
