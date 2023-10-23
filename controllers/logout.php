<?php
session_unset(); // Unset all session variables

session_destroy(); // Destroy all session data

header('Location: \Exercice_AJAX-JQuery\TP_AJAX-JQuery\index.php'); // Redirect the user to the specified location

exit(); // Terminate the script execution
?>