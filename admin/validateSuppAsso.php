<?php
  session_start();
  require_once("bdd_config.php");

  $nom='';
  $description='';

  $error_nom='';
  $error_description='';
  $error_bdd = '';

  if(isset($_POST["nom-assoc3"])){
    if(empty($_POST["nom-assoc3"])){
      $error_nom='Veuillez entrer le nom de l\'association que vous voulez supprimer';
    }else{
      $nom=$_POST["nom-assoc3"];
    }

    if(empty($_POST["description"])){
      $error_nom='Veuillez entrer la description de l\'association';
    }else{
      $description=$_POST["description"];
    }

    if(checkAssociation($connection,$nom)){
      $error_bdd='Cette association n\'existe pas';
    }

    if($error_bdd='' && $error_nom='' && $error_description=''){
      deleteAssociation($connection, $nom, $description);
    }
  }

  function checkAssociation($connection, $nom){
    $query="SELECT COUNT(*) AS count FROM associations WHERE nom=:nom";
    $statement=$connection->prepare($query);
    $statement->bindValue(":nom", $nom, PDO::PARAM_STR);
    $statement->execute();
    $row=$statement->fetch(PDO::FETCH_ASSOC);
    return $row["count"]=="0";
  }

  function deleteAssociation ($connection, $nom, $description){
    $query='DELETE FROM associations WHERE nom=:nom';
    $statement=$connection->prepare($query);
    $statement->bindValue(":nom", $nom, PDO::PARAM_STR);
    $statement->execute();
    $ok=$statement->fetch(PDO::FETCH_ASSOC);
    return $ok;
  }
?>
