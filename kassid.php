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
<a href="https://karl-hendrikhaabu22.thkit.ee/kippar"><button class="btn"><i class="fa fa-home"></i> Kippar</button><br></a>
</header>
<body>
  <h1>Kasside loetelu</h1>
  <?php

  while($kask->fetch()){
    $pikkus = strlen($kassinimi);
    if ($toon == "white" || $toon == "White"){
      echo "<h2 style=\"line-height: 0px\">Kassi nimi:</h2><h2 style=\"color: $toon; background-color: gray; width: $pikkus%; margin-top:0px; margin-bottom:0px;\">".htmlspecialchars($kassinimi)."</h2>";
    }
    else {
      echo "<h2 style=\"line-height: 0px\">Kassi nimi:</h2><h2 style=\"color: $toon; margin-top:0px; margin-bottom:0px;\">".htmlspecialchars($kassinimi)."</h2>";
    }
    echo "<div>Kassi värv:</div><div>".htmlspecialchars($toon)."</div><br>";
  }
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
  //height: 100%;
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