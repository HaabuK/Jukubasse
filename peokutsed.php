<?php
require ($_SERVER["DOCUMENT_ROOT"]."/../config.php");
global $yhendus;
if(isSet($_REQUEST["uusleht"])){
  $kask=$yhendus->prepare("INSERT INTO peokylalised (eesnimi, perenimi, epost) VALUES (?, ?, ?)");
  $kask->bind_param("sss", $_REQUEST["eesnimi"], $_REQUEST["perenimi"], $_REQUEST["epost"]);
    if(strlen($_REQUEST["eesnimi"]) == 0){
        header("Location: $_SERVER[PHP_SELF]");
        $yhendus->close();
        exit();
    } else{
        $kask->execute();
        header("Location: $_SERVER[PHP_SELF]");
        $yhendus->close();
        exit();
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width-device-width, initial scale=1.0">
  <title>Peokuulutus</title>
</head>
<header>
<a href="https://karl-hendrikhaabu22.thkit.ee/kippar"><button class="btn"><i class="fa fa-home"></i> Kippar</button><br></a>
</header>
<meta charset="utf-8" />
</head>
<body>
<div id="sisukiht">
<ul>
<?php
$kask=$yhendus->prepare("SELECT id, eesnimi, perenimi, epost FROM peokylalised");
$kask->bind_result($id, $eesnimi, $perenimi, $epost);
$kask->execute();
if(isSet($_REQUEST["lisamine"])){
  ?>
  <form action='?'>
  <input type="hidden" name="uusleht" value="jah" />
  <h1>Nimekirja lisamine</h1>
  <dl>
  <dt style="font-size: 25px">Eesnimi:</dt>
  <dd>
  <input style="margin-right: 40px; margin-bottom: 10px; font-size: 25px" type="text" name="eesnimi" />
  </dd>
  <dt style="font-size: 25px">Perekonnanimi:</dt>
  <dd>
  <input style="margin-right: 40px; margin-bottom: 10px; font-size: 25px" type="text" name="perenimi" />
  </dd>
  <dt style="font-size: 25px">E-posti aadress:</dt>
  <dd>
  <input style="margin-right: 40px; margin-bottom: 10px; font-size: 25px" type="text" name="epost" />
  </dd>
  </dl>
  <br>
  <button class="nupp" type="submit" value="sisesta">Saada</button>
  <a href="https://karl-hendrikhaabu22.thkit.ee/kippar/peokutsed.php"><button class="nupp"><i class="fa fa-home"></i> Tagasi</button><br></a>
  </form>
  <?php
  }else {
    echo "<h1>"."Tere tulemast!"."<br><br>"." Lisa ennast nimekirja!"."<h1>";
    ?>
    <a href='?lisamine=jah'><button class="nupp"><i class="fa fa-home"></i> Lisa..</button></a>
    <a href="https://karl-hendrikhaabu22.thkit.ee/kippar/syndmused.php"><button class="nupp"><i class="fa fa-home"></i> Ajakava</button></a>
    <?php
  }
  ?>
  </div>
<?php
$yhendus->close();
?>

<style>
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
padding-top: 40px;
padding-right: 30px;
text-align: center;
align-items: center;
justify-content: center;
display: flex;
height:100%;
}
textarea{
  margin-right: 40px;
  margin-bottom: 10px;
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