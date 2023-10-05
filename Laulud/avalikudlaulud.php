<?php
require ($_SERVER["DOCUMENT_ROOT"]."/../config.php");
global $yhendus;

?>
<!doctype html>
<html>
<head>
<title>Laulud</title>
</head>
<body>
<h1>Laulud</h1>
<table>
<?php
$kask=$yhendus->prepare(
"SELECT id, pealkiri, punktid FROM laulud WHERE avalik=1");
$kask->bind_result($id, $pealkiri, $punktid);
$kask->execute();
while($kask->fetch()){
$pealkiri=htmlspecialchars($pealkiri);
echo "<tr>
<td>$pealkiri</td>
<td>$punktid</td>
</tr>";
}
?>
</table>
</body>
</html>
<?php
$yhendus->close();
?>
