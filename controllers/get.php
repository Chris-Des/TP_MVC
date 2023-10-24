<?php
session_start();

require dirname(__DIR__) . '/src/assets/db/login.php';
require dirname(__DIR__) . '/model/user.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $identifier = $_GET['identifier'];
    $password = $_GET['password'];

    if (!empty($identifier) && !empty($password)) {
        $stmt = $pdo->prepare("SELECT * FROM user WHERE username = :identifier1 OR email = :identifier2");
        $stmt->execute([':identifier1' => $identifier, ':identifier2' => $identifier]);

        $userResult = $stmt->fetch();

        if ($stmt->rowCount() === 0) {
            echo json_encode(['message' => 'L\'utilisateur' . $identifier . ' n\'existe pas.']);
            exit;
        }

        if ($userResult && password_verify($password, $userResult['password_hash'])) {
            $user = new User($userResult['username'], $userResult['email'], $userResult['password_hash'], $userResult['created_at']);

            $nom = $user->getNom();
            $email = $user->getEmail();
            $password = $user->getPassword();
            $createdAt = $user->getCreatedAt();

            $_SESSION['username'] = $nom;
            $_SESSION['email'] = $email;
            $_SESSION['password_hash'] = $password;
            $_SESSION['created_at'] = $createdAt;

            exit();
        } else {
            echo json_encode(['message' => 'Incorrect username or password. Please check your information.']);
        }
    } else {
        echo json_encode(['message' => 'Please enter your username or email and your password.']);
    }
}