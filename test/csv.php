<!DOCTYPE html>
<html>
<body>

<form action="csv.php" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>

<?php

class BDD{
    private static $connexion;
        public static function get(){
           if(!self::$connexion instanceof PDO){
              self::$connexion = new PDO('mysql:host=localhost;dbname=db_project;charset=utf8', 'root', '');
           }
           return self::$connexion;
        }
}
function getDataCsvEkip($data){
    // data is supposed to be received as "Equipe;Groupe;Nom;Prenom"
    $dataTab=preg_split('[;]',$data);
    $team=
    $group=
    $lastName=
    $firstName=
    var_dump($dataTab);    
    
}
    var_dump($_FILES["fileToUpload"]); 
$row = 1;
if (($handle = fopen("csvfiles/Equipe.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {//handel=vrai ou faux//1000 caracteres max, "," séparateur
        $num = count($data);
        echo "<p> $num champs à la ligne $row: <br /></p>\n";
        $row++;
        for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";
            getDataCsvEkip($data[$c]);
        }
    }
    fclose($handle);
}
?>