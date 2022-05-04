
      <?php

      require_once("bdd_config.php");

      if (isset($_POST["nom1"])) {
        $nom1 = '';
        $prenom1 = '';
        $identifier2 = '';
        $email1 = '';
        $password2 = '';
        $password3 = '';

        $error_nom1 = '';
        $error_prenom1= '';
        $error_identifier2= '';
        $error_email1= '';
        $error_password2= '';
        $error_password3= '';
        $error_recaptcha= '';
        $error_bdd= '';

        if (empty($_POST["nom1"])) {
            $error_nom1 = 'Veuillez entrer le nom';
        }else{
          if (strlen($_POST['nom1']) < 2) {
            $error_nom1 = 'au moins 2 lettres';
          }else {
            $nom1 = $_POST["nom1"];
          }

        }

        if (empty($_POST["prenom1"])) {
            $error_prenom1 = 'Veuillez entrer le prénom';
        }else{
          if (strlen($_POST['prenom1']) < 4) {
            $error_prenom1 = 'au moins 4 lettres';
          }else {
            $prenom1 = $_POST["prenom1"];
          }
        }

        if (empty($_POST["identifier2"])) {
            $error_identifier2 = 'Veuillez entrer un identifiant';
        }else{
          if (strlen($_POST['identifier2']) < 4) {
            $error_identifier2 = 'au moins 4 lettres';
          }else {
            $identifier2 = $_POST["identifier2"];
          }
        }

        if (empty($_POST["email1"])) {
            $error_email1 = 'Veuillez entrer le email';
        }else{

          if (!filter_var($_POST["email1"], FILTER_VALIDATE_EMAIL)) {
            $error_email1 = 'Email invalide!';
          }else {
            $email1 = $_POST["email1"];
          }

        }

          if (empty($_POST["password2"])) {
              $error_password2 = 'Veuillez entrer un mot de passe';
          }else{
            if (strlen($_POST['password2']) < 8) {
              $error_password2 = 'au moins 8 chiffres';
            }else {
              $password2 = $_POST["password2"];
            }
          }

          if (empty($_POST["password3"])) {
              $error_password3 = 'Veuillez entrer un mot de passe';
          }else{
            if ($_POST['password3'] != $password2) {
              $error_password3 = 'error';
            }else{
            $password3 = $_POST["password3"];
             }
          }

          if (empty($_POST["g-recaptcha-response"])) {
              $error_recaptcha = 'Veuillez faire le reCAPTACHA';
          }else{
            $secret = '6LfJnGkfAAAAAFTUVDUUv-49il8fqLdbSNsyggTk';
            $recaptcha = $_POST['g-recaptcha-response'];
            $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $recaptcha;
            $verifyResponse = file_get_contents($url);
            $responseData = json_decode($verifyResponse);

          }

          if(!checkUserName($connection, $identifier2) && $error_identifier2 == '') {
            $error_bdd = 'Cet identifiant existe déjà !';
          }else if(checkUserName($connection, $identifier2)) {
            $cryptedPw = hash('sha384', $password2);
            addUser($connection, $identifier2, $email1, $cryptedPw, $nom1, $prenom1);
          }



          if ($error_nom1 == '' && $error_prenom1 == '' && $error_identifier2 == '' && $error_email1 == '' && $error_password2 == '' && $error_password3 == '' && $error_recaptcha == '' && $error_bdd == '') {

               $data = array('success' => true);

          } else {

            $data = array(

              'error_nom1' => $error_nom1,
              'error_prenom1' => $error_prenom1,
              'error_identifier2' => $error_identifier2,
              'error_email1' => $error_email1,
              'error_password2' => $error_password2,
              'error_password3' => $error_password3,
              'error_recaptcha' => $error_recaptcha,
              'error_bdd' => $error_bdd
            );
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

         function addUser($connection, $username, $email, $cryptedPw, $nom, $prenom) {
           $query = "INSERT INTO users (id, nom, prenom, mail, mdp) VALUES (:username, :nom, :prenom, :email, :cryptedPw)";

           $statement = $connection->prepare($query);
           $statement->bindValue(":username", $username, PDO::PARAM_STR);
           $statement->bindValue(":email", $email, PDO::PARAM_STR);
           $statement->bindValue(":cryptedPw", $cryptedPw, PDO::PARAM_STR);
           $statement->bindValue(":nom", $nom, PDO::PARAM_STR);
           $statement->bindValue(":prenom", $prenom, PDO::PARAM_STR);

           $Ok = $statement->execute();
         }

       ?>
