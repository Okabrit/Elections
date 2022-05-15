<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Vote</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/vote.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.1.js"></script>
  </head>
  <body>
    <header>
      <img src="images/logo_univ.png">
      <h1>Election d'association</h1>
      <form action="modifier_utilisateur.php" method="get">
        <input type="submit" class="modifier" name="modifier" value="Modifier son compte">
      </form>
      <form action="index.html" method="get">
        <input type="submit" class="deconnexion" name="deconnexion" value="Deconnexion">
      </form>
    </header>
    <?php
    require_once("validateVote.php");
    $nbAsso=countAssociations($connection);
    for($i=1; $i<=$nbAsso ;$i++){
      $row1=getAssociation($connection, $i);
      $nom1=$row1["nom"];
      $description1=$row1["description"];
      $photo1=$row1["fileName"];
      for($j=$i+1 ;$j<=$nbAsso ;$j++){
        $row2=getAssociation($connection, $j);
        $nom2=$row2["nom"];
        $description2=$row2["description"];
        $photo2=$row2["fileName"];
    ?>
    <div id="assoc1">
      <?php echo '<img src="'.$photo1.'">';
      echo '<div id="nom-assoc1">'.$nom1.'</div>'; ?>
      <input type="submit" id="voter1" name="voter1" value="Voter">
    </div>

    <!--<input type="submit" id="voter" name="voter" value="Voter">-->

    <form action="classement.html" method="get">
      <input type="submit" id="classement" name="classement" value="Classement">
    </form>
    <form action="vote.php" method="post" id="VoteForm">
    <div id="assoc2">
      <?php echo '<img src="'.$photo2.'">';
       echo '<div id="nom-assoc2">'.$nom2.'</div>'; ?>
      <input type="submit" id="voter2" name="voter2" value="Voter">
    </div>

    <div class="popup1" onclick="popup1()">Description
      <?php echo '<span class="textpopup1" id="popup">'.$description1.'</span>'; ?>
    </div>

    <div class="popup2" onclick="popup2()">Description
      <?php echo '<span class="textpopup2" id="popupbis">'.$description2.'</span>'; ?>
    </div>
  </form>
    <script type="text/javascript" src="vote.js"></script>
  <?php }
  } ?>
  </body>
</html>
