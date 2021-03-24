<?php
echo("test transaction commencé ");
    $a=0;
    $userId=$_SESSION["user"];
    $username=BDD::get()->query("SELECT `user_last_name` FROM `users` WHERE `user_id`= $userId")->fetchAll();
    $dbname=hash("MD5",$username[0]["user_last_name"]);
    $dbh = (new PDO('mysql:host=localhost;dbname='.$dbname.';charset=utf8', 'root', '',array(PDO::ATTR_PERSISTENT => true)));
    echo "Connecté\n";
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_AUTOCOMMIT,0);
    $dbh->beginTransaction();
    $dbh->exec("insert into type_piece (REFERENCE_TYPE_PIECE, LIBELLE_TYPE_PIECE) values ('TEST', 'REUSSIS')");
    $dbh->rollBack();
    
      


?>