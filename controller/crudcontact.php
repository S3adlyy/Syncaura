<?php

include 'C:\xampp\htdocs\Crud Doudou\doudou\config.php'; // Utilisation de include_once pour éviter les inclusions multiples

// Utilisez un chemin relatif pour éviter les dépendances à un chemin absolu
include 'C:\xampp\htdocs\Crud Doudou\doudou\model\contact.php'; // Assurez-vous que le chemin est correct selon votre structure

if (!class_exists('GContacteC')) {
    class GContacteC
    {
        private $pdo;

        // Constructeur accepte un objet PDO pour interagir avec la base de données
        public function __construct($pdo) {
            $this->pdo = $pdo;
        }

        // Ajouter un contact
        public function ajouterContact(GContacte $contact) {
            try {
                // Valider les champs d'entrée
                if (empty($contact->getName()) || empty($contact->getemail()) || empty($contact->getMessage())) {
                    throw new Exception("Tous les champs doivent être remplis.");
                }
        
                // Préparer la requête SQL pour insérer un contact
                $sql = "INSERT INTO gcontacte (name, email, message) VALUES (:name, :email, :message)";
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindValue(':name', $contact->getName());
                $stmt->bindValue(':email', $contact->getemail());
                $stmt->bindValue(':message', $contact->getMessage());
        
                // Exécuter la requête et retourner le résultat
                $success = $stmt->execute();
                
                // Vérification si l'exécution a réussi
                if ($success) {
                    return true;
                } else {
                    // Ajouter un log ou une sortie ici pour déboguer
                    error_log("Erreur lors de l'exécution de la requête : " . implode(",", $stmt->errorInfo()));
                    return false;
                }
            } catch (PDOException $e) {
                // Loguer les exceptions PDO
                error_log("Erreur PDO: " . $e->getMessage()); 
                return false;
            } catch (Exception $e) {
                // Loguer les autres exceptions
                error_log("Erreur: " . $e->getMessage()); 
                return false;
            }
        }
        

        // Afficher tous les contacts
        public function afficherContacts() {
            try {
                // Préparer et exécuter la requête pour récupérer tous les contacts
                $sql = "SELECT * FROM gcontacte";
                $stmt = $this->pdo->query($sql);

                // Retourner tous les enregistrements récupérés
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                // Loguer les erreurs PDO
                error_log("Erreur PDO: " . $e->getMessage()); 
                return [];
            }
        }

        public function afficherContactParId($id) {
            // Préparer la requête SQL
            $stmt = $this->pdo->prepare("SELECT * FROM contacts WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            
            // Vérifier si un contact existe avec l'ID donné
            $contact = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$contact) {
                return false; // Aucun contact trouvé
            }
            return $contact;
        }
                

        // Modifier un contact
        public function modifierContact(GContacte $contact, $id) {
            try {
                // Valider les champs d'entrée
                if (empty($contact->getName()) || empty($contact->getemail()) || empty($contact->getMessage())) {
                    throw new Exception("Tous les champs doivent être remplis.");
                }

                // Valider l'ID avant la mise à jour
                if (!is_numeric($id) || $id <= 0) {
                    throw new Exception("ID de contact invalide.");
                }

                // Préparer la requête de mise à jour
                $sql = "UPDATE gcontacte SET name = :name, email = :email, message = :message WHERE id = :id";
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindValue(':name', $contact->getName());
                $stmt->bindValue(':email', $contact->getemail());
                $stmt->bindValue(':message', $contact->getMessage());
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);

                // Exécuter la requête de mise à jour
                return $stmt->execute();
            } catch (PDOException $e) {
                // Loguer les erreurs PDO
                error_log("Erreur PDO: " . $e->getMessage()); 
                return false;
            } catch (Exception $e) {
                // Loguer les autres exceptions
                error_log("Erreur: " . $e->getMessage()); 
                return false;
            }
        }

        // Supprimer un contact par ID
        public function supprimerContact($id) {
            try {
                // Valider l'ID du contact avant suppression
                if (!is_numeric($id) || $id <= 0) {
                    throw new Exception("ID de contact invalide.");
                }

                // Préparer la requête de suppression
                $sql = "DELETE FROM gcontacte WHERE id = :id";
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);

                // Exécuter la requête de suppression
                return $stmt->execute();
            } catch (PDOException $e) {
                // Loguer les erreurs PDO
                error_log("Erreur PDO: " . $e->getMessage()); 
                return false;
            } catch (Exception $e) {
                // Loguer les autres exceptions
                error_log("Erreur: " . $e->getMessage()); 
                return false;
            }
        }
    }
}

?>
