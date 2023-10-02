<?php
require ($_SERVER["DOCUMENT_ROOT"]."/../config.php");
global $yhendus;
if(isSet($_REQUEST["uusleht"])){
  $kask=$yhendus->prepare("INSERT INTO syndmused (syndmus, algus, lopp) VALUES (?, ?, ?)");
  $kask->bind_param("sss", $_REQUEST["syndmus"], $_REQUEST["algus"], $_REQUEST["lopp"]);
  $kask->execute();
  header("Location: $_SERVER[PHP_SELF]");
  $yhendus->close();
  exit();
  }
  if(isSet($_REQUEST["kustutusid"])){
  $kask=$yhendus->prepare("DELETE FROM syndmused WHERE id=?");
  $kask->bind_param("i", $_REQUEST["kustutusid"]);
  $kask->execute();
  }
?>
<style>
  <?php include 'style.css'; ?>
  #menyykiht{
background-color: lightgray;
border-radius:20px;
float: left;
margin-top: 40px;
margin-right: 30px;
padding-left:10px;
padding-bottom:10px;
width:20%;
max-height: 60%;
overflow-x: auto;
}
body{
height: 100vh;
overflow-y: hidden;
overflow-x: hidden;


background-image: url("taust1.jpg");
background-position: bottom;
background-repeat: no-repeat;
background-size: cover;
}
#sisukiht{
direction: flex;
float:center;
margin-top: 80px;
padding-top: -40px;
text-align: center;
align-items: center;
justify-content: center;
display: flex;
width:70%;
height:70%;
background-color: lightgray;
border-radius:20px;
}
</style>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width-device-width, initial scale=1.0">
  <title>Ajakava Admin</title>
</head>
<header>
<a href="https://karl-hendrikhaabu22.thkit.ee/kippar"><button class="btn"><i class="fa fa-home"></i> Kippar</button><br></a>
<a href="https://karl-hendrikhaabu22.thkit.ee/kippar/syndmused.php"><button class="btn"><i class="fa fa-home"></i> Ajakava</button><br></a>
<a href="https://karl-hendrikhaabu22.thkit.ee/kippar/peolist.php"><button class="btn"><i class="fa fa-home"></i> Peolist</button><br></a>
</header>
<meta charset="utf-8" />
</head>
<body>
<div id="menyykiht">
<h2><a style="color: black" href="https://karl-hendrikhaabu22.thkit.ee/kippar/syndmusadmin.php"> Ajakavas:</a></h2>
<ul>
<?php
$kask=$yhendus->prepare("SELECT id, syndmus, algus, lopp FROM syndmused ORDER BY algus ASC");
$kask->bind_result($id, $syndmus, $algus, $lopp);
$kask->execute();
while($kask->fetch()){
echo "<li><h2><a style=\"color: black\"; href='?id=$id'>".
htmlspecialchars($syndmus)."</a></h2></li>";
}
?>
</ul>
<a href='?lisamine=jah'><button class="nupp"><i class="fa fa-home"></i> Lisa..</button></a>
</div>
<div id="sisukiht">
<ul>
<?php
if(isSet($_REQUEST["id"])){
  $kask=$yhendus->prepare("SELECT id, syndmus, algus, lopp FROM syndmused
WHERE id=?");
$kask->bind_param("i", $_REQUEST["id"]);
$kask->bind_result($id, $syndmus, $algus, $lopp);
$kask->execute();
if($kask->fetch()){
  $algusnew=  date("Y-m-d H:i",strtotime(str_replace('/', '-', $algus )));
  $loppnew=  date("H:i",strtotime(str_replace('/', '-', $lopp )));
  $loppaeg=  strtotime(date("H:i:s",strtotime(str_replace('/', '-', $lopp ))));
  $algusaeg=  strtotime(date("H:i:s",strtotime(str_replace('/', '-', $algus ))));
echo "<h2 style=\"font-size:40px\">".htmlspecialchars($syndmus)."<br><br></h2>";
echo "<h2 style=\"font-size:30px\">"."Algus: ".$algusnew."<br></h2>";
echo "<h2 style=\"font-size:30px\">"."Lõpp: ".$loppnew."<br></h2>";
echo "<h2 style=\"font-size:30px\">".round(($loppaeg - $algusaeg) / 60). " minutit"."<br></h2>";
echo "<br /><a href='?kustutusid=$id'><button class=\"del\"><i class==\"fa fa-home\"></i>Kustuta</button></a>";
} else {
echo "Vigased andmed.";
}
}
else if(isSet($_REQUEST["lisamine"])){
  ?>
  <form action='?'>
  <input type="hidden" name="uusleht" value="jah" />
  <h2>Sündmuse lisamine</h2>
  <dl>
  <dt>Nimetus:</dt>
  <dd>
  <input style="margin-right: 40px; margin-bottom: 10px;" type="text" name="syndmus" />
  </dd>
  <dt>Algus aeg:</dt>
  <dd>
  <input style="margin-right: 40px; margin-bottom: 10px;" type="datetime-local" name="algus" />
  </dd>
  <dt>Lõpp aeg:</dt>
  <dd>
  <input style="margin-right: 40px; margin-bottom: 10px;" type="datetime-local" name="lopp" />
  </dd>
  </dl>
  <input type="submit" value="sisesta">
  </form>
  <?php
  }else {
    echo "Tere tulemast avalehele! Vali men&uuml;&uuml;st sündmus.";
  } 
  ?>
  </div>
<?php
$yhendus->close();
?>
<footer>Karl Haabu, TARge22</footer>