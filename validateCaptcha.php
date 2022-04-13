
      <?php

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
        $error_condition1= '';
        $error_recaptcha= '';

        if (empty($_POST["nom1"])) {
            $error_nom1 = 'Veuillez entrer le nom';
        }else{
          if (strlen($_POST['nom1']) < 4) {
            $error_nom1 = 'au moins 4 lettres';
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

          if ($_POST['condition1'] == '1') {
            $error_condition1 = 'Veuillez valider le box';
          }else {
            $condition1 = $_POST['condition1'];
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

          if ($error_nom1 == '' && $error_prenom1 == '' && $error_email1 == '' &&
        $error_password2 == '' && $error_password3 == '' && $error_recaptcha == '') {

            $data = array('success' => true);
            
          } else {

            $data = array(

              'error_nom1' => $error_nom1,
              'error_prenom1' => $error_prenom1,
              'error_identifier2' => $error_identifier2,
              'error_email1' => $error_email1,
              'error_password2' => $error_password2,
              'error_password3' => $error_password3,
              'error_recaptcha' => $error_recaptcha
            );
          }
          echo json_encode($data);
        }

       ?>
