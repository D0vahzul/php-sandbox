<?php
// Define a User class
class User {
    // Properties (attributes)
    private $id;
    private $username;
    private $email;
    private $created_at;

    // Constructor - runs when an object is created
    public function __construct($username, $email) {
        $this->id = uniqid(); // Generate a unique ID
        $this->username = $username;
        $this->email = $email;
        $this->created_at = date('Y-m-d H:i:s');
    }

    // Getters - methods to access private properties
    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    // Setters - methods to modify private properties
    public function setUsername($username) {
        // Validate username
        if (strlen($username) < 3) {
            throw new Exception("Username must be at least 3 characters");
        }
        $this->username = $username;
    }

    public function setEmail($email) {
        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format");
        }
        $this->email = $email;
    }

    // Method to display user information
    public function displayInfo() {
        return "User: {$this->username} (ID: {$this->id})<br>
                Email: {$this->email}<br>
                Created: {$this->created_at}";
    }

    // Static method (belongs to the class, not objects)
    public static function validatePassword($password) {
        // Password must be at least 8 characters with letters and numbers
        return (strlen($password) >= 8 &&
                preg_match('/[A-Za-z]/', $password) &&
                preg_match('/[0-9]/', $password));
    }
}

// Usage example
try {
    // Create a new user
    $user1 = new User("johndoe", "john@example.com");

    // Display user information
    echo $user1->displayInfo();
    echo "<br><br>";

    // Change username
    $user1->setUsername("john_doe");
    echo "Username changed to: " . $user1->getUsername();
    echo "<br><br>";

    // Try to set an invalid email
    try {
        $user1->setEmail("invalid-email");
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        echo "<br><br>";
    }

    // Use static method to validate a password
    $password = "pass123";
    if (User::validatePassword($password)) {
        echo "Password is valid";
    } else {
        echo "Password is invalid. It must be at least 8 characters and contain both letters and numbers.";
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>