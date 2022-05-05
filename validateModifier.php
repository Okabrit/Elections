<?php
  require_once("bdd_config.php");

  $nom='';
  $prenom='';
  $id='';
  $email='';
  $password='';
  $newPassword='';
  $error_modification='';

  if(empty($_POST["nom2"])){
    $error_modification.="Veuillez entrer votre nom";
  }else{
    $nom=$_POST["nom2"];
  }

  if(empty($_POST["prenom2"])){
    $error_modification.="Veuillez entrer votre prénom";
  }else{
    $prenom=$_POST["prenom2"];
  }

  if(empty($_POST["identifier3"])){
    $error_modification.="Veuillez entrer votre identifiant";
  }else{
    $id=$_POST["identifier3"];
  }

  if(empty($_POST["email2"])){
    $error_modification.="Veuillez entrer votre adresse mail";
  }else{
    $email=$_POST["email2"];
  }

  if(empty($_POST["password4"])){
    $error_modification.="Veuillez entrer votre mot de passe";
  }else{
    $password=$_POST["password4"];
  }

  if(empty($_POST["password5"])){
    $error_modification.="Veuillez entrer votre nouveau mot de passe";
  }else{
    $newPassword=$_POST["password5"];
  }

  if(empty($_POST["password6"])){
    $error_modification.="Veuillez confirmer votre nouveau mot de passe";
  }

  if(checkUserName($connection, $id)){
    $error_modification.='Cet identifiant n\'existe pas';
  }else if( checkPassword($connection,$password,$id)["mdp"] == password_hash($password1, PASSWORD_DEFAULT); ){
    modifPassword($connection, $newPassword, $id);
  }else{
    $error_modification.='Mot de passe invalide';
  }

  function checkUserName($connection, $username) {
     $query = "SELECT COUNT(*) AS count FROM users WHERE id=:username";
     $statement = $connection->prepare($query);
     $statement->bindValue(":username", $username, PDO::PARAM_STR);
     $statement->execute();

     $row = $statement->fetch(PDO::FETCH_ASSOC);
     return $row["count"] == "0";
   }

  function checkPassword($connection, $password, $id){
    $query='SELECT mdp FROM users WHERE id=:id';
    $statement=$connection->prepare($query);
    $statement->bindValue(":id", $id, PDO::PARAM_STR);
    $statement->execute();
    $row=$statement->fetch(PDO::FETCH_ASSOC);
    return $row;
  }

  function modifPassword($connection, $newPassword, $id){
    $query='UPDATE users SET mdp=:password WHERE id=:id';
    $statement=$connection->prepare($query);
    $statement->bindValue(":id", $id, PDO::PARAM_STR);
    $cryptedPassword=password_hash($newPassword, PASSWORD_DEFAULT);
    $statement->bindValue(":password", $cryptedPassword, PDO::PARAM_STR);
    $statement->execute();
  }
?>
