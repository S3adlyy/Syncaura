<?php
// Ensure the Config class is only defined once
if (!class_exists('Config')) {
    class Config {
        private static $pdo = null;

        // Method to get the database connection
        public static function getConnexion() {
            // Check if the connection already exists
            if (self::$pdo === null) {
                // Database connection parameters
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "forum";

                try {
                    // Establish the PDO connection
                    self::$pdo = new PDO(
                        "mysql:host=$servername;dbname=$dbname",
                        $username,
                        $password,
                        [
                            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                        ]
                    );
                } catch (Exception $e) {
                    // Handle connection failure
                    die('Erreur de connexion: ' . $e->getMessage());
                }
            }
            return self::$pdo; // Return the existing connection
        }
    }
}

// Call the getConnexion method to initialize the connection
Config::getConnexion();
?>
