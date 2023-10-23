$(document).ready(() => {
  // When the "connexionForm" form is submitted
  $("#connexionForm").submit((event) => {
    event.preventDefault();

    // Get the form data
    const identifier = $("#identifier").val();
    const password = $("#password").val();

    // Client-side validation
    if (!identifier || !password) {
      alert("Veuillez entrer un identifiant et un mot de passe.");
      return;
    }

    // Send the form data via AJAX
    $.ajax({
      type: "GET",
      url: "./controllers/get.php",
      data: {
        identifier,
        password,
      },
      success(response) {
        // Display the server response
        console.log(response);
        alert("Authentification réussie !");
        window.location.href = "?espaceClient";
      },
      error() {
        // Display an error message
        alert("Authentification echouée !");
      },
    });
  });
});