<?php
  require_once("bdd_config.php");

  $nom='';
  $prenom='';
  $id=$_SESSION['id'];
  $email='';
  $password='';
  $newPassword='';
  $error_modification='';


  if(empty($_POST["nom2"])){
    $nom = getLastName($connection, $id);
  }else{
    $nom=$_POST["nom2"];
  }

  if(empty($_POST["prenom2"])){
    $prenom = getName($connection, $id);
  }else{
    $prenom=$_POST["prenom2"];
  }

  if(empty($_POST["email2"])){
    $email = getMail($connection, $id);
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

  if(checkPassword($connection,$password,$id)["mdp"] == password_hash($password1, PASSWORD_DEFAULT)){
    modifPassword($connection, $newPassword, $id);
  }else{
    $error_modification.='Mot de passe invalide';
  }

  function getMail($connection, $id) {
    $query = "SELECT mail FROM users WHERE id=:id";
    $statement = $connection->prepare($query);
    $statement->bindValue(":id", $id, PDO::PARAM_STR);
    $statement->execute();

    $row = $statement->fetch(PDO::FETCH_ASSOC);
    return $row["mail"];
  }  

  function getName($connection, $id) {
    $query = "SELECT prenom FROM users WHERE id=:id";
    $statement = $connection->prepare($query);
    $statement->bindValue(":id", $id, PDO::PARAM_STR);
    $statement->execute();

    $row = $statement->fetch(PDO::FETCH_ASSOC);
    return $row["prenom"];
  }  

  function getLastName($connection, $id) {
    $query = "SELECT nom FROM users WHERE id=:id";
    $statement = $connection->prepare($query);
    $statement->bindValue(":id", $id, PDO::PARAM_STR);
    $statement->execute();

    $row = $statement->fetch(PDO::FETCH_ASSOC);
    return $row["nom"];
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
