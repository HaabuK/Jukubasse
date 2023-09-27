<?php
require ($_SERVER["DOCUMENT_ROOT"]."/../config.php");
global $yhendus;
if(isSet($_REQUEST["uusleht"])){
  $kask=$yhendus->prepare("INSERT INTO koerad (koeranimi, kirjeldus, pildiaadress) VALUES (?, ?, ?)");
  $kask->bind_param("sss", $_REQUEST["koeranimi"], $_REQUEST["kirjeldus"], $_REQUEST["pildiaadress"]);
  $kask->execute();
  header("Location: $_SERVER[PHP_SELF]");
  $yhendus->close();
  exit();
  }
  if(isSet($_REQUEST["kustutusid"])){
  $kask=$yhendus->prepare("DELETE FROM koerad WHERE id=?");
  $kask->bind_param("i", $_REQUEST["kustutusid"]);
  $kask->execute();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width-device-width, initial scale=1.0">
  <title>Koerad</title>
</head>
<header>
<a href="https://karl-hendrikhaabu22.thkit.ee/kippar"><button class="btn"><i class="fa fa-home"></i> Kippar</button><br></a>
</header>
<style type="text/css">
#menyykiht{
float: left;
padding-top: 40px;
padding-right: 30px;
width:200px;
}
#sisukiht{
direction: flex;
float:center;
padding-top: 40px;
padding-right: 30px;
text-align: center;
align-items: center;
justify-content: center;
display: flex;
width:1200px;
height:600px;
}
</style>
<meta charset="utf-8" />
</head>
<body>
<div id="menyykiht">
<h2><a style="color: black" href="https://karl-hendrikhaabu22.thkit.ee/kippar/koerad.php">Koerad</a></h2>
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
<a href='?lisamine=jah'>Lisa ...</a>
</div>
<div id="sisukiht">
<ul>
<?php
if(isSet($_REQUEST["id"])){
$kask=$yhendus->prepare("SELECT id, koeranimi, kirjeldus, pildiaadress FROM koerad
WHERE id=?");
$kask->bind_param("i", $_REQUEST["id"]);
$kask->bind_result($id, $koeranimi, $kirjeldus, $pildiaadress);
$kask->execute();
if($kask->fetch()){
echo "<h2>".htmlspecialchars($koeranimi)."</h2>";
echo htmlspecialchars($kirjeldus)."<br><br>";
echo  "<a href=\"koerad.php\"><img style=\"width: 800px; height: 500px\" src=$pildiaadress  /></a>";
echo "<br /><a href='?kustutusid=$id'>kustuta</a>";
} else {
echo "Vigased andmed.";
}
}
else if(isSet($_REQUEST["lisamine"])){
  ?>
  <form action='?'>
  <input type="hidden" name="uusleht" value="jah" />
  <h2>Uue koera lisamine</h2>
  <dl>
  <dt>Koera nimi:</dt>
  <dd>
  <input type="text" name="koeranimi" />
  </dd>
  <dt>Kirjeldus:</dt>
  <dd>
  <textarea rows="10" name="kirjeldus"></textarea>
  </dd>
  <dt>Pilt:</dt>
  <dd>
  <textarea rows="10" name="pildiaadress"></textarea>
  </dd>
  </dl>
  <input type="submit" value="sisesta">
  </form>
  <?php
  }else {
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
<footer>Karl Haabu, TARge22</footer>