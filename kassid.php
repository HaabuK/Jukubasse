<link rel="icon" href="favicon.png" sizes="16x16" type="image/png">
<?php
require ($_SERVER["DOCUMENT_ROOT"]."/../config.php");
global $yhendus;
$kask = $yhendus->prepare("SELECT id, kassinimi, toon FROM kassid");
$kask->bind_result($id, $kassinimi, $toon);
$kask->execute();


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width-device-width, initial scale=1.0">
  <title>Kassid</title>
</head>
<header>
<a href="https://karl-hendrikhaabu22.thkit.ee/kippar">Kippar pealehele<br></a>
</header>
<body>
  <h1>Kasside loetelu</h1>
  <?php

  while($kask->fetch()){
    if ($toon == "white" || $toon == "White"){
      echo "<h2>Kassi nimi:</h2><h2 style=\"color: $toon; background-color: gray; width: 10%;\">".htmlspecialchars($kassinimi)."</h2>";
    }
    else {
      echo "<h2>Kassi nimi:</h2><h2 style=\"color: $toon;\">".htmlspecialchars($kassinimi)."</h2>";
    }
    echo "<div>Kassi värv:</div><div>".htmlspecialchars($toon)."</div>";
  }
  ?>
</body>
</html>
<?php
$yhendus->close();
?>

<footer>Karl Haabu, TARge22</footer>

<style>
footer {
  text-align: center;
  align-items: center;
  justify-content: left;
  font-size: 25px;
  background-color: lightGray;
  color: black;
  position: fixed;
  bottom: 0px;
  display: flex;
  height: 40px;
  width: 100%;
}
header {
  text-align: center;
  align-items: center;
  justify-content: left;
  font-size: 25px;
  background-color: lightGray;
  color: black;
  position: fixed;
  top: 0px;
  display: flex;
  height: 40px;
  width: 100%;
}
</style>