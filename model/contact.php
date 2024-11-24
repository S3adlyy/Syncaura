<?php

if (!class_exists('GContacte')) {
    class GContacte {
        private $id;
        private $name;
        private $email;
        private $message;

        // Constructor
        public function __construct($id, $name, $email, $message) {
            $this->id = $id;
            $this->name = $name;
            $this->email = $email;
            $this->message = $message;
        }

        // Getter for id
        public function getId() {
            return $this->id;
        }

        // Setter for id
        public function setId($id) {
            $this->id = $id;
        }

        // Getter for name
        public function getName() {
            return $this->name;
        }

        // Setter for name
        public function setName($name) {
            $this->name = $name;
        }

        // Getter for type_reclamation
        public function getemail() {
            return $this->email;
        }

        // Setter for type_reclamation
        public function setemail($email) {
            $this->email = $email;
        }

        // Getter for message
        public function getMessage() {
            return $this->message;
        }

        // Setter for message
        public function setMessage($message) {
            $this->message = $message;
        }
    }
}
?>
