
  <?php
    require_once("bdd_config.php");
    session_start();

    if (isset($_POST["identifier1"])) {

      $identifier1 = '';
      $password1 = '';
      $error_connexion = '';

      if (empty($_POST["identifier1"])) {
          $error_connexion = 'Veuillez entrer un identifiant';
        }else {
          $identifier1 = $_POST["identifier1"];
        }


      if (empty($_POST["password1"])) {
          $error_connexion = 'Veuillez entrer un mot de passe';
        }else {
          $password1 = $_POST["password1"];
        }

          if(checkUserName($connection, $identifier1)) {

            $error_connexion = 'Cet identifiant existe pas';

          } else {

            $username=$_POST['identifier1'];
            $password=$_POST['password1'];

				    $query = "SELECT mdp FROM users WHERE id=:username";
				    $statement = $connection->prepare($query);
				    $statement->bindValue(":username", $username, PDO::PARAM_STR);
				    $statement->execute();
				    $row = $statement->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $row['mdp'])) {
					        $_SESSION["id"] = $username;
				       } else {
                  $error_connexion = "Mot de passe invalide!";
               }

          }


        if ($error_connexion == '') {
          $data = array('success' => true);
        }else {
          $data = array('error_connexion' => $error_connexion);
        }


        echo json_encode($data);

      }


        function checkUserName($connection, $username) {
           $query = "SELECT COUNT(*) AS count FROM users WHERE id=:username";
           $statement = $connection->prepare($query);
           $statement->bindValue(":username", $username, PDO::PARAM_STR);
           $statement->execute();

           $row = $statement->fetch(PDO::FETCH_ASSOC);
           return $row["count"] == "0";
         }



  ?>
