<?php
require dirname(__DIR__) . '/src/assets/db/login.php';
require dirname(__DIR__) . '/model/user.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $emailRegex = '/^[^\s@]+@[^\s@]+\.[^\s@]+$/';
    $passwordRegex = '/^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()]).{10,}$/';
    $usernameMinLength = 5;


    if (!preg_match($emailRegex, $email)) {
        $response = (object) [
            'success' => false,
            'message' => 'Veuillez entrer une adresse email valide.'
        ];
        echo json_encode($response);
        exit;
    }

    if (!preg_match($passwordRegex, $password)) {
        $response = (object) [
            'success' => false,
            'message' => 'Le mot de passe doit contenir au moins une lettre majuscule, un chiffre, un caractère spécial et avoir une longueur minimale de 10 caractères.'
        ];
        echo json_encode($response);
        exit;
    }

    if (strlen($nom) < $usernameMinLength) {
        $response = (object) [
            'success' => false,
            'message' => 'Votre nom d\'utilisateur doit contenir au moins ' . $usernameMinLength . ' caractères.'
        ];
        echo json_encode($response);
        exit;
    }

    try {
        $checkEmailSql = "SELECT COUNT(*) FROM user WHERE email = :email;";
        $checkEmailStmt = $pdo->prepare($checkEmailSql);
        $checkEmailStmt->execute([
            ':email' => $email
        ]);
        $emailExists = $checkEmailStmt->fetchColumn();

        if ($emailExists) {
            $response = (object) [
                'success' => false,
                'message' => 'Un compte avec cette adresse email existe déjà.'
            ];
            echo json_encode($response);
            exit;
        }

        $checkUsernameSql = "SELECT COUNT(*) FROM user WHERE username = :username;";
        $checkUsernameStmt = $pdo->prepare($checkUsernameSql);
        $checkUsernameStmt->execute([
            ':username' => $nom
        ]);
        $usernameExists = $checkUsernameStmt->fetchColumn();

        if ($usernameExists) {
            $response = (object) [
                'success' => false,
                'message' => 'Ce nom d\'utilisateur est déjà utilisé.'
            ];
            echo json_encode($response);
            exit;
        }

            // Créer une instance de la classe User
            $user = new User($nom, $email, $password);
        
            // Utiliser les méthodes pour obtenir les valeurs de l'utilisateur
            $user->setNom($nom);
            $user->setEmail( $email );
            $user->setPassword($password);
        
        
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
            $insertSql = "INSERT INTO user (username, email, password_hash) VALUES (:username, :email, :password_hash);";
            $insertStmt = $pdo->prepare($insertSql);
            $insertStmt->execute([
                ':username' => $nom,
                ':email' => $email,
                ':password_hash' => $hashedPassword
            ]);
        
            $response = (object) [
                'success' => true,
                'message' => 'Inscription réussie !'
            ];
            echo json_encode($response);
            exit;
        } catch (PDOException $e) { 
            $response = (object) [
                'success' => false,
                'message' => 'Une erreur s\'est produite. Veuillez réessayer.'
            ];
            echo json_encode($response);
            var_dump($e);
            exit;
        }
    }