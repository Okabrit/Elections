
<?php
session_start();
require_once("../bdd_config.php");


//upload.php
$pic = '';
$error_pic = '';

if($_FILES["file"]["name"] != '')
{
 $test = explode('.', $_FILES["file"]["name"]);
 $ext = end($test);
 $name = $_SESSION['id'] . '.' . $ext;
 $location = './uploads/' . $name;
 move_uploaded_file($_FILES["file"]["tmp_name"], $location);
 echo '<img src="'.$location.'" height="300" width="250" class="img-thumbnail" />';

    addPic($connection, $name, $_SESSION['id']);

}

   function addPic($connection, $fileNameNew, $nom) {
     $query = 'UPDATE associations SET fileName=:fileNameNew WHERE nom=:nom';
     $statement = $connection->prepare($query);
     $statement->bindValue(":nom", $nom, PDO::PARAM_STR);
     $statement->bindValue(":fileNameNew", $fileNameNew, PDO::PARAM_STR);
     $statement->execute();
   }

?>
