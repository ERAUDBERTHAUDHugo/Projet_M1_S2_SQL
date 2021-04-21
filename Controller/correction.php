<?php

function dataBaseComparision($dbname,$dbnameCorrec,$request,$quizId,$questionId){
    /**
     * @param String $dbname (name of user database), String $dbnameCorrec (name of the correct database), String $request (input sql request by user), integer $quizId,interger $questionId
     * @return array(): [0] String reponse text, [1] String question score (number of points), [2] String valid (validity of user request 0 no or 1 yes)
     **/
    /////////////////////////////apply requests////////////////////////////

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
                                return array("Requête valide", $points, 1);
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

function writeUserAnswer($query,$userAnswerText,$questionId,$userId,$questionScore, $valid, $quizId){
    /**
     * @param String $userAnswerText (request of user), interger $questionId, integer $userId (name of the correct database), integer $questionScore (number of points of question), integer $valid (validity of request 0 no 1 yes), integer $quizId,
     * @return None (only writing info in database)
     **/

    //////////////////////////////////////////////prepare request to write//////////////////////////////////////////
    $writeAnswer = BDD::get()->prepare('INSERT INTO user_answer VALUES (NULL,:user_answer_query,:user_answer_text, CURRENT_TIMESTAMP, :question_id, :user_id,:question_score,:valide,:quiz_id)'); 

    $writeAnswer->bindParam(':user_answer_query',$query);
    $writeAnswer->bindParam(':user_answer_text',$userAnswerText);
    $writeAnswer->bindParam(':question_id',$questionId);
    $writeAnswer->bindParam(':user_id',$userId);
    $writeAnswer->bindParam(':question_score',$questionScore);
    $writeAnswer->bindParam(':valide',$valid);
    $writeAnswer->bindParam(':quiz_id',$quizId);

    /////////////////////check if asnwer from this user to this question already exists///////////////////////////////

    $checkAnswerIfExists = BDD::get()->query("SELECT `valide` FROM `user_answer` WHERE `user_id` = $userId AND `question_id` = $questionId AND `quiz_id` = $quizId")->fetchAll();
    if(!empty($checkAnswerIfExists[0][0])) //if answer of this question/ linked to quiz exists 
    {
        if((int)$checkAnswerIfExists[0][0] == 1 && $valid == 1){  //if valid 
            $updateTime=BDD::get()->query("UPDATE `user_answer` SET `user_answer_time` = CURRENT_TIMESTAMP WHERE `user_id` = $userId AND `question_id` = $questionId AND `quiz_id` = $quizId");//update timestamp
        }else{//not valid
            $writeAnswer->execute();   //write new user answer
            
        }

    } else{ //if does not exists
        if($valid == 1){//if valid
               $writeAnswer->execute(); //write new answer answer and add score to user
               $writeScore=BDD::get()->query("UPDATE `users` SET `user_score` = `user_score` + $questionScore WHERE `user_id`= $userId");
        }else{//not valid
           $writeAnswer->execute(); //write new answer
        }
    }
}
?>