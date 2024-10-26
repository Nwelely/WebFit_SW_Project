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
                            <a href="#" class="submenu-link" onclick="toggleVisibility('removeUserContainer'), removeUser()">Remove User</a>
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
            <button type="button" class="btn btn-success mb-2" value="<?= $user['id'] ?>" onclick="selectUser('<?= $user['id'] ?>')">
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
<div class="action-container hidden" id="removeCoachesContainer">
    <button class="exit-button" onclick="toggleVisibility('removeCoachesContainer')">X</button>
    <h1>Remove Coaches</h1>
    <form id="removeCoachForm" enctype="multipart/form-data">
        <div class="form-group">
            <label for="removeCoachName">Coach Name:</label>
            <input type="text" id="removeCoachName" name="removeCoachName" required disabled>
            <div id="removeCoachNameError" class="error-message"></div>
        </div>
        <button type="submit" class="btn-action">Remove Coach</button>
        <div id="removeCoachSuccessMessage" class="success-message"></div>
    </form>
</div>

<div class="action-container hidden" id="editCoachesContainer">
    <button class="exit-button" onclick="toggleVisibility('editCoachesContainer')">X</button>
    <h1>Edit Coaches</h1>
    <form id="editCoachForm" enctype="multipart/form-data">
        <div class="form-group">
            <label for="editCoachName">Coach Name:</label>
            <input type="text" id="editCoachName" name="editCoachName" required disabled>
            <div id="editCoachNameError" class="error-message"></div>
        </div>
        <div class="form-group">
            <label for="newCoachName">New Name:</label>
            <input type="text" id="newCoachName" name="newCoachName" required>
            <div id="newCoachNameError" class="error-message"></div>
        </div>
        <div class="form-group">
            <label for="newCoachDescription">New Description:</label>
            <input type="text" id="newCoachDescription" name="coachDescription" required>
            <div id="newCoachSpecialtyError" class="error-message"></div>
        </div>
        <div class="form-group">
            <label for="editCoachImage">Coach Image:</label>
            <input type="file" id="editCoachImage" name="coachImage" accept="image/*">
        </div>
        <button type="submit" class="btn-action">Edit Coach</button>
        <div id="editCoachSuccessMessage" class="success-message"></div>
    </form>
</div>

<!-- Meal Buttons -->
<div class="container hidden" id="Mealview">
    <h2>Meals</h2>
    <div id="meal-buttons" class="btn-group-vertical">
        <?php foreach ($data['meals'] as $meal): ?>
            <button type="button" class="btn btn-success mb-2" value="<?= $meal['_id'] ?>" onclick="selectMeal('<?= $meal['_id'] ?>')">
                <?= htmlspecialchars($meal['mealname']) ?>
            </button>
        <?php endforeach; ?>
    </div>
</div>

<div class="action-container hidden" id="addMealContainer">
    <button class="exit-button" onclick="toggleVisibility('addMealContainer')">X</button>
    <h1>Add Meal</h1>
    <form id="addMealForm">
        <div class="form-group">
            <label for="mealname">Meal Name:</label>
            <input type="text" id="mealname" name="mealname" required>
        </div>
        <div class="form-group">
            <label for="mealdescription">Meal Description:</label>
            <input type="text" id="mealdescription" name="mealdescription" required>
        </div>
        <div class="form-group">
            <label>Ingredients:</label>
            <div id="ingredientsContainer">
                <div class="ingredient-group">
                    <input type="text" name="ingredients[0][name]" placeholder="Ingredient Name" required>
                    <input type="text" name="ingredients[0][quantity]" placeholder="Quantity" required>
                    <button type="button" class="remove-button" onclick="removeIngredient(this)">-</button>
                </div>
            </div>
            <button type="button" id="ingButton" onclick="addIngredient()">Add Ingredient</button>
        </div>
        <button type="submit" class="btn-action">Add Meal</button>
        <div id="MealSuccessMessage" class="success-message"></div>
    </form>
</div>

<div class="action-container hidden" id="removeMealContainer">
    <button class="exit-button" onclick="toggleVisibility('removeMealContainer')">X</button>
    <h1>Remove Meal</h1>
    <form id="removeMealForm">
        <div class="form-group">
            <label for="removeMealName">Meal Name:</label>
            <input type="text" id="removeMealName" name="removeMealName" required disabled>
            <div id="removeMealNameError" class="error-message"></div>
        </div>
        <button type="submit" class="btn-action">Remove Meal</button>
        <div id="removeMealSuccessMessage" class="success-message"></div>
    </form>
</div>

<div class="action-container hidden" id="editMealContainer">
    <button class="exit-button" onclick="toggleVisibility('editMealContainer')">X</button>
    <h1>Edit Meal</h1>
    <form id="editMealForm">
        <div class="form-group">
            <label for="editMealName">Meal Name:</label>
            <input type="text" id="editMealName" name="editMealName" required disabled>
            <div id="editMealNameError" class="error-message"></div>
        </div>
        <div class="form-group">
            <label for="newMealName">New Name:</label>
            <input type="text" id="newMealName" name="newMealName" required>
            <div id="newMealNameError" class="error-message"></div>
        </div>
        <div class="form-group">
            <label for="newMealDescription">New Description:</label>
            <input type="text" id="newMealDescription" name="newMealdescription" required>
            <div id="newMealDescriptionError" class="error-message"></div>
        </div>
        <div class="form-group">
            <label>New Ingredients:</label>
            <div id="newIngredientsContainer">
                <div class="ingredient-group">
                    <input type="text" name="newIngredients[0][name]" placeholder="Ingredient Name" required>
                    <input type="text" name="newIngredients[0][quantity]" placeholder="Quantity" required>
                    <button type="button" class="remove-button" onclick="removeIngredient(this)">-</button>
                </div>
            </div>
            <button type="button" id="ingButton" onclick="addNewIngredient()">Add Ingredient</button>
        </div>
        <button type="submit" class="btn-action">Edit Meal</button>
        <div id="editMealSuccessMessage" class="success-message"></div>
    </form>
</div>

<!-- Exercise Buttons -->
<div class="container hidden" id="Exerciseview">
    <h2>Exercises</h2>
    <div id="exercise-buttons" class="btn-group-vertical">
        <?php foreach ($data['exercises'] as $exercise): ?>
            <button type="button" class="btn btn-success mb-2" value="<?= $exercise['_id'] ?>" onclick="selectExercise('<?= $exercise['_id'] ?>')">
                <?= htmlspecialchars($exercise['exercisename']) ?>
            </button>
        <?php endforeach; ?>
    </div>
</div>

<div class="action-container hidden" id="addExerciseContainer">
    <button class="exit-button" onclick="toggleVisibility('addExerciseContainer')">X</button>
    <h1>Add Exercise</h1>
    <form id="addExerciseForm">
        <div class="form-group">
            <label for="Exercisename">Exercise Name:</label>
            <input type="text" id="Exercisename" name="Exercisename" required>
        </div>
        <div class="form-group">
            <label for="Exercisedescription">Exercise Description:</label>
            <input type="text" id="Exercisedescription" name="Exercisedescription" required>
        </div>
        <div class="form-group">
            <label for="Exerciseimage">Exercise Image URL:</label>
            <input type="text" id="Exerciseimage" name="Exerciseimage" required>
        </div>
        <div class="form-group">
            <label for="Exercisetype">Exercise Type:</label>
            <select id="Exercisetype" name="Exercisetype" required>
                <option value="push">Push</option>
                <option value="pull">Pull</option>
                <option value="leg">Leg</option>
                <option value="free">Free</option>
            </select>
        </div>
        <button type="submit" class="btn-action">Add Exercise</button>
        <div id="ExerciseSuccessMessage" class="success-message"></div>
    </form>
</div>

<div class="action-container hidden" id="removeExerciseContainer">
    <button class="exit-button" onclick="toggleVisibility('removeExerciseContainer')">X</button>
    <h1>Remove Exercise</h1>
    <form id="removeExerciseForm">
        <div class="form-group">
            <label for="removeExerciseName">Exercise Name:</label>
            <input type="text" id="removeExerciseName" name="removeExerciseName" required disabled>
            <div id="removeExerciseNameError" class="error-message"></div>
        </div>
        <button type="submit" class="btn-action">Remove Exercise</button>
        <div id="removeExerciseSuccessMessage" class="success-message"></div>
    </form>
</div>

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