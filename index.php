<?php
require ($_SERVER["DOCUMENT_ROOT"]."/config.php");
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
  ?>
</body>
</html>
<?php
$yhendus->close();
?>
