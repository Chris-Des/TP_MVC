<?php
class User {
    private $userId;
    private $nom;
    private $email;
    private $password;
    private $createdAt;

    // Constructor: creates a new User object with the provided name, email, and password
    public function __construct($nom, $email, $password) {
        $this->nom = $nom; // Set the name of the user
        $this->email = $email; // Set the email of the user
        $this->setPassword($password); // Set the password of the user using the setPassword method
        $this->createdAt = date('Y-m-d H:i:s'); // Set the creation date of the user to the current date and time
    }

    // Get the user ID
    public function getUserId() {
        return $this->userId;
    }

    // Get the user's name
    public function getNom() {
        return $this->nom;
    }

    // Set the user's name
    public function setNom($nom) {
        $this->nom = $nom;
    }

    // Get the user's email
    public function getEmail() {
        return $this->email;
    }

    // Set the user's email
    public function setEmail($email) {
        $this->email = $email;
    }

    // Get the user's password
    public function getPassword() {
        return $this->password;
    }

    // Set the user's password
    public function setPassword($password) {
        // Hash the password using PHP's built-in password_hash function
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $this->password = $hashedPassword;
    }

    // Get the user's creation date
    public function getCreatedAt() {
        return $this->createdAt;
    }
}