<?php
require ($_SERVER["DOCUMENT_ROOT"]."/../config.php");
global $yhendus;
if(isSet($_REQUEST["uusleht"])){
  $kask=$yhendus->prepare("INSERT INTO peokylalised (eesnimi, perenimi, epost) VALUES (?, ?, ?)");
  $kask->bind_param("sss", $_REQUEST["eesnimi"], $_REQUEST["perenimi"], $_REQUEST["epost"]);
  $kask->execute();
  header("Location: $_SERVER[PHP_SELF]");
  $yhendus->close();
  exit();
  }
  if(isSet($_REQUEST["kustutusid"])){
  $kask=$yhendus->prepare("DELETE FROM peokylalised WHERE id=?");
  $kask->bind_param("i", $_REQUEST["kustutusid"]);
  $kask->execute();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width-device-width, initial scale=1.0">
  <title>Peokülalised</title>
</head>
<header>
<a href="https://karl-hendrikhaabu22.thkit.ee/kippar"><button class="btn"><i class="fa fa-home"></i> Kippar</button><br></a>
</header>
<meta charset="utf-8" />
</head>
<body>
<div id="menyykiht">
<h2><a style="color: black" href="https://karl-hendrikhaabu22.thkit.ee/kippar/peolist.php"> Peole registreerunud</a></h2>
<ul>
<?php
$kask=$yhendus->prepare("SELECT id, eesnimi, perenimi, epost FROM peokylalised");
$kask->bind_result($id, $eesnimi, $perenimi, $epost);
$kask->execute();
while($kask->fetch()){
echo "<li><h2><a style=\"color: black\"; href='?id=$id'>".
htmlspecialchars($eesnimi)." ".htmlspecialchars($perenimi)."</a></h2></li>";
}
?>
</ul>
<a href='?lisamine=jah'><button class="nupp"><i class="fa fa-home"></i> Lisa..</button></a>
</div>
<div id="sisukiht">
<ul>
<?php
if(isSet($_REQUEST["id"])){
$kask=$yhendus->prepare("SELECT id, eesnimi, perenimi, epost FROM peokylalised
WHERE id=?");
$kask->bind_param("i", $_REQUEST["id"]);
$kask->bind_result($id, $eesnimi, $perenimi, $epost);
$kask->execute();
if($kask->fetch()){
echo "<h2 style=\"font-size:40px\">".htmlspecialchars($eesnimi)." ".htmlspecialchars($perenimi)."<br><br></h2>";
echo "<h2 style=\"font-size:30px\">"."Eesnimi: ".htmlspecialchars($eesnimi)."<br></h2>";
echo "<h2 style=\"font-size:30px\">"."Perekonna nimi: ".htmlspecialchars($perenimi)."<br></h2>";
echo "<h2 style=\"font-size:30px\">"."E-mail: ".htmlspecialchars($epost)."<br></h2>";
echo "<br /><a href='?kustutusid=$id'><button class=\"del\"><i class==\"fa fa-home\"></i>Kustuta</button></a>";
} else {
echo "Vigased andmed.";
}
}
else if(isSet($_REQUEST["lisamine"])){
  ?>
  <form action='?'>
  <input type="hidden" name="uusleht" value="jah" />
  <h2>Külalise lisamine</h2>
  <dl>
  <dt>Eesnimi:</dt>
  <dd>
  <input style="margin-right: 40px; margin-bottom: 10px;" type="text" name="eesnimi" />
  </dd>
  <dt>Perekonna nimi:</dt>
  <dd>
  <input style="margin-right: 40px; margin-bottom: 10px;" type="text" name="perenimi" />
  </dd>
  <dt>E-mail:</dt>
  <dd>
  <input style="margin-right: 40px; margin-bottom: 10px;" type="email" name="epost" />
  </dd>
  </dl>
  <input type="submit" value="sisesta">
  </form>
  <?php
  }else {
    echo "Tere tulemast avalehele! Vali men&uuml;&uuml;st registreerunu.";
  } 
  ?>
  </div>
<?php
$yhendus->close();
?>

<style>
#menyykiht{
background-color: lightgray;
border-radius:20px;
float: left;
margin-top: 40px;
margin-right: 30px;
padding-left:10px;
padding-bottom:10px;
width:20%;
}
body{
height: 100vh;
overflow-y: hidden;


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

.nupp {
  background-color: gray; 
  border: none; 
  color: black; 
  padding: 11px 20px; 
  font-size: 16px; 
  cursor: pointer;
  border-radius:20px
}

.nupp:hover {
  background-color: black;
  color: white;
}
.del {
  background-color: #FF9A84; 
  border: none; 
  color: black; 
  padding: 11px 20px; 
  font-size: 16px; 
  cursor: pointer;
  border-radius:20px
}

.del:hover {
  background-color: red;
  color: black;
}
::selection{
  color: green;
}
</style>
<footer>Karl Haabu, TARge22</footer>