<?php
class UserModel {
    private $db;

    // Constructor to initialize the database connection
    public function __construct($db) {
        $this->db = $db;
    }

    // Function to check if a user already exists by email
    public function emailExists($email) {
        $stmt = $this->db->prepare("SELECT * FROM client WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->rowCount() > 0; // Returns true if email exists
    }

    // Function to check if a user already exists by username
    public function usernameExists($username) {
        $stmt = $this->db->prepare("SELECT * FROM client WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->rowCount() > 0; // Returns true if username exists
    }

    // Function to create a new user in the database
    public function createUser($name, $surname, $username, $email, $password) {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Insert the new user into the database
        $stmt = $this->db->prepare("INSERT INTO client (name, surname, username, email, password, status) 
                                    VALUES (:name, :surname, :username, :email, :password, 1)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':surname', $surname);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->execute();
    }
}
?>
