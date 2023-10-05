<?php
require ($_SERVER["DOCUMENT_ROOT"]."/../config.php");
global $yhendus;

if(isSet($_REQUEST["peitmise_id"])){
  $kask=$yhendus->prepare("UPDATE ansamblid SET avalik=0 WHERE id=?");
  $kask->bind_param("i", $_REQUEST["peitmise_id"]);
  $kask->execute();
  }
  if(isSet($_REQUEST["avamise_id"])){
  $kask=$yhendus->prepare("UPDATE ansamblid SET avalik=1 WHERE id=?");
  $kask->bind_param("i", $_REQUEST["avamise_id"]);
  $kask->execute();
  }
  if(isSet($_REQUEST["sulgekoik"])){
    $kask=$yhendus->prepare("UPDATE ansamblid SET avalik=0 WHERE punktid=0");
    $kask->execute();
    }
  ?>
  <!doctype html>
  <html>
  <head>
  <title>Ansamblid</title>
  </head>
  <body>
  <h1>Ansamblid</h1>
  <table>
  <?php
  $kask=$yhendus->prepare("SELECT id, ansamblinimi, avalik FROM ansamblid");
  $kask->bind_result($id, $ansamblinimi, $avalik);
  $kask->execute();
  while($kask->fetch()){
  $pealkiri=htmlspecialchars($ansamblinimi);
  $avamistekst="Ava";
  $avamisparam="avamise_id";
  $avamisseisund="Peidetud";
  if($avalik==1){
  $avamistekst="Peida";
  $avamisparam="peitmise_id";
  $avamisseisund="Avatud";
  }
  echo "<tr>
  <td>$ansamblinimi</td>
  <td>$avamisseisund</td>
  <td><a href='?$avamisparam=$id'>$avamistekst</a></td>
  </tr>";
  }
  echo "<br><a href='?sulgekoik'>Peida kõik 0 punktiga</a></br>";
  ?>
  </table>
  </body>
  </html>
  <?php
  $yhendus->close();
  ?>
  