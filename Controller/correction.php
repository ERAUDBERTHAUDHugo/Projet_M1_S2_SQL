<?php
echo"Requete à corriger : ".$_POST["reponse"];

function dataBaseComparision($dbname,$dbnameCorrec,$request,$quizId,$questionId){
    /**
     * @param 
     * @return array(réponse text(str), question score (int), valid(int))
     **/
    /////////////////////////////Apply requests////////////////////////////

    try{
        $conTest = new PDO("mysql:host=localhost;dbname=".$dbname."","root","");
        $requestTest=$conTest->prepare($_POST["reponse"]);
    } catch(PDOException $e){
        die(" ERREUR: Impossible de se connecter à la bbd test: " . $e->getMessage());
    }

    //if user request doesn't work on their db, wrong answer 
    if(!$requestTest->execute()){
        return array("Requête invalide", 0, 0);
    }else{
        //get correct request and question points from website db
        $conGetRequest = BDD::get()->query("SELECT `question_answer`, `question_points` FROM `question` WHERE`quiz_id`=$quizId AND `question_id`=$questionId")->fetchAll();
        $trueRequest=$conGetRequest[0][0];
        $points=$conGetRequest[0][1];

        //apply correct request on correction db
        $conCorrec = new PDO("mysql:host=localhost;dbname=".$dbnameCorrec."","root","");
        $requestCorrec=$conCorrec->prepare($trueRequest);
        $requestCorrec->execute();
            
        /////////////////////////////Get database data////////////////////////////
        //get tables from test db
        $tableTest=getTables($dbname);

        //get tables from correction db
        $tableCorrec=getTables($dbnameCorrec);

        //check count and compare number of tables
        if(!(count($tableTest)==count($tableCorrec))){

            return array("Pas de même nombre de tables", 0, 0);

        } else{

             //check if tables names are the same
            for($i=0;$i<count($tableTest);$i++){

                if(!($tableTest[$i][0]==$tableCorrec[$i][0])){
                    return array("Erreur nom de table", 0, 0);
                }

                $tableName=$tableTest[$i][0];

                //fetch each table data test
                $fetchTest=$conTest->prepare("SELECT * FROM $tableName");
                $fetchTest->execute();
                $dataTest= $fetchTest->fetchAll();

                //fetch each table data correction
                $fetchCorrec=$conCorrec->prepare("SELECT * FROM $tableName");
                $fetchCorrec->execute();
                $dataCorrec= $fetchCorrec->fetchAll();

                //Compare data fetched
                foreach ($dataTest as $key => $fields) {
                    foreach ($fields as $field => $value) {
                        if (isset($dataCorrec[$key][$field])) {
                            if ($dataCorrec[$key][$field] != $value) {
                                return array("Pas mêmes valeurs", 0, 0);
                            } else {
                                return array("Bonne réponse!", $points, 1);
                            }
                        } else{
                            return array("Pas mêmes valeurs", 0, 0);
                        }
                    }
                }

            }

        }
    
    }

}

function writeUserAnswer($userAnswerText,$questionId,$userId,$questionScore, $valid, $quizId){
    /**
     * @param 
     * @return 
     **/

////////////////////////write data to user_answer/////////////////////////////
$writeAnswer=BDD::get()->query("INSERT INTO  `user_answer` (`user_answer_text`, `user_answer_time`, `question_id`, `user_id`, `question_score`, `valide`, `quiz_id`)
  VALUES ($userAnswerText, CURRENT_TIMESTAMP, $questionId, $userId, $questionScore, $valid, $quizId)"); 
var_dump($writeAnswer);
//////////////////add points to user total user score//////////////////////////////////
$writeScore=BDD::get()->query("UPDATE `users` SET `user_score` = `user_score` + $questionScore WHERE `user_id`= $userId");
}

?>