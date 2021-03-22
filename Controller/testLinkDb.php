<?php


// --------------------------------CREATE A NEW BDD--------------------------------


function createBase ($dbname){
    try{
        $pdo = new PDO("mysql:host=localhost;", "root", "");
        // Set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e){
        die("ERROR: Could not connect. " . $e->getMessage());
    }
     
    // Attempt create database query execution
    try{
        $sql = "CREATE DATABASE $dbname";
        $pdo->exec($sql);
        echo "Database created successfully";
    } catch(PDOException $e){
        die("ERROR: Could not able to execute $sql. " . $e->getMessage());
    }
     
    // Close connection
    unset($pdo);
}


//---------------------------------------IMPORT .sql FILE-------------------------------------------
  

function importSqlFile($dbname){
    
    $query = file_get_contents(__DIR__."\\".$dbname.".sql");
    $con = new PDO("mysql:host=localhost;dbname=".$dbname."","root","");
    $stmt = $con->prepare($query);
    if($stmt->execute()){
        echo "Successfully imported to the demo.";
    }
    unset($con);
}


function getTables($dbname){
    $db = new PDO("mysql:host=localhost;dbname=".$dbname."","root","");
    $tables=$db->query('SHOW TABLES FROM `'.$dbname.'`')->fetchAll();
    var_dump($tables);
    unset($db);
}

function exportDatabase($host, $user, $password, $database, $targetFilePath){
    //returns true iff successfull
    return exec('mysqldump --host '. $host .' --user '. $user .' --password '. $password .' '. $database .' --result-file='.$targetFilePath) === 0;
}

//-----------------------------------------DELETE DATABASE--------------------------- 


function deleteBase($dbname){
    $db = new PDO("mysql:host=localhost;dbname=".$dbname."","root","");
    $sql=$db->prepare('DROP DATABASE `'.$dbname.'`');
    if($sql->execute()){
        echo"Table deleted";
    }else{
        print_r($sql->errorInfo());
    }
    unset($db);
}
    //createBase("demo");
    //importSqlFile("demo");
    //getTables("demo");
    //deleteBase("demo");
    //exportDatabase("localhost","root","","demo","D:\programme\wamp\www\ProjetM1S2\Projet_M1_S2_SQL\Controller");
?>


