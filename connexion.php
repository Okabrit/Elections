<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Election : Connexion</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/connexion-inscription.css">
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
      <form action="vote.html" method="post">
        <div>

          <div>
            <label for="identifier1">Identifiant</label>
            <input type="text" id="identifier1" name="identifier1">
          </div>

          <div>
						<label for="password1">Mot de passe</label>
						<input type="password" id="password1" name="password1"/>
					</div>

        </div>

        <div>
					<input type="submit" id="connection" value="Connexion"/>
				</div>
      </form>

    </div>

  </body>

  <?php
    require_once("bdd_config.php");

    session_start();

    $username="";
    $password="";

    if(isset($_POST['identifier1']) && isset($_POST['password1'])){
      $username=$_POST['identifier1'];
      $password=$_POST['password1'];
    }

    $query="SELECT mdp FROM users WHERE id=:username";
    $statement=$connection->prepare($query);
    $statement->bindValue(":username", $username, PDO::PARAM_STR);
    $statement->execute();
    $row=$statement->fetch(PDO::FETCH_ASSOC);

    if($row && $row['mdp']==hash("sha384", $password)){
      $_SESSION["id"]=$username;
    }else{
      if($row && $row['mdp']!=hash("sha384", $password)){
        echo "<p>Mot de passe invalide</p>";
      }
    }

  ?>
</html>
