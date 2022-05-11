
  <?php
    require_once("bdd_config.php");
    session_start();

    $code_secret = '0000';

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
            $data = array('successUSER' => true);
          }else {
            $data = array('error_connexion' => $error_connexion);
          }

      }


      // avec code

      else if(isset($_POST["identifier1"]) && isset($_POST["code-secret"]) == $code_secret) {

        $identifier1 = '';
        $password1 = '';
        $error_connexion = '';
        $error_code = '';

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

            if ($_POST["code-secret"] != $code_secret) {
                $error_code = 'Code Invalide!';
              }else {
                $code_secret = $_POST["code-secret"];
              }

              if ($error_connexion == '' && $error_code == '') {
                $data = array('successADMIN' => true);
              }else {
                $data = array('error_connexion' => $error_connexion);
                $data = array('error_code' => $error_code);
              }

      }




      echo json_encode($data);






        function checkUserName($connection, $username) {
           $query = "SELECT COUNT(*) AS count FROM users WHERE id=:username";
           $statement = $connection->prepare($query);
           $statement->bindValue(":username", $username, PDO::PARAM_STR);
           $statement->execute();

           $row = $statement->fetch(PDO::FETCH_ASSOC);
           return $row["count"] == "0";
         }




  ?>
