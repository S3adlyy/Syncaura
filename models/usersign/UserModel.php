<?php
class UserModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Check if email already exists
    public function emailExists($email)
    {
        $query = "SELECT COUNT(*) FROM client WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // Check if username already exists
    public function usernameExists($username)
    {
        $query = "SELECT COUNT(*) FROM client WHERE username = :username";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // Create a new user
    public function createUser($name, $surname, $username, $email, $hashedPassword, $phone, $gender, $birthdate)
    {
        $query = "INSERT INTO client (name, surname, username, email, password, phone, gender, birthdate, role, status) 
                  VALUES (:name, :surname, :username, :email, :password, :phone, :gender, :birthdate, 0, 1)"; // 0 = regular user, 1 = active
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':surname', $surname);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':gender', $gender); // Assuming gender is stored as 1 (male) or 0 (female)
        $stmt->bindParam(':birthdate', $birthdate);
        $stmt->execute();
    }
}
?>
