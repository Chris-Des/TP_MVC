$(document).ready(() => {
  if (!window.location.href.includes("?inscription")) {
    return;
  }
  const emailField = $("#email"); // Field for email input
  const passwordField = $("#password"); // Field for password input
  const usernameField = $("#username"); // Field for username input
  const submitButton = $("#submit"); // Submit button

  // Function to check if an email is valid
  function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    // ^ : Début de la chaîne.
    // [^\s@]+ : Correspond à une ou plusieurs occurrences de caractères qui ne sont ni des espaces ni des symboles @. Cela garantit qu'il y a au moins un caractère avant le symbole @ dans l'adresse e-mail.
    // @ : Correspond au symbole @.
    // [^\s@]+ : Correspond à une ou plusieurs occurrences de caractères qui ne sont ni des espaces ni des symboles @. Cela garantit qu'il y a au moins un caractère entre le symbole @ et le point dans l'adresse e-mail.
    // \. : Correspond à un point (.) littéral. Il doit être échappé avec un backslash () car le point a une signification spéciale dans les expressions régulières.
    // [^\s@]+ : Correspond à une ou plusieurs occurrences de caractères qui ne sont ni des espaces ni des symboles @. Cela garantit qu'il y a au moins un caractère après le point dans l'adresse e-mail.
    // $ : Fin de la chaîne.
    return emailRegex.test(email);
  }

  // Function to check if a username is valid
  function isValidUsername(username) {
    return username.length >= 5;
  }

  // Function to check the form validity
  function checkFormValidity() {
    const email = emailField.val(); // Get the value of the email field
    const password = passwordField.val(); // Get the value of the password field
    const username = usernameField.val(); // Get the value of the username field

    const isEmailValid = isValidEmail(email); // Check if the email is valid
    const isPasswordValid =
      /(?=.*[A-Z])/.test(password) &&
      /(?=.*\d)/.test(password) &&
      /(?=.*[!@#$%^&*()])/.test(password) &&
      password.length >= 10; // Check if the password is valid
    const isUsernameValid = isValidUsername(username); // Check if the username is valid

    if (isEmailValid && isPasswordValid && isUsernameValid) {
      submitButton.prop("disabled", false); // Enable the submit button
    } else {
      submitButton.prop("disabled", true); // Disable the submit button
    }
  }

  // Event listener for the email field input
  emailField.on("input", () => {
    const email = emailField.val(); // Get the value of the email field
    checkFormValidity(); // Check the form validity
  });

  // Event listener for the password field input
  passwordField.on("input", () => {
    const password = passwordField.val(); // Get the value of the password field
    updatePasswordRequirements(password); // Update the password requirements display
    checkFormValidity(); // Check the form validity
  });

  // Event listener for the username field input
  usernameField.on("input", () => {
    const username = usernameField.val(); // Get the value of the username field
    updateUsernameRequirements(username); // Update the username requirements display
    checkFormValidity(); // Check the form validity
  });

  function updateUsernameRequirements(username) {
    const lengthRequirement = $("#lengthName-requirement");

    if (username.length >= 5) {
      lengthRequirement.text("✅"); // Display a checkmark if the username meets the length requirement
      $("#username-requirements").css("display", "flex"); // Show the username requirements container
    } else {
      $("#username-requirements").css("display", "flex"); // Show the username requirements container
      lengthRequirement.text("❌"); // Display a cross mark if the username does not meet the length requirement
    }
  }

  function updatePasswordRequirements(password) {
    const uppercaseRequirement = $("#uppercase-requirement");
    const numberRequirement = $("#number-requirement");
    const specialCharRequirement = $("#special-char-requirement");
    const lengthRequirement = $("#length-requirement");

    if (/(?=.*[A-Z])/.test(password)) {
      $("#password-requirements").css("display", "flex"); // Show the password requirements container
      uppercaseRequirement.text("✅"); // Display a checkmark if the password contains an uppercase letter
    } else {
      $("#password-requirements").css("display", "flex"); // Show the password requirements container
      uppercaseRequirement.text("❌"); // Display a cross mark if the password does not contain an uppercase letter
    }

    // /(?=.*[A-Z])/.test(password) : Cette expression régulière vérifie si le mot de passe contient au moins une lettre majuscule.
    // (?=.*[A-Z]) est appelé un "positive lookahead" qui vérifie si la chaîne contient une lettre majuscule sans consommer les caractères suivants.

    if (/(?=.*\d)/.test(password)) {
      $("#password-requirements").css("display", "flex"); // Show the password requirements container
      numberRequirement.text("✅"); // Display a checkmark if the password contains a number
    } else {
      $("#password-requirements").css("display", "flex"); // Show the password requirements container
      numberRequirement.text("❌"); // Display a cross mark if the password does not contain a number
    }

    // /(?=.*\d)/.test(password) : Cette expression régulière vérifie si le mot de passe contient au moins un chiffre.
    // (?=.*\d) est également un "positive lookahead" qui vérifie si la chaîne contient un chiffre sans consommer les caractères suivants.

    if (/(?=.*[!@#$%^&*()])/.test(password)) {
      $("#password-requirements").css("display", "flex"); // Show the password requirements container
      specialCharRequirement.text("✅"); // Display a checkmark if the password contains a special character
    } else {
      $("#password-requirements").css("display", "flex"); // Show the password requirements container
      specialCharRequirement.text("❌"); // Display a cross mark if the password does not contain a special character
    }

    // /(?=.*[!@#$%^&*()])/.test(password) : Cette expression régulière vérifie si le mot de passe contient au moins un caractère spécial parmi les symboles !@#$%^&*().
    // (?=.*[!@#$%^&*()]) est encore un "positive lookahead" qui vérifie si la chaîne contient un de ces caractères spéciaux sans consommer les caractères suivants.

    if (password.length >= 10) {
      $("#password-requirements").css("display", "flex"); // Show the password requirements container
      lengthRequirement.text("✅"); // Display a checkmark if the password meets the length requirement
    } else {
      $("#password-requirements").css("display", "flex"); // Show the password requirements container
      lengthRequirement.text("❌"); // Display a cross mark if the password does not meet the length requirement
    }

    const isPasswordValid =
      /(?=.*[A-Z])/.test(password) &&
      /(?=.*\d)/.test(password) &&
      /(?=.*[!@#$%^&*()])/.test(password) &&
      password.length >= 10;

    if (isPasswordValid) {
      submitButton.prop("disabled", false); // Enable the submit button if the password is valid
    } else {
      submitButton.prop("disabled", true); // Disable the submit button if the password is not valid
    }
  }

  checkFormValidity(); // Appeler la fonction pour vérifier la validité du formulaire au chargement de la page

  $("#inscriptionForm").submit((event) => {
    event.preventDefault();

    const username = $("#username").val();
    const email = $("#email").val();
    const password = $("#password").val();

    if (!isValidEmail(email)) {
      // Afficher un message d'erreur
      // Show an error message
      alert("Veuillez entrer une adresse email valide.");
      // Annuler l'envoi du formulaire
      // Cancel the form
      return;
    }

    // Envoyer les données du formulaire via AJAX
    // Send the form data to the server
    $.ajax({
      type: "POST",
      url: "./controllers/post.php",
      data: {
        username,
        email,
        password,
      },
      dataType: "json",
      /**
       * Display the server response.
       * Afficher la réponse du serveur
       *
       * @param {any} response - the server response. La réponse du serveur
       *
       */
      success: (response) => {
        console.log(response);
        if (response.success === true) {
          // Afficher le message de réussite
          // Show a success message
          $("#success-message").css("display", "block");
          $("#success-message").text(response.message);
          // Rediriger vers la page de connexion
          // Redirect to the login page
          setTimeout(() => {
            window.location.href = "?connexion";
          }, 3000);
          return;
        }

        $("#error-message").css("display", "block");
        $("#error-message").text(response.message);
      },
      /**
       * Display the server response.
       * Afficher la réponse du serveur
       *
       * @param {any} response - the response from the server. La réponse du serveur
       */
      error: (xhr, status, error, response) => {
        // Afficher la réponse du serveur
        console.log(
          `${xhr.responseText} ${status} ${error} `,
        );
        // Afficher le message d'erreur
        // Show an error message
        $("#error-message").css("display", "block");
        $("#error-message").text(response);
      },
    });
  });
});
