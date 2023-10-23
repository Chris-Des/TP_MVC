<?php
session_start(); // Start the session to store session information

require dirname(__DIR__) . '/src/assets/db/login.php'; // Include the database connection file
require dirname(__DIR__) . '/model/user.php'; // Include the file containing the User class definition

if ($_SERVER['REQUEST_METHOD'] === 'GET') { // Check if the request method is GET
    $identifier = $_GET['identifier']; // Get the value of the "identifier" parameter from the GET request
    $password = $_GET['password']; // Get the value of the "password" parameter from the GET request

    if (!empty($identifier) && !empty($password)) { // Check if the "identifier" and "password" parameters are not empty
        $stmt = $pdo->prepare("SELECT * FROM user WHERE username = :identifier1 OR email = :identifier2"); // Prepare a SQL query to retrieve the user matching the provided identifier (either username or email)
        $stmt->execute([':identifier1' => $identifier, ':identifier2' => $identifier]); // Execute the query with the parameter values

        $user = $stmt->fetch(); // Fetch the first row of the query result

        // Check if a user is found and the password matches
        if ($user && password_verify($password, $user['password_hash'])) {
            $nom = $user['username']; // Get the username of the found user
            $email = $user['email']; // Get the email of the found user
            $password = $user['password_hash']; // Get the password hash of the found user
            $createdAt = $user['created_at']; // Get the account creation date of the found user

            $_SESSION['username'] = $nom; // Store the username in the 'username' session variable
            $_SESSION['email'] = $email; // Store the email in the 'email' session variable
            $_SESSION['password_hash'] = $password; // Store the password hash in the 'password_hash' session variable
            $_SESSION['created_at'] = $createdAt; // Store the account creation date in the 'created_at' session variable

            exit(); // Terminate the script execution
        } else {
            echo json_encode(['message' => 'Incorrect username or password. Please check your information.']); // Display an error message in JSON format if the authentication failed
        }
    } else {
        echo json_encode(['message' => 'Please enter your username or email and your password.']); // Display an error message in JSON format if the parameters are missing
    }
}