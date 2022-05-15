
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
      <form action="vote.php" method="get">
        <input type="submit" class="retour" name="retour" value="Retour">
      </form>
    </header>

    <h1>Modifier son compte</h1>
    <div id="modif">

      <form action="vote.php" method="post" id="modificationForm">
        <div>

          <div>
            <span>Vous pouvez grader les infos que vous souhaitez garder en laissant leur place vide</span>
          </div>

          <div>
            <label for="identifier3">Identifiant</label>
            <span id="idtext" class ="warning"></span>
          </div>

          <div>
            <label for="nom2">Nom</label>
            <input type="text" id="nom2" name="nom2">
            <span id="error_nom" class ="warning"></span>

          </div>

          <div>
            <label for="prenom2">Prénom</label>
            <input type="text" id="prenom2" name="prenom2">
            <span id="error_prenom" class ="warning"></span>

          </div>

          <div>
            <label for="email2">Email</label>
            <input type="text" id="email2" name="email2">
            <span id="error_email" class ="warning"></span>

          </div>


          <div>
						<label for="password5">Nouveau mot de passe</label>
						<input type="password" id="password5" name="password5"/>
            <span id="error_password5" class ="warning"></span>
					</div>

          <div>
						<label for="password6">Confirmer nouveau mot de passe</label>
						<input type="password" id="password6" name="password6"/>
            <span id="error_password6" class ="warning"></span>
					</div>

          <div>

						<label for="password4">Mot de passe</label>
						<input type="password" id="password4" name="password4"/>
            <span id="error_password4" class ="warning"></span>
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
            $('#error_password4').text('');
            $('#error_password5').text('');
            $('#error_password6').text('');
            $('#error_modification').text('');
            window.location.href = "vote.php";

            }else{
              $('#idtext').text(data.id);
              $('#error_nom').text(data.error_nom);
              $('#error_prenom').text(data.error_prenom);
              $('#error_email').text(data.error_email);
              $('#error_password4').text(data.error_password4);
              $('#error_password5').text(data.error_password5);
              $('#error_password6').text(data.error_password6);
              $('#error_modification').text(data.error_modification);
            }
          }
      });
    });
  });
</script>
