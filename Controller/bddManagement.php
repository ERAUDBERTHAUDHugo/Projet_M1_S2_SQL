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
    
    $query = file_get_contents("DatabaseExercice/".$filename.".sql");
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
    unset($db);
    return $tables;
}
function exportDatabaseV2($host, $user, $password, $database, $targetFilePath){
    $output = null;
    $output=shell_exec('D:\\programme\\wamp\\bin\\mysql\\mysql5.7.31\\bin\\mysqldump.exe -u root --password="" db_project > DatabaseBackup\mydata.sql');//'mysqldump --host localhost --user root --password "" db_project --result-file=DatabaseBackup\mydata.sql'
    var_dump($output);
}
function exportDatabase($host, $user, $password, $database, $filename){
    //returns true iff successfull
     $filename= 'Databasebackup\mydata.sql';

    /**
     * MySQL connection configuration
     */
    $database	= 'db_project';
    $user		= 'root';
    $password	= '';

    /**
     * usually it's ok to leave the MySQL host as 'localhost'
     * if your hosting provider instructed you differently, edit the next one as needed
     */
    $host = 'localhost';

    /**
     * DO NOT EDIT BELOW THIS LINE
     */
    $fp = @fopen( $filename, 'w+' );
    if( !$fp ) {

        echo 'Impossible to create <b>'. $filename .'</b>, please manually create one and assign it full write privileges: <b>777</b>';
        exit;
    }
    fclose( $fp );

    $command = 'mysqldump --opt -h '. $host .' -u '. $user .' -p'. $password .' '. $database .' > '. $filename;
    $output = array();
    exec( $command, $output, $worked );

    switch( $worked ) {

        case 0:

            echo 'Database <b>'. $database .'</b> successfully exported to <b>'. $filename .'</b>';
            break;

        case 1:

            echo 'There was a warning during the export of <b>'. $database .'</b> to <b>'. $filename .'</b>';
            break;
    }
    return 1;//exec('mysqldump --host '. $host .' --user '. $user .' --password '. $password .' '. $database .' --result-file='.$targetFilePath)
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
    //createBase("cycle_v3");
    //importSqlFile("cycle_v3","cycle_v3");
    //getTables("demo");
    //deleteBase("demo");
    //exportDatabase("localhost","root","","demo","D:\programme\wamp\www\ProjetM1S2\Projet_M1_S2_SQL\Controller");
?>


