<link rel="icon" href="favicon.png" sizes="16x16" type="image/png">
<?php
require ($_SERVER["DOCUMENT_ROOT"]."/../config.php");
global $yhendus;
$kask = $yhendus->prepare("SELECT id, pealkiri, sisu FROM lehed");
$kask->bind_result($id, $pealkiri, $sisu);
$kask->execute();


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width-device-width, initial scale=1.0">
  <title>Teated lehel</title>
</head>
<header>
<a href="https://karl-hendrikhaabu22.thkit.ee/kippar">Kippar pealehele<br></a>
</header>
<body>
  <h1>Teadete loetelu</h1>
  <?php
  while($kask->fetch()){
  echo "<h2>".htmlspecialchars($pealkiri)."</h2>";
  echo "<div>".htmlspecialchars($sisu)."</div>";
  }
  echo "<br><br><br>"
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