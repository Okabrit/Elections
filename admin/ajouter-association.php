<!DOCTYPE html>
<html lang="en" dir="ltr">

  <head>
    <meta charset="utf-8">
    <title>Ajouter une association</title>
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
      <form action="organisateur.html" method="get">
        <input type="submit" class="retour" name="retour" value="Retour">
      </form>
    </header>

    <h1>Ajouter une association</h1>
    <div id="ajouter-assoc">
      <form action="organisateur.html" method="post" id="AjoutForm" enctype="multipart/form-data">
        <div>

          <div>
            <label for="nom-assoc1">Nom de l'association</label>
            <input type="text" id="nom-assoc1" name="nom-assoc1">
            <span id="error_nomAsso" class ="warning"></span>
          </div>

          <div id="ajouter-image">

            <div id="image1">
              <img src="" alt="">
            </div>

            <input type="file" name="uploaded" value="Ajouter une image">
            <span id="error_pic" class ="warning"></span>
          </div>

          <div id="description1">
            <textarea name="description1" id="description" rows="15" cols="35"></textarea>
            <span id="error_discription" class ="warning"></span>
          </div>

        </div>

        <div>
					<input type="submit" id="ajouter" value="Ajouter"/>
          <span id="error_bdd" class="warning"></span>
				</div>
      </form>

    </div>
  </body>
</html>

<script>
  $(document).ready(function() {
    $('#AjoutForm').on('submit', function (event) {
      event.preventDefault();
      $.ajax({
        url:"validateAjoutAsso.php",
        method:"POST",
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function () {
          $('#ajouter').attr('disabled', 'disabled');
        },
        success:function (data) {
          $('#ajouter').attr('disabled', false);
          if (data.success) {
            $('#AjoutForm')[0].reset();
            $('#error_nomAsso').text('');
            $('#error_pic').text('');
            $('#error_discription').text('');
            $('#error_bdd').text('');
            window.location.href = "organisateur.html";
            }else{
                $('#error_nomAsso').text(data.error_nomAsso);
                $('#error_pic').text(data.error_pic);
                $('#error_discription').text(data.error_discription);
                $('#error_bdd').text(data.error_bdd);
            }
          }
      });
    });
  });
</script>
