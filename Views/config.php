<?php

class config
{
    private static $pdo = null; //static : une seule connexion Ã  la base de donnÃ©es pendant l'exÃ©cution du script

    public static function getConnexion()
    {
        if (!isset(self::$pdo)) { // VÃ©rification de l'existence de la connexion
            try {
                self::$pdo = new PDO( //conserver l'instance unique de la connexion PDO.
                    'mysql:host=localhost;dbname=rayen',
                    'root',
                    '',
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //  Active le mode d'erreur avec exceptions
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // que les colonnes seront accessibles par leur nom
                    ]
                );

                
            } catch (Exception $e) {
                die('Erreur: ' . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}