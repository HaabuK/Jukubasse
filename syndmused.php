<?php
require ($_SERVER["DOCUMENT_ROOT"]."/../config.php");
global $yhendus;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width-device-width, initial scale=1.0">
  <title>Ajakava</title>
</head>
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
  }
  body{
  display: flex;
  flex-direction: column;
  justify-content: center; 
  text-align: center;
  height: 100vh;
  overflow-x: hidden;
  overflow-y: hidden;
  
  background-image: url("taust1.jpg");
  background-position: bottom;
  background-repeat: no-repeat;
  background-size: cover;
  }
  #sisukiht{
  direction: flex;
  float:center;
    padding-top: 3%;
  margin-bottom: 20px;
  padding-bottom: 20px;
  text-align: center;
  align-items: top;
  justify-content: center;
  display: flex;
  overflow-x: auto;
  }
  textarea{
    margin-right: 40px;
    margin-bottom: 10px;
  }
</style>
<header>
<a href="https://karl-hendrikhaabu22.thkit.ee/kippar"><button class="btn"><i class="fa fa-home"></i> Kippar</button><br></a>
<a href="https://karl-hendrikhaabu22.thkit.ee/kippar/peokutsed.php"><button class="btn"><i class="fa fa-home"></i> Kutse ankeet</button><br></a>
</header>
<meta charset="utf-8" />
</head>
<body>
<div id="sisukiht">
<ul>
<?php
$kask=$yhendus->prepare("SELECT id, syndmus, algus, lopp FROM syndmused ORDER BY algus ASC");
$kask->bind_result($id, $syndmus, $algus, $lopp);
$kask->execute();
while($kask->fetch()){
  $algusnew=  date("Y-m-d H:i",strtotime(str_replace('/', '-', $algus )));
  $loppnew=  date("H:i",strtotime(str_replace('/', '-', $lopp )));
  echo "<h2 style=\"font-size:40px\">".htmlspecialchars($syndmus)."<br></h2>";
  echo "<h2 style=\"font-size:30px\">".($algusnew)." - ".($loppnew)."<br></h2>";
  echo "<hr />";
}
  ?>
  </div>
<?php
$yhendus->close();
?>
<footer>Karl Haabu, TARge22</footer>