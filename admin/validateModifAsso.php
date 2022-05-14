<?php
  session_start();
  require_once("bdd_config.php");

  $nom='';
  $description='';

  $error_nom='';
  $error_description='';
  $error_modification='';

  if(empty($_POST["nom-assoc2"])){
    $error_nom='Veuillez entrer le nom de l\'association que vous voulez modifier';
  }else if(checkAssociation($connection, $_POST["nom-assoc2Ò"])){
    $error_nom='Cette association n\'existe pas';
  }else{
    $nom=$_POST["nom-assoc2"];
  }

  if(empty($_POST["description2"])){
    $description=getDescription($connection, $nom);
  }else if(strlen($_POST['description2'])<20){
    $error_description='au moins 20 caractères';
  }else{
    modifDescription($connection, $nom, $description);
  }

  if ($error_nom == '' && $error_description == '' && $error_modification == ''){
    $data = array('success' => true);
  }else{
    $data=array(
      'error_nom' => $error_nom,
      'error_description' => $error_description,
      'error_modification' => $error_modification
    );
  }
  echo json_encode($data);

  function checkAssociation($connection, $nom){
    $query="SELECT COUNT(*) AS count FROM associations WHERE nom=:nom";
    $statement=$connection->prepare($query);
    $statement->bindValue(":nom", $nom, PDO::PARAM_STR);
    $statement->execute();
    $row=$statement->fetch(PDO::FETCH_ASSOC);
    return $row["count"]=="0";
  }

  function getDescription($connection, $nom){
    $query="SELECT description FROM associations WHERE nom=:nom";
    $statement=$connection->prepare($query);
    $statement->bindValue(":nom", $nom, PDO::PARAM_STR);
    $statement->execute();
    $row=$statement->fetch(PDO::FETCH_ASSOC);
    return $row["description"];
  }

  function modifDescription($connection, $nom, $description){
    $query="UPDATE associations SET description=:description WHERE nom=:nom";
    $statement=$connection->prepare($query);
    $statement->bindValue(":description", $description, PDO::PARAM_STR);
    $statement->bindValue(":nom", $nom, PDO::PARAM_STR);
    $statement->execute();
  }
 ?>
