<?php
require ($_SERVER["DOCUMENT_ROOT"]."/../config.php");
global $yhendus;
if(!empty($_REQUEST["uuenimi"])){
$kask=$yhendus->prepare(
"INSERT INTO ansamblid(ansamblinimi) VALUES(?)");
$kask->bind_param("s", $_REQUEST["uuenimi"]);
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
<title>Ansamblid</title>
</head>
<body>
<h1>Ansamblid</h1>
<form action="?">
Uue ansambli nimi:
<input type="text" name="uuenimi" />
<input type="submit" value="Lisa ansambel" />
</form>
</body>
</html>
<?php
$yhendus->close();
?>
