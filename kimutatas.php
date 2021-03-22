<?php
session_start();
require "DbCon.php";

$listara = false;
if (isset($_POST["kimu"])) {
    
    $db=new DbCon();
    $db->Connection("utnyilvantartas");
    $tomb2=null;
    
    $user=$_SESSION["username"];
    $uid = $_SESSION["iduser"];
    $honnan = $_POST["honnan"];
    $hova = $_POST["hova"];
    

    $tomb2 = $db->showData($uid, $honnan, $hova);
    $listara = true;
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

<form action="" method="post">
            <div class="form-group">
                <label for="honnan">Honnan</label>
                <input type="text" name="honnan" id="honnan" class="form-control">
            </div>

            <div class="form-group">
                <label for="hova">Hova</label>
                <input type="text" name="hova" id="hova" class="form-control">
            </div>
            <p></p>

            <button type="submit" name="kimu" id="kimu" class="button button-success">Kimutatás</button>

        </form>

        <div class="col-12 bg-secondary">
            <?php
            if ($listara) {
                echo "ID_user=" . $uid . " USERNAME= " . $user . " utazásai";
                ?>
                <table class="text-left">
                    <tr>
                        <th style="width:100px">Dátum</th>
                        <th style="width:250px">Honnan</th>
                        <th style="width:250px">Hova</th>
                        <th style="width:20px">km</th>
                        <?php
                            foreach ($tomb2 as $key) {
                                echo "<tr><td>" . $key['Datum'] . "</td><td>" . $key['Honnan'] . "</td><td>" . $key['Hova'] . "</td><td>"  . $key['km'] . "</td></tr>";
                            }
                        ?>
                </table>
            <?php
            }
            ?>
        </div>


</body>

</html>