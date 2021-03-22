<?php

    class DbCon
    {
        protected $host;
        protected $user;
        protected $pwd;
        protected $con;

        function __construct()
        {
            $this->host="localhost";
            $this->user="root";
            $this->pwd="";
        }

        function __destruct()
        {
        }

        function Connection($dbname)
        {
            try{
                $this->con=new PDO("mysql:host=$this->host;dbname=$dbname",$this->user, $this->pwd);
                $this->con->exec("set names 'UTF8'");
            }
            catch(PDOException $e)
            {
                die("<h1>Kapcsolódási hiba</h1><p>$e</p>");
            }
        }

        function Bejelentkezes($user,$pwd)
        {
        $res=$this->con->prepare("SELECT Nev, Jelszo FROM `users` WHERE Nev= :pNev AND Jelszo= :pPwd");

        // Paraméterek beállítása
        $res->bindparam("pNev", $user);
        $res->bindparam("pPwd", $pwd);

        // SQL parancs futtatása
        $row=$res->execute();
        $row=$res->fetch();

        if($row>0)
        {
           return true;
        }
        else
        {
            return false;
        }
    }

        function hossz($honnan,$hova)
	    {
		$megfelel = false;
		if (strlen($honnan)>=3 && strlen($hova)>=3) {
			$megfelel = true;
		}
		return $megfelel;
	    }

        function rogzites($userid, $datum, $honnan, $hova, $mkm)
	    {
		$res = $this->con->prepare("insert into utak (ID_user, Datum, Honnan, Hova, km) values (:ID, :datum, :honnan, :hova, :km)");
		$res->bindParam(":ID", $userid);
		$res->bindParam(":datum", $datum);
		$res->bindParam(":honnan", $honnan);
		$res->bindParam(":hova", $hova);
		$res->bindParam(":km", $mkm);
		$res->execute();
	    }

        function userID($username)
	    {
		$userID;
		$res = $this->con->prepare("SELECT ID_user FROM users WHERE Nev = :Nev");
        $res->bindParam(":Nev", $username);
		$res->execute();
		while ($row = $res->fetch()) {
			$userID = $row["ID_user"];
		}
		return $userID;
    	}

        function showData($uid, $h1, $h2)
	    {
		$tomb=null;
		$res = $this->con->prepare("select * from utak where (ID_user = :Iduser) and (Honnan like :honnan) and (Hova like :hova)");
		$res->bindParam(':Iduser', $uid);
		$res->bindParam(':honnan', $h1);
		$res->bindParam(':hova', $h2);
		$res->execute();
		while ($row = $res->fetch()) {
			$tomb[] = $row;
		}
		return $tomb;
	    }

   
    }

    

?>