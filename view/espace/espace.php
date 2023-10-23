<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
  // Redirigez l'utilisateur vers la page d'accueil
  header('Location: /TP_MVC');
  exit(); // Assurez-vous de terminer le script après la redirection
}
?>
    <h1 class="text-center">Espace utilisateur</h1>
    <p class="text-center">Bienvenue sur votre espace utilisateur.</p>
    <div class="text-center">
        <p>Nom d'utilisateur : <?php echo $_SESSION['username']; ?></p>
        <p>Email : <?php echo $_SESSION['email']; ?></p>
        <p>Mot de passe : <?php echo $_SESSION['password_hash']; ?></p>
        <p>Compte créé le : <?php echo $_SESSION['created_at']; ?></p>

        <form action="/controllers/logout.php" method="post">
            <button type="submit" class="btn btn-primary">Déconnexion</button>
        </form>
    </div>
    <p id="countdownMessage"></p>
