<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Election : Connexion</title>
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
      <form action="index.html" method="get">
        <input type="submit" class="retour" name="retour" value="Retour">
      </form>
    </header>
    <h1>Connexion</h1>
    <div id="connect">
      <form action="vote.php" method="post" id="connectionForm">
        <div>

          <div >
            <center>Pour vous connecter en tant qu'administrateur, veuillez entrer le code</center>
          </div>

          <div>
            <label for="identifier1">Identifiant</label>
            <input type="text" id="identifier1" name="identifier1">
          </div>

          <div>
						<label for="password1">Mot de passe</label>
						<input type="password" id="password1" name="password1"/>
					</div>

          <div>
            <label for="code-secret">Code secret</label>
            <input type="text" id="code-secret" name="code-secret">
            <span id="error_code" class ="warning"></span>
          </div>

        </div>

        <div>
					<input type="submit" name="submit" id="connection" value="Connexion"/>
          <span id="error_connexion" class ="warning"></span>
				</div>

      </form>

    </div>
  </body>

</html>

<script>
  $(document).ready(function() {
    $('#connectionForm').on('submit', function (event) {

      event.preventDefault();

      $.ajax({
        url:"validateConnection.php",
        method:"POST",
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function () {
          $('#connection').attr('disabled', 'disabled');
        },
        success:function (data) {
          $('#connection').attr('disabled', false);

          if (data.successUSER) {

            $('#connectionForm')[0].reset();
            $('#error_connexion').text('');
            window.location.href = "vote.php";

            }else{
                $('#error_connexion').text(data.error_connexion);
            }

            if (data.successADMIN) {

              $('#connectionForm')[0].reset();
              $('#error_connexion').text('');
              $('#error_code').text('');
              window.location.href = "admin/organisateur.php";

              }

              else{
                  $('#error_code').text(data.error_code);
                  $('#error_connexion').text(data.error_connexion);
              }
          }

      });

    });
  });
</script>
