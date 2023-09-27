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
<a href="https://karl-hendrikhaabu22.thkit.ee/kippar"><button class="btn"><i class="fa fa-home"></i> Kippar</button><br></a>
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
body{
  display: flex;
  flex-direction: column;
  padding-top: 30px;
  padding-bottom: 150px;
}
footer {
  text-align: center;
  align-items: center;
  justify-content: center;
  font-size: 15px;
  background-color: lightgray;
  color: black;
  position: fixed;
  bottom: 0px;
  display: flex;
  height: 20px;
  width: 100%;
  margin-left:-10px;
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
  margin-left:-10px;
}
.btn {
  background-color: lightgray; 
  border: none; 
  color: white; 
  padding: 11px 20px; 
  font-size: 16px; 
  cursor: pointer;
}

.btn:hover {
  background-color: black;
}
</style>