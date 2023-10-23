<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./src/assets/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="./src/assets/js/router.js"></script>
    <title>Bienvenue</title>
</head>
<body>
    <div class="principal">
        <?php include './view/home/TheHeader.php';?>

        <?php 
            if (isset($_GET['inscription'])) {
                include './view/espace/inscription.php';
                include './controllers/post.php';
            } else if (isset($_GET['connexion'])) {
                include './view/espace/connexion.php';
                include './controllers/get.php';
            } else if (isset($_GET['espaceClient'])) {
                include './view/espace/espace.php';
            } else {
                include './view/home/bienvenue.php';
            }
        ?>

        <?php include './view/home/TheFooter.php';?>
    </div>
    <script src="./src/assets/js/connexion.js"></script>
    <script src="./src/assets/js/inscription.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>