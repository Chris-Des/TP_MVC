<div class="content container">
    <h1 class="mt-5">Formulaire d'inscription</h1>
        <form id="inscriptionForm" action="" method="POST">
            <div class="form-group">
              <label for="username">Nom</label>
              <input type="text" class="form-control" name="username" id="username" required>
              <div id="username-requirements" style="display: none;">
                  <p>
                      <span id="lengthName-requirement">❌</span> Votre nom d'utilisateur doit contenir au moins 5 caractères
                  </p>
              </div>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" class="form-control" name="password" id="password" required>
                <div id="password-requirements" style="display: none;">
                    <p>
                        <span id="uppercase-requirement">❌</span> Une majuscule
                    </p>
                    <p>
                        <span id="number-requirement">❌</span> Un chiffre
                    </p>
                    <p>
                        <span id="special-char-requirement">❌</span> Un caractère spécial
                    </p>
                    <p>
                        <span id="length-requirement">❌</span> Une longueur minimale de 10 caractères
                    </p>
                </div>
            </div>
            <br><br>
            <input type="submit" value="Envoyer" class="btn btn-primary" id="submit" disabled>
        </form>
        <div id="success-message" style="display: none;"></div>
        <div id="error-message" style="display: none;"></div>
    </div>
