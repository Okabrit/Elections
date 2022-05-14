
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
 $name = rand(100, 999) . '.' . $ext;
 $location = './uploads/' . $name;
 move_uploaded_file($_FILES["file"]["tmp_name"], $location);
 echo '<img src="'.$location.'" height="300" width="250" class="img-thumbnail" />';
}
if ($_FILES["file"]["name"] == '') {
    $error_pic = 'Veuillez entrer un image ';
}else {
    $pic = $_FILES["file"]["name"];
  }


?>
