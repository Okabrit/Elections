<?php
  session_start();
  require_once("bdd_config.php");

  $nom='';

  $error_nom = '';
  $error_bdd = '';

  if(isset($_POST["nom-assoc3"])){
    if(empty($_POST["nom-assoc3"])){
      $error_nom='Veuillez entrer le nom de l\'association que vous voulez supprimer';
    }else{
      $nom=$_POST["nom-assoc3"];
    }

    if(checkAssociation($connection,$nom)){
      $error_bdd='Cette association n\'existe pas';
    }

    if($error_bdd == '' && $error_nom == ''){
      deleteAssociation($connection, $nom);
      $data = array('success' => true);
    }else{
      $data = array(
        'error_nom' => $error_nom,
        'error_bdd' => $error_bdd
      );
    }
    echo json_encode($data);
  }

  function checkAssociation($connection, $nom){
    $query="SELECT COUNT(*) AS count FROM associations WHERE nom=:nom";
    $statement=$connection->prepare($query);
    $statement->bindValue(":nom", $nom, PDO::PARAM_STR);
    $statement->execute();
    $row=$statement->fetch(PDO::FETCH_ASSOC);
    return $row["count"]=="0";
  }

  function deleteAssociation ($connection, $nom){
    $query='DELETE FROM associations WHERE nom=:nom';
    $statement=$connection->prepare($query);
    $statement->bindValue(":nom", $nom, PDO::PARAM_STR);
    $statement->execute();
    $ok=$statement->fetch(PDO::FETCH_ASSOC);
    return $ok;
  }
?>
