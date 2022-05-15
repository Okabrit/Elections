<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Supprimer une associaton</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/ajouter-modifier-supprimer.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.1.js"></script>
  </head>
  <body>
    <header>
      <img src="../images/logo_univ.png">
      <h1>Election d'association</h1>
      <form action="organisateur.php" method="get">
        <input type="submit" class="retour" name="retour" value="Retour">
      </form>
    </header>

    <h1>Supprimer une association</h1>
    <div id="supprimer-assoc">
      <form action="organisateur.php" method="post" id="suppAssociation">
        <div>
          <div>
            <label for="nom-assoc3">Nom de l'association</label>
            <input type="text" id="nom-assoc3" name="nom-assoc3">
            <span id="error_nom" class ="warning"></span>
          </div>

          <div id="supprimer-image">
            <div id="image3">
              <img src="" alt="">
            </div>
          </div>

          <div id="description2">
            <textarea name="description2" id="description" rows="15" cols="35"></textarea>
            <span id="error_description" class ="warning"></span>
          </div>

        </div>

        <div>
					<input type="submit" id="supprimer" value="Supprimer"/>
          <span id="error_bdd" class="warning"></span>
				</div>
      </form>


    </div>

  </body>
</html>

<script>
  $(document).ready(function() {
    $('#suppAssociation').on('submit', function (event) {
      event.preventDefault();
      $.ajax({
        url:"validateSuppAsso.php",
        method:"POST",
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function () {
          $('#supprimer').attr('disabled', 'disabled');
        },
        success:function (data) {
          $('#supprimer').attr('disabled', false);
          if (data.success) {
            $('#suppAssociation')[0].reset();
            $('#error_nom').text('');
            $('#error_bdd').text('');
            window.location.href = "organisateur.php";
            }else{
                $('#error_nom').text(data.error_nom);
                $('#error_bdd').text(data.error_bdd);
            }
          }
      });
    });
  });
</script>
