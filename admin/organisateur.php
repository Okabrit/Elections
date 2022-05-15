
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Organisateur</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/organisateur.css">
  </head>
  <body>
    <header>
      <img src="../images/logo_univ.png">
      <h1>Election d'association</h1>


      <form action="modifier-organisateur.php" method="get">
        <input type="submit" class="modifier" name="modifier" value="Modifier son compte">
      </form>
      <form action="/Elections/index.html" method="get">
        <input type="submit" class="deconnexion" name="deconnexion" value="Deconnexion">
      </form>
    </header>
    <h1>Liste des associations</h1>

    <div id="organisateur">

      <table align="center" border="1px" style="width:900px; line-height:20px;">
        <t>
          <th>ID</th>
          <th>Nom</th>
          <th>FileName</th>
          <th>Description</th>
          <th>NbVoix</th>
        </t>
      <?php


        include_once("bdd_config.php");

        $query = "SELECT * FROM associations;";
        $result = mysqli_query($con, $query);

        while ($rows = mysqli_fetch_assoc($result)) {
      ?>

        <tr>
          <td><?php echo $rows['id'] ?></td>
          <td><?php echo $rows['nom'] ?></td>
          <td><?php echo $rows['fileName'] ?></td>
          <td><?php echo $rows['description'] ?></td>
          <td><?php echo $rows['nbVoix'] ?></td>
        </tr>

        <?php
        }
        ?>

        </table>


    </div>


    <form action="ajouter-association.php" method="get">
      <input type="submit" class="ajouter-association" name="ajouter-association" value="Ajouter une association">
      <input type="submit" class="supprimer-association" name="supprimer-association" value="supprimer une association" formaction="supprimer-association.php">

    </form>

  </body>
</html>
