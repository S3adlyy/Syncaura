<?php

if (!class_exists('questions')) {
    # code...

    class questions
    {
        private ?int $id_question;
        private string $questions;
        private DateTime $date_creation;
        private int $id;
        private string $type;
    
        public function __construct(?int $id_question, string $questions, DateTime $date_creation, int $id, string $type) {
            $this->id_question = $id_question;
            $this->questions = $questions;
            $this->date_creation = $date_creation;
            $this->id = $id;
            $this->type = $type;
        }
    
        // Getters and Setters
        public function getid_question(): ?int {
            return $this->id_question;
        }
        
        public function setid_question(?int $id_question): void {
            $this->id_question = $id_question;
        }
    
        public function getquestions(): ?string {
            return $this->questions;
        }
        
        public function setquestions(?string $questions): void {
            $this->questions = $questions;
        }
    
        // Change this method name to match the call in questionsC
        public function getDateCreation(): ?DateTime {
            return $this->date_creation;
        }
    
        public function setdate_creation(?DateTime $date_creation): void {
            $this->date_creation = $date_creation;
        }
    
        public function getid(): ?int {
            return $this->id;
        }
    
        public function setid(?int $id): void {
            $this->id = $id;
        }
    
        public function gettype(): ?string {
            return $this->type;
        }
    
        public function settype(?string $type): void {
            $this->type = $type;
        }
    }
    
}
?>
