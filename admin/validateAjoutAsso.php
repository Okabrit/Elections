
      <?php

      session_start();
      require_once("../bdd_config.php");


      if (isset($_POST["nom-assoc1"])) {

        $nomAsso = '';
        $pic = '';
        $description = '';

        $error_nomAsso = '';
        $error_pic = '';
        $error_discription = '';
        $error_bdd = '';

        if (empty($_POST["nom-assoc1"])) {
            $error_nomAsso = 'Veuillez entrer le nom de l\'association ';
        }else{
          if (strlen($_POST['nom-assoc1']) < 2) {
            $error_nomAsso = 'au moins 2 lettres';
          }else {
            $nomAsso = $_POST["nom-assoc1"];
          }

        }


        if(isset($_FILES["uploaded"]) && $_FILES["uploaded"]["error"] == 0){

            $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
            $filename = $_FILES["uploaded"]["name"];
            $filetype = $_FILES["uploaded"]["type"];
            $filesize = $_FILES["uploaded"]["size"];
/*
            // Vérifie l'extension du fichier
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if(!array_key_exists($ext, $allowed)){
              $error_pic = "Erreur : Veuillez sélectionner un format de fichier valide.";
            }

            // Vérifie la taille du fichier - 5Mo maximum
            $maxsize = 5 * 1024 * 1024;
            if($filesize > $maxsize){
              $error_pic = "Error: La taille du fichier est supérieure à la limite autorisée.";
            }

            // Vérifie le type MIME du fichier
            if(in_array($filetype, $allowed)){
                // Vérifie si le fichier existe avant de le télécharger.
                if(file_exists("uploads/" . $_FILES["uploaded"]["name"])){
                    $error_pic = $_FILES["uploaded"]["name"] . " existe déjà.";
                } else{
                    move_uploaded_file($_FILES["uploaded"]["tmp_name"], "uploads/" . $_FILES["uploaded"]["name"]);
                    $pic = 'yes';
                }
            } else{
                $error_pic = "Error: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer.";
            }*/
        }
         else{
            $error_pic = "Error: ";
        }











        if (empty($_POST["description1"])) {
            $error_discription = 'Veuillez entrer une description';
        }else{
          if (strlen($_POST['description1']) < 20) {
            $error_discription = 'au moins 20 lettres';
          }else {
            $description = $_POST["description1"];
          }
        }

          if(!checkAsso($connection, $nomAsso)) {
            $error_bdd = 'Cette association existe déjà !';
          }

        if ($error_bdd == '' && $error_nomAsso == '' && $error_discription == '' && $error_pic == '') {

              addAsso($connection, $nomAsso, $pic, $description);

              $data = array('success' => true);

          } else {

            $data = array(

              'error_nomAsso' => $error_nomAsso,
              'error_pic' => $error_pic,
              'error_discription' => $error_discription,
              'error_bdd' => $error_bdd
            );
          }
          echo json_encode($data);
        }


        function checkAsso($connection, $username) {
           $query = "SELECT COUNT(*) AS count FROM associations WHERE nom=:username";
           $statement = $connection->prepare($query);
           $statement->bindValue(":username", $username, PDO::PARAM_STR);
           $statement->execute();
           $row = $statement->fetch(PDO::FETCH_ASSOC);
           return $row["count"] == "0";
         }

         function addAsso($connection, $nom, $url, $description) {
           $query = "INSERT INTO associations (nom, url, description) VALUES (:nom, :url, :description)";
           $statement = $connection->prepare($query);
           $statement->bindValue(":nom", $nom, PDO::PARAM_STR);
           $statement->bindValue(":url", $url, PDO::PARAM_STR);
           $statement->bindValue(":description", $description, PDO::PARAM_STR);
           $Ok = $statement->execute();
         }

       ?>
