<?php

require "DbCon.php";

session_start();
$db=new DbCon();
$db->Connection("utnyilvantartas");

if(isset($_POST["submit"]) && isset($_POST["user"]) && isset($_POST["pw"]))
{
    $user=$_POST["user"];

    $pw=$_POST["pw"];
    
    if($db->Bejelentkezes($user,$pw))
    {
        $_SESSION["username"]=$user;
        $_SESSION["iduser"]=$db->userID($user);
        header("Location: rogzit.php");
    }
    else
    {
        $db=null;
        header("Location: index.php");
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

<div id="form_div">
<form id="loginform" action="" method="POST">
Név:<br>
<input type="text" id="user" name="user" placeholder="Írja be a felhasználónevét!" required/><br>
Jelszó:<br>
<input type="password" id="pw" name="pw" placeholder="Írja be a jelszavát!" required/><br>
<input type="submit" id="submit" name="submit" value="Belépés"/>
</form>
</div>

</body>

</html>