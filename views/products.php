<?php
class DB {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "sw_project";
    public $conn;

    function __construct() {
        $this->conn = $this->connectDB();
    }

    function connectDB() {
        $conn = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        return $conn;
    }
}

class Product {
    public $id;
    public $name;
    public $image;
    public $Price;
    public $options;

    // Constructor to initialize Product instance based on row data
    function __construct($row) {
        $this->id = $row['id'];
        $this->name = $row['productname'];
        $this->image = $row['img'];
        $this->Price = (float) $row['price'];
        $this->options = $row['options'] ?? null;
    }

    // Method to fetch all products as instances of Product
    public static function getAllProducts() {
        $db_handle = new DB();
        $sql = "SELECT * FROM products"; // Ensure the table name is correct
        $result = mysqli_query($db_handle->conn, $sql);
        $products = [];

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $products[] = new Product($row);
            }
        }
        return $products;
    }
}
