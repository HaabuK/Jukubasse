<?php
require ($_SERVER["DOCUMENT_ROOT"]."/../config.php");
global $yhendus;

//LAULUD
if(isSet($_REQUEST["healaulu_id"])){
  $punktid = isSet($_REQUEST["punktid"]) ? intval($_REQUEST[$punktid]) % 4 : 1;
$kask=$yhendus->prepare("UPDATE laulud SET punktid=punktid+? WHERE id=?");
$kask->bind_param("ii", $_REQUEST["healaulu_id"]);
$kask->execute();
header("Location: $_SERVER[PHP_SELF]");
}

  //ANSAMBLID
if(isSet($_REQUEST["heaansambli_id"])){
  $punktid = isSet($_REQUEST["punktid"]) ? intval($_REQUEST[$punktid]) % 4 : 1;
$kask=$yhendus->prepare("UPDATE ansamblid SET punktid=punktid+? WHERE id=?");
$kask->bind_param("ii", $_REQUEST["heaansambli_id"]);
$kask->execute();
header("Location: $_SERVER[PHP_SELF]");
}
?>
<!doctype html>
<html>
<head>
<title>Punktid</title>
</head>
<body>
<h1>Laulud</h1>
<table>
<?php
$kask=$yhendus->prepare("SELECT id, pealkiri, punktid FROM laulud WHERE avalik=1");
$kask->bind_result($id, $pealkiri, $punktid);
$kask->execute();
while($kask->fetch()){
$pealkiri=htmlspecialchars($pealkiri);
echo "<tr>
<td>$pealkiri</td>
<td>$punktid</td>
<td><a href='?healaulu_id=$id'>Lisa punkt</a></td>
<td><a href='?healaulu_id=$id&punktid=2'>Lisa 2 punkti</a></td>
<td><a href='?healaulu_id=$id&punktid=3'>Lisa 3 punkti</a></td>
</tr>";
}
?>
</table>
<h1>Ansamblid</h1>
<table>
<?php
$kask=$yhendus->prepare("SELECT id, ansamblinimi, punktid FROM ansamblid");
$kask->bind_result($id, $ansamblinimi, $punktid);
$kask->execute();
while($kask->fetch()){
$pealkiri=htmlspecialchars($ansamblinimi);
echo "<tr>
<td>$ansamblinimi</td>
<td>$punktid</td>
<td><a href='?heaansambli_id=$id'>Lisa punkt</a></td>
<td><a href='?heaansambli_id=$id&punktid=2'>Lisa 2 punkti</a></td>
<td><a href='?heaansambli_id=$id&punktid=3'>Lisa 3 punkti</a></td>
</tr>";
}
?>
</table>
</body>
</html>
<?php
$yhendus->close();
?>
