<?php

session_start();
require "DbCon.php";

$db=new DbCon();
$db->Connection("utnyilvantartas");

if(isset($_POST["submit"]) && isset($_POST["date"]) && isset($_POST["honnan"]) && isset($_POST["hova"]) && isset($_POST["km"]))
{
    $datum=$_POST["date"];
    $honnan=$_POST["honnan"];
    $hova=$_POST["hova"];
    $km=$_POST["km"];
    $userid=$db->userID($_SESSION["username"]);
    
    if($db->hossz($honnan,$hova) && is_numeric($km))
    {
        $db->rogzites($userid,$datum,$honnan,$hova,$km);
    }
    else
    {
        echo '<script language="javascript">';
        echo 'alert("A Honnan-Hova mezőbe minimum 3 karakter kell, a kilométert számban kell megadni!")';
        echo '</script>';
    }
    
}


?>

<DOCTYPE html>
<html>

<head>
<title>Útnyilvántartás</title>
<link rel="stylesheet" href="index.css">
</head>

<body>
<ul>
  <li class="menu"><a class="active" href="rogzit.php">Rögzítés</a></li>
  <li class="menu"><a href="kimutatas.php">Kimutatás</a></li>
  <li class="menu"><a href="index.php">Kilépés</a></li>
</ul>

<div id="rogzit_div">
<form id="rogzit_form" action="" method="POST">
Dátum:<br>
<input type="date" id="date" name="date" required/><br>
Honnan:<br>
<input type="text" id="honnan" name="honnan" placeholder="Honnan" required/><br>
Hova:<br>
<input type="text" id="hova" name="hova" placeholder="Hova" required/><br>
Km:<br>
<input type="text" id="km" name="km" placeholder="Km" required/><br>
<input type="submit" id="submit" name="submit" value="Rögzítés"/>
</form>
</div>

</body>

</html>