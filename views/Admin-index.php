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


if (isset($_GET['id'])) {
    $userId = intval($_GET['id']);
    $sql = "SELECT * FROM users WHERE id = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            echo json_encode($user);
        } else {
            echo json_encode(["error" => "User  not found"]);
        }
        
        $stmt->close();
    } else {
        echo json_encode(["error" => "Database error"]);
    }
} else {
    echo json_encode(["error" => "Invalid request"]);
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
                            <a href="#" class="submenu-link" onclick="toggleVisibility('ViewUserContainer'), viewUser()">View User</a>
                            <a href="#" class="submenu-link" onclick="toggleVisibility('editUserContainer'), editUser()">Edit User</a>
                            <a href="#" class="submenu-link" onclick="removeUser()">Remove User</a>

                        </div>
                    </div>
                    <div>
                            <a href="#" class="main-menu-button"
                                onclick="toggleMainMenu('mealsMenu'), toggleVisibility('Mealview')">Meals</a>
                            <div id="mealsMenu" class="submenu">
                                <a href="/user/meal" class="submenu-link">View Meals</a>
                                <a href="#" class="submenu-link" onclick="toggleVisibility('addMealContainer')">Add
                                    Meals</a>
                                <a href="#" class="submenu-link" onclick="toggleVisibility('editMealContainer')">Edit
                                    Meals</a>
                                <a href="#" class="submenu-link"
                                    onclick="toggleVisibility('removeMealContainer')">Remove Meals</a>
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
                        <div>
                            <a href="#" class="main-menu-button"
                                onclick="toggleMainMenu('coachesMenu'), toggleVisibility('Coachview')">Coaches</a>
                            <div id="coachesMenu" class="submenu">
                                <a href="/coaches" class="submenu-link">View Coaches</a>
                                <a href="#" class="submenu-link" onclick="toggleVisibility('addCoachesContainer')">Add
                                    Coaches</a>
                                <a href="#" class="submenu-link" onclick="toggleVisibility('editCoachesContainer')">Edit
                                    Coaches</a>
                                <a href="#" class="submenu-link"
                                    onclick="toggleVisibility('removeCoachesContainer')">Remove Coaches</a>
                            </div>
                        </div>
                        <div>
                            <a href="#" class="main-menu-button"
                                onclick="toggleMainMenu('ExcerciseMenu'), toggleVisibility('Exerciseview')">Exercises</a>
                            <div id="ExcerciseMenu" class="submenu">
                                <a href="/user/front-workout" class="submenu-link">View Exercises</a>
                                <a href="#" class="submenu-link" onclick="toggleVisibility('addExerciseContainer')">Add
                                    Exercises</a>
                                <a href="#" class="submenu-link"
                                    onclick="toggleVisibility('editExerciseContainer')">Edit Exercises</a>
                                <a href="#" class="submenu-link"
                                    onclick="toggleVisibility('removeExerciseContainer')">Remove Exercises</a>
                            </div>
                        </div>
                        
                </div>
            </div>
        </div>

     
        <?php
$users = displayAllUsers();
?>

<div class="container hidden" id="Userview">
    <h2>Users</h2>
    <div id="user-buttons" class="btn-group-vertical">
        <?php foreach ($users as $user) { ?>
            <button type="button" class="btn btn-success mb-2" value="<?= $user['id'] ?>" onclick="getUserData(<?= $user['id'] ?>)">
    <?= htmlspecialchars($user['username']) ?>
</button>
        <?php } ?>
    </div>
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

<div class="action-container hidden" id="editExerciseContainer">
    <button class="exit-button" onclick="toggleVisibility('editExerciseContainer')">X</button>
    <h1>Edit Exercise</h1>
    <form id="editExerciseForm">
        <div class="form-group">
            <label for="editExerciseName">Current Exercise Name:</label>
            <input type="text" id="editExerciseName" name="editExerciseName" required disabled>
            <div id="editExerciseNameError" class="error-message"></div>
        </div>
        <div class="form-group">
            <label for="newExerciseName">New Name:</label>
            <input type="text" id="newExerciseName" name="newExerciseName" required>
            <div id="newExerciseNameError" class="error-message"></div>
        </div>
        <div class="form-group">
            <label for="exercisedescription">Exercise Description:</label>
            <input type="text" id="exercisedescription" name="exercisedescription" required>
        </div>
        <div class="form-group">
            <label for="exerciseimage">Exercise Image URL:</label>
            <input type="text" id="exerciseimage" name="exerciseimage" required>
        </div>
        <button type="submit" class="btn-action">Edit Exercise</button>
        <div id="editExerciseSuccessMessage" class="success-message"></div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/notyf/notyf.min.js"></script>
<script src="../public/js/Admin-JavaScript.js"></script>

</html>