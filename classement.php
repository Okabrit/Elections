<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Election : Classement</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/classement.css">
  </head>
  <body>
    <header>
      <img src="images/logo_univ.png">
      <h1>Election d'association</h1>
      <form action="vote.php" method="get">
        <input type="submit" class="retour" name="retour" value="Retour">
      </form>
    </header>
    <h1>Classement</h1>
    <div id="classement">
      <table align="center" border="1px" style="width:900px; line-height:20px; table-layout:fixed; word-break: break-all;">
        <t>
          <th>ID</th>
          <th>Nom</th>
          <th>FileName</th>
          <th>Description</th>
          <th>NbVoix</th>
        </t>
        <?php


          require_once("bdd_config.php");

          $query = "SELECT * FROM associations ORDER BY nbVoix DESC;";
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

  </body>
</html>
