<?php
  require_once("bdd_config.php");
  session_start();
  $nom1='';
  $description1='';
  $photo1='';
  $nom2='';
  $description2='';
  $photo2='';


  /*for($i=1; $i<=$nbAsso ;$i++){
    $row1=getAssociation($connection, $i);
    $nom1=$row1["nom"];
    $description1=$row1["description"];
    $photo1=$row1["fileName"];
    for($j=$i+1 ;$j<=$nbAsso ;$j++){
      $row2=getAssociation($connection, $j);
      $nom2=$row2["nom"];
      $description2=$row2["description"];
      $photo2=$row2["fileName"];
    }
  }*/

  function getAssociation($connection, $id){
    $query="SELECT * FROM associations WHERE id=:id";
    $statement=$connection->prepare($query);
    $statement->bindValue(":id", $id, PDO::PARAM_STR);
    $statement->execute();
    $row=$statement->fetch(PDO::FETCH_ASSOC);
    return $row;
  }

  function countAssociations($connection){
    $query="SELECT COUNT(*) AS count FROM associations";
    $statement=$connection->prepare($query);
    $statement->execute();
    $row=$statement->fetch(PDO::FETCH_ASSOC);
    return $row["count"];
  }

 ?>
