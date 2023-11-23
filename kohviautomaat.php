<?php
require ($_SERVER["DOCUMENT_ROOT"]."/../config.php");
global $yhendus;

  if(isSet($_REQUEST["kasuta_id"])){ //Täitmine
  $kask=$yhendus->prepare("UPDATE kohviautomaat SET topsejuua -= 1 WHERE id=?");
  $kask->bind_param("i", $_REQUEST["kasuta_id"]);
  $kask->execute();
  header("Location: $_SERVER[PHP_SELF]");
  }
  ?>
  <!doctype html>
  <html>
  <head>
  <title>Joogiautomaat</title>
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
  </header>
  <body>
  <h1 style='color: white; font-size: 40px'>Joogiautomaat</h1>
  <table>
  <?php
  $kask=$yhendus->prepare("SELECT id, jooginimi, topsepakis, topsejuua FROM kohviautomaat WHERE topsejuua >= 1");
  $kask->bind_result($id, $jooginimi, $topsepakis, $topsejuua);
  $kask->execute();
  while($kask->fetch()){
  echo "<tr>
  <td style='color: white; padding-right:40px; font-size: 30px'>$jooginimi </td>"."<br>"." 
  <td style='color: white; padding-right:40px; font-size: 30px'>Kogus alles: $topsejuua</td>
  <td ><a href='?kasuta_id=$id' style='color: green; font-size: 30px'>Telli jooki</a></td>
  </tr>";
  }
  ?>
  </table>
  </body>
  </html>
  <?php
  $yhendus->close();
  ?>
  
  <footer>Karl Haabu, TARge22</footer>