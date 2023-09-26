<link rel="icon" href="favicon.png" sizes="16x16" type="image/png">
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width-device-width, initial scale=1.0">
  <title>Kippar (Karl Haabu)</title>
</head>
<header>
<a href="https://karl-hendrikhaabu22.thkit.ee"><button class="btn"><i class="fa fa-home"></i> Home</button><br></a>
</header>
<body style="display: flex; justify-content: center; background-color: gray; text-align: center">
  <span style="font-size: 40px;">
  <h1>Kippar ülesannete tabelid <br/>zone serveris:</h1>
<p style="display: flex; justify-content: center; background-color: black; margin: 0 auto; height: 100%; width: 40%; border-radius: 40px">
<span style=" font-size: 40px; padding-top: 12px; padding-bottom: 12px">
  <?php
  echo '<a href="https://karl-hendrikhaabu22.thkit.ee/kippar/teated.php">Teadete Loetelu<br></a>';
  echo '<a href="https://karl-hendrikhaabu22.thkit.ee/kippar/kassid.php">Kassid<br></a>';
  echo '<a href="https://karl-hendrikhaabu22.thkit.ee/kippar/koerad.php">Koerad<br></a>';
  ?>
</p>
</body>
<footer>Karl Haabu, TARge22</footer>
</html>


<style>
footer {
  text-align: center;
  align-items: center;
  justify-content: left;
  font-size: 25px;
  background-color: lightGray;
  color: black;
  position: fixed;
  bottom: 0px;
  display: flex;
  height: 40px;
  width: 100%;
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
}
html {
  height: 100%;
}
body {
  min-height: 100%;
  display: flex;
  flex-direction: column;
}
.content {
  flex: 1;
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
</style>