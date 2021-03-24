<?php
echo"Requete à corriger : ".$_POST["reponse"];
var_dump($_POST["reponse"]);

////////////////////////////////test request/////////////////////////////////////

//create new connection to the database for request $dbname
//get database name
try {
    $testAnswer = new PDO('mysql:host=localhost;dbname=the_database_hash;charset=utf8', 'root', '');
} catch(PDOException $e) {
    echo "Connection failed: ".$e->getMessage();
}

//test request
try {
	$reponse = $testAnswer->query($_POST["reponse"]);
	$donnees = $reponse->fetch(); //returns request result
	$validity = 1;
	$questionScore = 3;
} catch(Exception $e) {
    echo "Request failed: ".$e->getMessage();
    $validity = 0;
    $questionScore = 0;
}

var_dump($donnees);


////////////////////////write data to as user_answer/////////////////////////////

//TABLE USER_ANSWER

//user_answer_id --> autofill(increment)
//user_answer_text --> $_POST["reponse"]
//user_answer_time --> CURRENT_TIME()
//question_id --> $_SESSION["question"]
//user_id --> $_SESSION["user"]
//question_score --> voir les critères de score (3pt valide, 0pt invalide pour test) return du try/catch request
//valide --> 1 valide, 0 non valide return du try/catch request
//quiz_id --> $_GET["id"] 

$writeAnswer=BDD::get()->query("INSERT INTO  user_answer (user_answer_text, user_answer_time, question_id, user_id, question_score, valide, quiz_id)
  VALUES ($_POST["reponse"], CURRENT_TIME(), $_SESSION["question"], $_SESSION["user"], $questionScore,  $validity, $_GET["id"])"); 
var_dump($writeAnswer); //should return true or false (success or fail)

//TABLE USER
//user_score --> incrementer le score total
$writeScore=BDD::get()->query("UPDATE `users` SET `user_score` = `user_score` + $questionScore WHERE `user_id`=$_SESSION["user"]");
var_dump($writeScore); //should return true or false (success or fail)


?>