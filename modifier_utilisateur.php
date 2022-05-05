<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Modifier utilisateur</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/connexion-inscription.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.1.js"></script>

  </head>
  <body>
    <header>
      <img src="images/logo_univ.png">
      <h1>Election d'association</h1>
      <form action="vote.html" method="get">
        <input type="submit" class="retour" name="retour" value="Retour">
      </form>
    </header>

    <h1>Modifier son compte</h1>
    <div id="modif">
      <form action="vote.html" method="post" id="modificationForm">
        <div>

          <div>
            <label for="nom2">Nom</label>
            <input type="text" id="nom2" name="nom2">
          </div>

          <div>
            <label for="prenom2">Prénom</label>
            <input type="text" id="prenom2" name="prenom2">
          </div>

          <div>
            <label for="identifier3">Identifiant</label>
            <input type="text" id="identifier2" name="identifier2">
          </div>

          <div>
            <label for="email2">Email</label>
            <input type="text" id="email2" name="email2">
          </div>

          <div>
						<label for="password4">Mot de passe</label>
						<input type="password" id="password4" name="password4"/>
					</div>

          <div>
						<label for="password5">Nouveau mot de passe</label>
						<input type="password" id="password5" name="password5"/>
					</div>

          <div>
						<label for="password6">Confirmer nouveau mot de passe</label>
						<input type="password" id="password6" name="password6"/>
					</div>

          <div>
					<input type="checkbox" id="condition2" name="condition2"/>
          <label for="condition2">Accepter les conditions d'utilisation.</label>
				</div>

        </div>

        <div>
					<input type="submit" name="submit" id="modifier" value="Modifier"/>
          <span id="error_modification" class ="warning"></span>
				</div
      </form>

    </div>

  </body>
</html>


<script>
  $(document).ready(function() {
    $('#modificationForm').on('submit', function (event) {

      event.preventDefault();

      $.ajax({
        url:"validateModifier.php",
        method:"POST",
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function () {
          $('#modifier').attr('disabled', 'disabled');
        },
        success:function (data) {
          $('#modifier').attr('disabled', false);

          if (data.success) {

            $('#modificationForm')[0].reset();
            $('#error_modification').text('');
            window.location.href = "vote.html";

            }else{
                $('#error_modification').text(data.error_connexion);
            }
          }
      });
    });
  });
</script>
