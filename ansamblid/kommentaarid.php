<?php
require ($_SERVER["DOCUMENT_ROOT"]."/../config.php");
global $yhendus;

if(isSet($_REQUEST["uue_kommentaari_id"])){
$kask=$yhendus->prepare(
"UPDATE ansamblid SET kommentaarid=CONCAT(kommentaarid, ?) WHERE id=?");
$kommentaarilisa=$_REQUEST["uus_kommentaar"]."\n".date("Y/m/d H:i");
$kask->bind_param("si", $kommentaarilisa, $_REQUEST["uue_kommentaari_id"]);
$kask->execute();
header("Location: $_SERVER[PHP_SELF]");
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
$kask=$yhendus->prepare(
"SELECT id, ansamblinimi, kommentaarid FROM ansamblid");
$kask->bind_result($id, $ansamblinimi, $kommentaarid);
$kask->execute();
while($kask->fetch()){
$pealkiri=htmlspecialchars($ansamblinimi);
$kommentaarid=nl2br(htmlspecialchars($kommentaarid));
echo "<tr>
<td>$ansamblinimi</td>
<td>$kommentaarid</td>
<td>
<form action='?'>
<input type='hidden' name='uue_kommentaari_id' value='$id' />
<input type='text' name='uus_kommentaar' />
<input type='submit' value='Lisa kommentaar' />
</form>
</td>
</tr>";
}
?>
</table>
</body>
</html>
<?php
$yhendus->close();
?>