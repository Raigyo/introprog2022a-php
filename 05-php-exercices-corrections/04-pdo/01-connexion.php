<?php
  include("./templates/common/header.php");
  include("./templates/common/menu.php");
?>

<h1>Pokédex</h1>

<?php
  // Connexion DB
  function connectDB(){
    define("HOST_NAME", "localhost");
    define("DB_NAME", "db_introprog_pokemons");
    define("USER_NAME", "root");
    define("PWD", "");

    try {
      $connexion = "mysql:host=" . HOST_NAME . ";dbname=" . DB_NAME;
      $dsn = new PDO($connexion, USER_NAME, PWD);
      // On ajoute des attributs de classe
      $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // gestion des erreurs
      $dsn->exec('set names utf8'); // gestion de l'UTF-8
      return $dsn;
      echo "Vous êtes connecté !</br>" ;
    } catch (PDOException $exception) {
      $message = "Erreur de connexion à la DB: " . $exception->getMessage();
      die($message); // affiche le message et sort du script
    }
  }

  // Requête get all Pokémons
  function getAllPokemons(PDO $dsn) {
    // requête sur tous les éléments de la table _pk_list_
    $pokemonsList = [];
    $sql = "SELECT * FROM pk_list";
    $stmt = $dsn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $pokemonsList=$stmt->fetchAll();

    return $pokemonsList;
  }

  // Requête get Type
  function getTypes(PDO $dsn) {
    $typesList = [];
    $sql = "SELECT * FROM pk_types";
    $stmt = $dsn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $typesList=$stmt->fetchAll();

    return $typesList;
  }
?>

<?php
  /*
    Connexion à la base de données via PDO pour lister les pokémons:
  */
  try{
      $dsn = connectDB();
      $pokemonsList = getAllPokemons($dsn);
      $typesList = getTypes($dsn);

  } catch (Exception $ex) {
      die("ERREUR FATALE : " . $ex->getMessage(). "Erreur de connexion !");
  }
?>

<table>
  <thead>
    <tr>
      <th>Name</th>
      <th>Pv</th>
      <th>Image</th>
      <th>Type1</th>
      <th>Type2</th>
      <th>Editable</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($pokemonsList as $key => $value):?>
      <tr>
        <td><?php echo ($value['Name']); ?></td>
        <td><?php echo ($value['Pv']); ?></td>
        <td><?php echo ($value['Image']); ?></td>
        <td><?php echo ($value['Type1']); ?></td>
        <td><?php echo ($value['Type2']); ?></td>
        <td>
          <?php
            if ($value['Editable']) {
              { echo "Yes"; }
            }
            else { echo "Non"; }
          ?>
        </td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>

<?php
  include("./templates/common/footer.php");
?>