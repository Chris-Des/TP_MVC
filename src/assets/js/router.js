$(document).ready(() => {
  // When the "inscription" button is clicked, redirect to the "inscription.php" page
  $("#inscription").click(() => {
    window.location.href = "?inscription";
  });

  // When the "connexion" button is clicked, redirect to the "connexion.php" page
  $("#connexion").click(() => {
    window.location.href = "?connexion";
  });

  // When the "monSite" link is clicked, prevent the default behavior and redirect to the "/Exercice_AJAX-JQuery/TP_AJAX-JQuery/index.php" page
  $('#monSite').click((event) => {
    event.preventDefault();
    window.location.href = "?acceuil";
  });

  // Select the "Espace Client" button
  $('#espaceClient').click(() => {
    window.location.href = "?espaceClient";
  });
// Sélectionnez le formulaire de déconnexion
const logoutForm = $('#deconnexionForm');

// Lorsque le formulaire de déconnexion est soumis
logoutForm.submit((e) => {
  // Empêcher le comportement par défaut du formulaire
  e.preventDefault();

  // Désactivez le bouton de déconnexion
  $('button[type="submit"]').prop('disabled', true);

  // Déclarez la variable countdown à l'extérieur de la fonction setInterval
  let countdown = 5; // Compte à rebours initial en secondes

  // Affichez le compte à rebours
  const countdownInterval = setInterval(() => {
    // Affichez le message de compte à rebours
    $('#countdownMessage').text(`Vous serez déconnecté dans ${countdown} secondes.`);

    // Décrémentez le compte à rebours
    countdown--;

    // Si le compte à rebours atteint 0, effectuez la déconnexion via AJAX
    if (countdown === 0) {
      clearInterval(countdownInterval); // Arrêtez le compte à rebours

      // Effectuez une requête AJAX vers logout.php
      $.ajax({
        url: './controllers/logout.php',
        type: 'POST',
        success(response) {
          // Déconnexion réussie, effectuer des actions supplémentaires si nécessaire
          // Redirigez vers l'index
          window.location.href = '?acceuil';
        },
        error(XHR, textStatus, errorThrown) {
          // Gérer les erreurs de requête AJAX si nécessaire
          console.log(textStatus, errorThrown);
        }
      });
    }
  }, 1000); // Exécutez toutes les 1000 millisecondes (1 seconde)
});
});