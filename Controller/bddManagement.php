<?php
// --------------------------------CREATE A NEW BDD--------------------------------


function createBase ($dbname){
    /**
     * @param String $dbname a "string containing the name db wich will be create by the fonction is expected"
     * @return None (only creating a db)
     **/
    
    try{
        $pdo = new PDO("mysql:host=localhost;", "root", "");
        // Set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e){
        die("ERROR: Impossible de se connecter " . $e->getMessage());
    }
     
    // Attempt create database query execution
    try{
        $sql = "CREATE DATABASE $dbname";
        $pdo->exec($sql);
        return "BDD crée avec succès !";
    } catch(PDOException $e){
        die("ERROR: Impossible de faire $sql. " . $e->getMessage());
    }
     
    // Close connection
    unset($pdo);
}


//---------------------------------------IMPORT .sql FILE-------------------------------------------
  

function importSqlFile($dbname,$filename){
    
    $query = file_get_contents($filename.".sql");
    $con = new PDO("mysql:host=localhost;dbname=".$dbname."","root","");
    $stmt = $con->prepare($query);
    if($stmt->execute()){
        $msg= "Successfully imported to the demo.";
    }
    unset($con);
    return ($msg);
}

function getTables($dbname){
    $db = new PDO("mysql:host=localhost;dbname=".$dbname."","root","");
    $tables=$db->query('SHOW TABLES FROM `'.$dbname.'`')->fetchAll();
    unset($db);
    return $tables;
}

function exportDatabaseV2($database, $targetFilePath){
    $output = null;
    $output=shell_exec('D:\\programme\\wamp\\bin\\mysql\\mysql5.7.31\\bin\\mysqldump.exe -u root --password="" '.$database.' > '.$targetFilePath);//'mysqldump --host localhost --user root --password "" db_project --result-file=DatabaseBackup\mydata.sql'
    return $output;
}


//-----------------------------------------DELETE DATABASE--------------------------- 


function deleteBase($dbname){
    $db = new PDO("mysql:host=localhost;dbname=".$dbname."","root","");
    $sql=$db->prepare('DROP DATABASE `'.$dbname.'`');
    if($sql->execute()){
        $msg="Table deleted";
    }else{
        $msg=($sql->errorInfo());
    }
    unset($db);
    return ($msg);
}


function backupReplacement(){
    // create db names
    $userId=$_SESSION["user"];
    $currentExerciceId=$_GET["id"];
    $username=BDD::get()->query("SELECT `user_adress` FROM `users` WHERE `user_id`= $userId")->fetchAll();
    $exoname=BDD::get()->query("SELECT `quiz_id` FROM `quiz` WHERE `quiz_id`= $currentExerciceId")->fetchAll();
    $dbname=hash("MD5",$username[0]["user_adress"]).$exoname[0]['quiz_id'];
    $dbnameCorrec=$dbname.$exoname."Correc";

    //get storage files name
    $pathFileBackUp="DatabaseBackup\\".$dbname."backup";
    $quizname=BDD::get()->query("SELECT `quiz_database` FROM `quiz` WHERE `quiz_id`= $quizId")->fetchAll();
    $filename=$quizname[0]["quiz_database"];
    $pathFileRecup="DataBaseExercice\\".$filename;
    $filenameSql=$pathfile."sql";

    //suppression des bases  de données de test :
    deleteBase($dbname);
    deleteBase($dbnameCorrec);
    
    if(file_exists($filenameSql)){//
        createBase ($dbname);
        createBase ($dbnameCorrec);
        importSqlFile($dbname,$pathfile);
        importSqlFile($dbnameCorrec,$pathfile);
    }else{
        createBase ($dbname);
        createBase ($dbnameCorrec);
        importSqlFile($dbname,$pathFileRecup);
        importSqlFile($dbnameCorrec,$pathFileRecup);
    }
}
function newBackup(){
    $userId=$_SESSION["user"];
    $currentExerciceId=$_GET["id"];
    $username=BDD::get()->query("SELECT `user_adress` FROM `users` WHERE `user_id`= $userId")->fetchAll();
    $exoname=BDD::get()->query("SELECT `quiz_id` FROM `quiz` WHERE `quiz_id`= $currentExerciceId")->fetchAll();
    $dbname=hash("MD5",$username[0]["user_adress"]).$exoname[0]['quiz_id'];
    $dbnameCorrec=$dbname.$exoname."Correc";

    //get storage files name
    $pathFileBackUp="DatabaseBackup\\".$dbname."backup";
    $quizname=BDD::get()->query("SELECT `quiz_database` FROM `quiz` WHERE `quiz_id`= $quizId")->fetchAll();
    $filename=$quizname[0]["quiz_database"];
    $pathFileRecup="DataBaseExercice\\".$filename;
    $filenameSql=$pathfile."sql";
    exportDatabaseV2($database, $targetFilePath);
}
    //createBase("cycle_v3");
    //importSqlFile("cycle_v3","cycle_v3");
    //getTables("demo");
    //deleteBase("demo");
    //exportDatabase("localhost","root","","demo","D:\programme\wamp\www\ProjetM1S2\Projet_M1_S2_SQL\Controller");
?>


