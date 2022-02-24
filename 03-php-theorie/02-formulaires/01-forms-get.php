<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulaires: GET</title>
  <style>
    .result {
      padding:10px;
      margin-top:10px;
      border: 2px solid black;
      background-color:rgb(89, 235, 89);
    }
  </style>
</head>
<body>
  <h1>Formulaires: GET</h1>
  <form action="#" method="GET">
    <fieldset>
      <legend>Infos</legend>
      <label for="nom">Votre nom:</label>
      <input type="text" name="nom" required>
      <label for="age">Votre âge:</label>
      <input type="number" name="age" required>
      <label for="commentaire">Commentaire:</label>
      <input type="textarea" name="commentaire" required>
      <input type="submit" value="Soumettre">
    </fieldset>
  </form>
  <?php
    /*
      $_GET est un tableau de variables transmis au script courant via les paramètres d'URL.
      ex: forms.php?nom=Vincent&age=47
      C'est la méthode par défaut.
      Moins sécurisé que POST.
      Permet de manipuler les variables via javascript côté client.
      Permet de créer des raccourcis.
    */
    // var_dump($_GET);
    if(isset($_GET["nom"])){
      // "isset" détermine si une variable est définie et est différente de NULL.
      echo "<div class=\"result\">";
      echo "Votre nom est : ".$_GET["nom"]. "<br />";
      if(isset($_GET["age"])){
          echo "Votre âge est : ".$_GET["age"]. "<br />";;
      }
      if(isset($_GET["commentaire"])){
        echo "Votre commentaire : ".$_GET["commentaire"];
      }
      echo "</div>";
    }
  ?>
</body>
</html>