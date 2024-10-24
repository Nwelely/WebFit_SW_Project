<?php
// Include the database connection file
require 'db_connection.php';

function createAdmin($conn, $username, $password) {
    $sql = "INSERT INTO admins (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $hashed_password = password_hash($password, PASSWORD_BCRYPT); // Hash the password
    $stmt->bind_param("ss", $username, $hashed_password);

    if ($stmt->execute()) {
        echo "New admin created successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Function to read all admin records
function readAdmins($conn) {
    $sql = "SELECT id, username FROM admins";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "ID: " . $row["id"] . " - Username: " . $row["username"] . "<br>";
        }
    } else {
        echo "No admins found.";
    }
}

// Function to update an admin record
function updateAdmin($conn, $id, $new_username, $new_password) {
    $sql = "UPDATE admins SET username = ?, password = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT); // Hash the new password
    $stmt->bind_param("ssi", $new_username, $hashed_password, $id);

    if ($stmt->execute()) {
        echo "Admin updated successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Function to delete an admin record
function deleteAdmin($conn, $id) {
    $sql = "DELETE FROM admins WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Admin deleted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Example usage
// Uncomment the lines below to test the functions:

// Create a new admin
// createAdmin($conn, 'admin_user', 'password123');

// Read all admins
// readAdmins($conn);

// Update an admin
// updateAdmin($conn, 1, 'new_admin_user', 'new_password123');

// Delete an admin
// deleteAdmin($conn, 1);

$conn->close();
?>
