
  <?php
    require_once("bdd_config.php");
    session_start();

    $code_secret = '0101';

    if (isset($_POST["identifier1"]) && empty($_POST["code-secret"])) {

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

        header('Location:./vote.html');

      }else if(isset($_POST["identifier1"]) && isset($_POST["code-secret"])==$code_secret) {

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

          header('Location:./admin/');
      }else{
        header('Location:./connexion.php');
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
