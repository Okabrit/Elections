<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Modifier une association</title>
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

    <h1>Modifier une association</h1>
    <div id="modifier-assoc">
      <form action="organisateur.php" method="post" id="modifAssociation">
        <div>

          <div id="nom-assoc2">
            <label for="nom-assoc2">Nom de l'association</label>
            <input type="text" id="nom-assoc2" name="nom-assoc2">
            <span id="error_nom" class="warning"></span>
          </div>

          <div id="description2">
            <textarea name="description2" rows="15" cols="35"></textarea>
            <span id="error_description" class="warning"></span>
          </div>

        </div>

        <div>
					<input type="submit" id="modifier" value="Modifier"/>
          <span id="error_modification" class="warning"></span>
				</div>
      </form>


    </div>

  </body>
</html>

<script>
  $(document).ready(function() {
    $('#modifAssociation').on('submit', function (event) {
      event.preventDefault();
      $.ajax({
        url:"validateModifAsso.php",
        method:"POST",
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function () {
          $('#modifier').attr('disabled', 'disabled');
        },
        success:function (data) {
          $('#modifier').attr('disabled', false);
          if (data.success) {
            $('#modifAssociation')[0].reset();
            $('#error_nom').text('');
            $('#error_description').text('');
            $('#error_modification').text('');
            window.location.href = "image.php";
            }else{
                $('#error_nom').text(data.error_nom);
                $('#error_description').text(data.error_description);
                $('#error_modification').text(data.error_modification);
            }
          }
      });
    });
  });
</script>
