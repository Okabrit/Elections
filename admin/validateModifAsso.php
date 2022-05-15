<?php
  session_start();
  require_once("bdd_config.php");

  $nom = $_SESSION['nom'];

  $error_description='';
  $error_modification='';

  if(empty($_POST["description2"]) || strlen($_POST['description2'])<20){
    $error_description='au moins 20 caractères';
  }else{
    modifDescription($connection, $nom, $_POST["description2"]);
  }

  if ($error_description == '' && $error_modification == ''){
    $data = array('success' => true);
  }else{
    $data=array(
      'nomAsso' => $_SESSION['nom'],
      'error_description' => $error_description,
      'error_modification' => $error_modification
    );
  }
  echo json_encode($data);


  function modifDescription($connection, $nom, $description){
    $query="UPDATE associations SET description=:description WHERE nom=:nom";
    $statement=$connection->prepare($query);
    $statement->bindValue(":nom", $nom, PDO::PARAM_STR);
    $statement->bindValue(":description", $description, PDO::PARAM_STR);
    $statement->execute();
  }


 ?>
