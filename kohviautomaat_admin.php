<?php
require ($_SERVER["DOCUMENT_ROOT"]."/../config.php");
global $yhendus;

if(isSet($_REQUEST["uuenimi"])){ //LISAMINE
  $kask=$yhendus->prepare(
  "INSERT INTO kohviautomaat(jooginimi, topsepakis) VALUES(?, ?)");
  $kask->bind_param("ss", $_REQUEST["jooginimi"], $_REQUEST["topsepakis"]);
  $kask->execute();
  header("Location: $_SERVER[PHP_SELF]");
  $yhendus->close();
  exit();
  }

  if(isSet($_REQUEST["tuhjaks_id"])){ //Tühjendamine
  $kask=$yhendus->prepare("UPDATE kohviautomaat SET topsejuua=0 WHERE id=?");
  $kask->bind_param("i", $_REQUEST["tuhjaks_id"]);
  $kask->execute();
  header("Location: $_SERVER[PHP_SELF]");
  }

  if(isSet($_REQUEST["lisa_id"])){ //Täitmine
  $kask=$yhendus->prepare("UPDATE kohviautomaat SET topsejuua=topsepakis WHERE id=?");
  $kask->bind_param("i", $_REQUEST["lisa_id"]);
  $kask->execute();
  header("Location: $_SERVER[PHP_SELF]");
  }

  if(isSet($_REQUEST["lisa_koik"])){ //Täida kõik
    $kask=$yhendus->prepare("UPDATE kohviautomaat SET topsejuua=topsepakis WHERE topsejuua=0");
    $kask->execute();
    header("Location: $_SERVER[PHP_SELF]");
  }
  
  if(isSet($_REQUEST["kustuta_id"])){ //kustutamine
    $kask=$yhendus->prepare("DELETE FROM kohviautomaat WHERE id=?");
    $kask->bind_param("i", $_REQUEST["kustuta_id"]);
    $kask->execute();
    header("Location: $_SERVER[PHP_SELF]");
  }
  ?>
  <!doctype html>
  <html>
  <head>
  <title>Joogiautomaat admin</title>
  </head>
  <style>
  <?php include 'style.css'; ?>
  body{
  height: 100vh;
  overflow-x: hidden;
  overflow-y: hidden;
  margin-top: 50px;
  margin-bottom: 50px;
  
  background-image: url("taust2.jpg");
  background-position: bottom;
  background-repeat: no-repeat;
  background-size: cover;
  }
  table tr:nth-child(odd) {
    background-color:rgba(0, 0, 0, .5);;
  }
  table tr:nth-child(even) {
    background-color:rgba(0, 0, 0, .9);;
  }
  </style>
  <header>
  <a href="https://karl-hendrikhaabu22.thkit.ee/kippar"><button class="btn"><i class="fa fa-home"></i> Kippar</button><br></a>
  <a href="https://karl-hendrikhaabu22.thkit.ee/kippar/kohviautomaat.php"><button class="btn"><i class="fa fa-home"></i> Joogiautomaat</button><br></a>
  </header>
  <body>
  <h1 style='color: white; font-size: 40px'>Joogiautomaadi haldus</h1>
  <table>
  <form action="?">
  <input type="hidden" name="uuenimi"/>
  <dt style="color: white; font-size: 25px" >Uue Joogi nimi:</dt>
  <input  type="text" name="jooginimi" style="font-size: 25px"/><br>
  <dt style="color: white; font-size: 25px" >Täitepaki suurus:</dt>
  <input type="number" name="topsepakis" style="font-size: 25px"/><br><br>
  <input type="submit" value="Lisa uus jook" style="font-size: 25px" />
  <br>
  </form>
  <?php
  $kask=$yhendus->prepare("SELECT id, jooginimi, topsepakis, topsejuua FROM kohviautomaat");
  $kask->bind_result($id, $jooginimi, $topsepakis, $topsejuua);
  $kask->execute();
  while($kask->fetch()){
  $pealkiri=htmlspecialchars($jooginimi);
  $lisamistekst="Lisa $topsepakis";
  $lisamisparam="lisa_id";
  $kustutamisparam="kustuta_id";
  $kustutamistekst="KUSTUTA";
  if($topsejuua >= 1){
  $lisamistekst="Tühjenda";
  $lisamisparam="tuhjaks_id";
  $kustutamisparam="";
  $kustutamistekst="";
  }
  echo "<tr>
  <td style='color: white; padding-right:40px; font-size: 30px'>$jooginimi</td>
  <td style='color: white; padding-right:40px; font-size: 30px'>$topsejuua</td>
  <td><a href='?$lisamisparam=$id' style='color: white; padding-right:40px; font-size: 30px'>$lisamistekst</a></td>
  <td><a href='?$kustutamisparam=$id' style='color: white; font-size: 30px; background: red'>$kustutamistekst</a></td>
  </tr>";
  }
  echo "<br><a href='?lisa_koik' style='color: green; font-size: 30px'>Lisa kõikidele tühjadele pakk</a></br><br>";
  ?>
  </table>
  </body>
  </html>
  <?php
  $yhendus->close();
  ?>
  
  <footer>Karl Haabu, TARge22</footer>