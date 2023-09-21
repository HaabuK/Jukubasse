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
<body>
  <h1>Kasside loetelu</h1>
  <?php
  $kass = $yhendus->prepare("SELECT id, kassinimi, toon FROM kassid");
  $kass->bind_result($id, $kassinimi, $toon);
  $kass->execute();

  while($kass->fetch()){
  echo "<h2 style=\"color:".htmlspecialchars($toon)."background-color: gray\">".htmlspecialchars($kassinimi)."</h2>";
  echo "<div>".htmlspecialchars($toon)."</div>";
  }
  ?>
</body>
</html>
<?php
$yhendus->close();
?>
