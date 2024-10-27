<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title> 
    <link rel="stylesheet" href="../public/css/Admin-Style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf/notyf.min.css">
</head>

<body>
    <?php 
    include_once("user.php");
    include_once("../config/DB.php");

    // Display all users
    function displayAllUsers() {
    global $conn;

    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);

    $users = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

           
            $users[] = $row;
        }
    }
    return $users;
}




if (isset($_GET['view'])) {
    $userId = intval($_GET['view']);
    $userData = $user->viewUser($userId);

    // Debugging output
    if ($userData) {
        header('Content-Type: application/json');
        echo json_encode($userData);
    } else {
        header('Content-Type: application/json');
        echo json_encode(["error" => "User not found."]);
    }
} else {
    echo json_encode(["error" => "Invalid request."]);

}



?>







    <?php include('partials/Navigation-Index.php'); ?>
    <div>
        <div class="actions-container">
            <div class="container" id="admin_Panel">
                <h2>Admin's Panel</h2>
                <div class="admin-menu">
                 
                    <div>
                        <a href="#" class="main-menu-button" onclick="toggleMainMenu('ViewUsersMenu'), toggleVisibility('Userview')">Users</a>
                        <div id="ViewUsersMenu" class="submenu">
                        <a href="#" class="submenu-link" onclick="toggleVisibility('ViewUserContainer'), viewUser(<?= $user['id'] ?>)">View User</a>

                            <a href="#" class="submenu-link" onclick="toggleVisibility('editUserContainer'), editUser()">Edit User</a>
                            <a href="#" class="submenu-link" onclick="removeUser()">Remove User</a>

                        </div>
                    </div>
             
                        <div>
                            <a href="#" class="main-menu-button"
                                onclick="toggleMainMenu('productsMenu'), toggleVisibility('Productview')">Products</a>
                            <div id="productsMenu" class="submenu">
                                <a href="/shop" class="submenu-link">View Products</a>
                                <a href="#" class="submenu-link" onclick="toggleVisibility('addProductsContainer')">Add
                                    Products</a>
                                <a href="#" class="submenu-link"
                                    onclick="toggleVisibility('editProductsContainer')">Edit Products</a>
                                <a href="#" class="submenu-link"
                                    onclick="toggleVisibility('removeProductsContainer')">Remove Products</a>
                            </div>
                        </div>
                       
                        
                </div>
            </div>
        </div>

     
        <?php
require_once 'User.php'; // Ensure the path is correct


// Create an instance of the User class
$user = new User($servername, $username, $password, $dbname);

// Fetch all users
$allUsers = $user->displayAllUsers();
?>
  

    <div class="container hidden" id="Userview">
        <h2>Users</h2>
        <div id="user-details"></div> 
        <?php if ($allUsers): ?>
                <?php foreach ($allUsers as $userData): ?>
                    <button type="button" class="btn btn-success mb-2" value="<?= $userData['id'] ?>" onclick="getUserData(<?= $userData['id'] ?>)">
                        <?= htmlspecialchars($userData['username']) ?>
                    </button>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No users found.</p>
            <?php endif; ?>
        <button class="btn btn-secondary" onclick="document.getElementById('Userview').classList.add('hidden')">Close</button>
    </div>

       
    

<div class="action-container hidden" id="ViewUserContainer">
    <button class="exit-button" onclick="toggleVisibility('ViewUserContainer')">X</button>
    <h1>WebFit Users</h1>
    <div id="userDetails">
        <img id="viewImage" src="" alt="User Image" style="max-width: 200px;">
        <p><strong>Username:</strong> <span id="viewUsername"></span></p>
        <p><strong>Full Name:</strong> <span id="viewFullName"></span></p>
        <p><strong>Email:</strong> <span id="viewEmail"></span></p>
        <p><strong>Phone:</strong> <span id="viewPhone"></span></p>
        <p><strong>Role:</strong> <span id="viewRole"></span></p>
        <p><strong>Gender:</strong> <span id="viewGender"></span></p>
        <p><strong>Age:</strong> <span id="viewAge"></span></p>
        <p><strong>Address:</strong> <span id="viewAddress"></span></p>
        <p><strong>Subscription:</strong> <span id="viewSubscription"></span></p>
    </div>
</div>


    </div>
</body>



<script src="https://cdn.jsdelivr.net/npm/notyf/notyf.min.js"></script>
<script src="../public/js/Admin-JavaScript.js"></script>

</html>