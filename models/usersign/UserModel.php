<?php
class UserModel
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    // Check if email already exists
    public function emailExists(string $email): bool
    {
        try {
            $query = "SELECT COUNT(*) FROM client WHERE email = :email";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            return (int)$stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            error_log("Error checking email existence: " . $e->getMessage());
            return false; // Failsafe to avoid application crash
        }
    }

    // Check if username already exists
    public function usernameExists(string $username): bool
    {
        try {
            $query = "SELECT COUNT(*) FROM client WHERE username = :username";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            return (int)$stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            error_log("Error checking username existence: " . $e->getMessage());
            return false; // Failsafe to avoid application crash
        }
    }

    // Create a new user
    public function createUser(
        string $name,
        string $surname,
        string $username,
        string $email,
        string $password,
        string $phone,
        string $gender,
        string $birthdate,
        ?string $profilePicturePath
    ): bool {
        try {
            $sql = "INSERT INTO client (name, surname, username, email, password, phone, gender, birthdate, profile_picture, status) 
        VALUES (:name, :surname, :username, :email, :password, :phone, :gender, :birthdate, :profile_picture, 1)";
$stmt = $this->db->prepare($sql);

$stmt->bindParam(':name', $name);
$stmt->bindParam(':surname', $surname);
$stmt->bindParam(':username', $username);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $password);
$stmt->bindParam(':phone', $phone);
$stmt->bindParam(':gender', $gender);
$stmt->bindParam(':birthdate', $birthdate);
$stmt->bindParam(':profile_picture', $profile_picture);



    
            // Use bindValue for profile_picture as it is a literal value
            $stmt->bindValue(':profile_picture', "../../" . $profilePicturePath);
    
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error creating user: " . $e->getMessage());
            return false; // Failsafe to avoid application crash
        }
    }
    
}
?>
