<?php
require ($_SERVER["DOCUMENT_ROOT"]."/../config.php");
global $yhendus;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width-device-width, initial scale=1.0">
  <title>Koerad</title>
</head>
<header>
<a href="https://karl-hendrikhaabu22.thkit.ee/kippar">Kippar pealehele<br></a>
</header>
<style type="text/css">
#menyykiht{
float: left;
padding-top: 30px;
padding-right: 30px;
}
#sisukiht{
direction: flex;
float:center;
padding-top: 30px;
padding-right: 30px;
text-align: center;
align-items: center;
justify-content: center;
display: flex;
width:1300px;
height:600px;
}
#jalusekiht{
clear: left;
}
</style>
<meta charset="utf-8" />
</head>
<body>
<div id="menyykiht">
<h2>Koerad</h2>
<ul>
<?php
$kask=$yhendus->prepare("SELECT id, koeranimi, kirjeldus, pildiaadress FROM koerad");
$kask->bind_result($id, $koeranimi, $kirjeldus, $pildiaadress);
$kask->execute();
while($kask->fetch()){
echo "<li><h2><a href='?id=$id'>".
htmlspecialchars($koeranimi)."</a></h2></li>";
}
?>
</ul>
</div>
<div id="sisukiht">
<ul>
<?php
if(isSet($_REQUEST["id"])){
$kask=$yhendus->prepare("SELECT id, koeranimi, kirjeldus, pildiaadress FROM koerad
WHERE id=?");
//Kysim2rgi asemele pannakse aadressiribalt tulnud id,
//eeldatakse, et ta on tyybist integer (i).
//(double - d, string - s)
$kask->bind_param("i", $_REQUEST["id"]);
$kask->bind_result($id, $koeranimi, $kirjeldus, $pildiaadress);
$kask->execute();
if($kask->fetch()){
echo "<h2>".htmlspecialchars($koeranimi)."</h2>";
echo htmlspecialchars($kirjeldus)."<br><br>";
echo  "<a href=\"koerad.php\"><img style=\"width: 800px; height: 500px\" src=$pildiaadress  /></a>";
} else {
echo "Vigased andmed.";
}
} else {
echo "Tere tulemast avalehele! Vali men&uuml;&uuml;st sobiv teema.";
}
?>
</div>
<?php
$yhendus->close();
?>

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
<footer>Karl Haabu, TARge22</footer>