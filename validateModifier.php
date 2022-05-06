<?php

  require_once("bdd_config.php");
  session_start();

  $nom='';
  $prenom='';
  $id = $_SESSION['id'];
  $email='';
  $password4='';
  $password5 ='';
  $password6='';

  $error_password4='';
  $error_password5='';
  $error_password6='';
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
    $error_password4 ="Veuillez entrer votre mot de passe";
  }else{
    $username=$_SESSION['id'];
    $password=$_POST['password4'];

    $query = "SELECT mdp FROM users WHERE id=:username";
    $statement = $connection->prepare($query);
    $statement->bindValue(":username", $username, PDO::PARAM_STR);
    $statement->execute();
    $row = $statement->fetch(PDO::FETCH_ASSOC);

    if (password_verify($_POST["password4"], $row['mdp'])) {
          $password4=$_POST["password4"];
       } else {
          $error_password4 = "Mot de passe invalide!";
       }

  }

  if (empty($_POST["password5"])) {
      $error_password5 = 'Veuillez entrer un mot de passe';
  }else{
    if (strlen($_POST['password5']) < 8) {
      $error_password5 = 'au moins 8 chiffres';
    }else {
      $password5 = $_POST["password5"];
    }
  }

  if (empty($_POST["password6"])) {
      $error_password6 = 'Veuillez entrer un mot de passe';
  }else{
    if ($_POST['password6'] != $password5) {
      $error_password6 ='les 2 mots de passe ne sont pas identiques!';
    }else{
      $password6 = $_POST["password6"];
     }
  }

    if (!empty($password4) && !empty($password5) && !empty($password6)) {
      modifPassword($connection, $password6, $id);
    }else{
      $error_modification ='Error Modification';
    }


  if ($error_modification == '' && $error_password4 == '' && $error_password5 == '' && $error_password6 == '' ) {


    $data = array('success' => true);

  }else {


    $data = array(
      'id' => $id,
      'error_password4' => $error_password4,
      'error_password5' => $error_password5,
      'error_password6' => $error_password6,
      'error_modification' => $error_modification
    );
  }
  echo json_encode($data);


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
