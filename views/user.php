<?php
class User {
    private $conn;

    // Properties
    private $id;
    private $fullname;
    private $username;
    private $userpassword;
    private $userphone;
    private $useremail;
    private $role;
    private $gender;
    private $age;
    private $address;
    private $img;
    private $subscription;

    // Constructor to initialize the database connection
    public function __construct($servername, $username, $password, $dbname) {
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Method to set user data
    public function setUserData($id, $fullname, $username, $userpassword, $userphone, $useremail, $role, $gender, $age, $address, $img, $subscription) {
        $this->id = $id;
        $this->fullname = $fullname;
        $this->username = $username;
        $this->userpassword = $userpassword;
        $this->userphone = $userphone;
        $this->useremail = $useremail;
        $this->role = $role;
        $this->gender = $gender;
        $this->age = $age;
        $this->address = $address;
        $this->img = $img;
        $this->subscription = $subscription;
    }

    // Method to update user information
    public function updateUser() {
        $stmt = $this->conn->prepare("UPDATE users SET fullname=?, username=?, userpassword=?, userphone=?, useremail=?, role=?, gender=?, age=?, address=?, img=?, subscription=? WHERE id=?");
        $stmt->bind_param("sssssssiissi", $this->fullname, $this->username, $this->userpassword, $this->userphone, $this->useremail, $this->role, $this->gender, $this->age, $this->address, $this->img, $this->subscription, $this->id);
        return $stmt->execute();
    }

    public function displayAllUsers() {
        $sql = "SELECT * FROM users";
        $result = $this->conn->query($sql);

        $users = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }
        return $users;
    }
    
    // Method to view user information by ID
    public function viewUser($id) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // Returns user data as an associative array
    }

    // Method to delete a user by ID
    public function deleteUser($id) {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Method to fetch all users
    public function fetchAllUsers() {
        $result = $this->conn->query("SELECT * FROM users");
        return $result->fetch_all(MYSQLI_ASSOC); // Returns an array of associative arrays
    }

    // Destructor to close the database connection
    public function __destruct() {
        $this->conn->close();
    }
}

