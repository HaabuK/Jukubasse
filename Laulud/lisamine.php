<?php
require ($_SERVER["DOCUMENT_ROOT"]."/../config.php");
global $yhendus;
if(!empty($_REQUEST["uuepealkiri"])){
$kask=$yhendus->prepare(
"INSERT INTO laulud(pealkiri, lisamisaeg, kommentaarid) VALUES(?, NOW(), ' ')");
$kask->bind_param("s", $_REQUEST["uuepealkiri"]);
$kask->execute();
echo $yhendus->error;
header("Location: $_SERVER[PHP_SELF]");
$yhendus->close();
exit();
}
?>
<!doctype html>
<html>
<head>
<title>Laulud</title>
</head>
<body>
<h1>Laulud</h1>
<form action="?">
Uue laulu pealkiri:
<input type="text" name="uuepealkiri" />
<input type="submit" value="Lisa laul" />
</form>
</body>
</html>
<?php
$yhendus->close();
?>
