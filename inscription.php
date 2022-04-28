<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Election : Inscription</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/connexion-inscription.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.1.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  </head>
  <body>

    <header>
      <img src="images/logo_univ.png">
      <h1>Election d'association</h1>
      <form action="index.html" method="get">
        <input type="submit" class="retour" name="retour" value="Retour">
      </form>
    </header>

    <h1>Inscription</h1>
    <div id="inscript">
        <form action="vote.html" method="post" id="registerForm">
        <div>

          <div>
            <label for="nom1">Nom<span class="warning">*</span></label>
            <input type="text" id="nom1" name="nom1">
            <span id="error_nom1" class ="warning"></span>
          </div>

          <div>
            <label for="prenom1">Prénom<span class="warning">*</span></label>
            <input type="text" id="prenom1" name="prenom1">
            <span id="error_prenom1" class ="warning"></span>
          </div>

          <div>
            <label for="identifier2">Identifiant<span class="warning">*</span></label>
            <input type="text" id="identifier2" name="identifier2">
            <span id="error_identifier2" class ="warning"></span>
          </div>

          <div>
            <label for="email1">Email<span class="warning">*</span></label>
            <input type="text" id="email1" name="email1">
            <span id="error_email1" class ="warning"></span>
          </div>

          <div>
						<label for="password2">Mot de passe<span class="warning">*</span></label>
						<input type="password" id="password2" name="password2"/>
            <span id="error_password2" class ="warning"></span>
					</div>

          <div>
						<label for="password3">Confirmation mot de passe<span class="warning">*</span></label>
						<input type="password" id="password3" name="password3"/>
            <span id="error_password3" class ="warning"></span>
					</div>

          <div>
				  	<input type="checkbox" id="condition1" name="condition1" value="1" checked/>
            <label for="condition1">Accepter les conditions d'utilisation.</label>
            <span id="error_condition1" class ="warning"></span>
		  		</div>

          <div class="g-recaptcha" data-sitekey="6LfJnGkfAAAAAFiCD7fB6VxetioxBTpATsuj0PFE"></div>
          <span id="error_recaptcha" class ="warning"></span>
          <span id="error_bdd" class="warning"></span>


          <div>
  					<input type="submit" name="submit" id="inscription" value="Inscription"/>
  				</div>

        </div>

     </form>

    </div>
  </body>
</html>

<script>
  $(document).ready(function() {
    $('#registerForm').on('submit', function (event) {
      event.preventDefault()
      $.ajax({
        url:"validateCaptcha.php",
        method:"POST",
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function () {
          $('#inscription').attr('disabled', 'disabled');
        },
        success:function (data) {
          $('#inscription').attr('disabled', false);

          if (data.success) {

          //  $('#registerForm')[0].reset();
            $('#error_nom1').text('');
            $('#error_prenom1').text('');
            $('#error_identifier2').text('');
            $('#error_email1').text('');
            $('#error_password2').text('');
            $('#error_password3').text('');
            $('#error_condition1').text('');
            $('#error_recaptcha').text('');
            $('#error_bdd').text('');
            grecaptcha.reset();

            window.location.href = "vote.html";
          }else{

            $('#error_nom1').text(data.error_nom1);
            $('#error_prenom1').text(data.error_prenom1);
            $('#error_identifier2').text(data.error_identifier2);
            $('#error_email1').text(data.error_email1);
            $('#error_password2').text(data.error_password2);
            $('#error_password3').text(data.error_password3);
            $('#error_condition1').text(data.error_condition1);
            $('#error_recaptcha').text(data.error_recaptcha);
            $('#error_bdd').text(data.error_bdd);
            grecaptcha.reset();
          }
        }


      })
    })
  })
</script>
