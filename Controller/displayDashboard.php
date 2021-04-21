<?php

    function displayGraphs($userBoard) {

        /////////////////////////////////////get diagram data//////////////////////////////////////

        //recuperer le nombre de réponses valides et invalides
        $userValid=BDD::get()->query("SELECT COUNT(*) FROM `user_answer` WHERE `user_id`= $userBoard AND `valide`=1")->fetchAll();
        $userInvalid=BDD::get()->query("SELECT COUNT(*) FROM `user_answer` WHERE `user_id`=$userBoard AND `valide`=0")->fetchAll();

        $dataPie = array(
            array("label"=> "Réussite", "y"=> (int)$userValid[0][0]),
            array("label"=> "Echec", "y"=> (int)$userInvalid[0][0]),
        );

        //recuperer les scores totaux au fil du temps --> affichage scpre à chaque timestamp (question répondue)
        $scoresTime=BDD::get()->query("SELECT `user_answer_time` FROM `user_answer` WHERE `user_id`=$userBoard")->fetchAll();
         // à faire pour chaque date length(times available)
        $i=0;
        $dataCurveTest=array();
        foreach ($scoresTime as $scoreTime) {
            $time = $scoresTime[$i]['user_answer_time'];
            $userEvolution=BDD::get()->query("SELECT SUM(`question_score`) FROM `user_answer` WHERE `user_id`= $userBoard  AND `user_answer_time`<= '$time'")->fetchAll(); 
            $arrayData = array("x" => strtotime($time)*1000, "y" => (int)$userEvolution[0][0]);
            $dataCurve[$i]=$arrayData; 

            $i++;
        }
        ////////////////////////////////////////////create graphs///////////////////////////////////////
        ?>
        <div class="containers">
        <script>
            window.onload = function () {
             
            var chart1 = new CanvasJS.Chart("chartContainer1", {
                animationEnabled: true,
                title:{
                    text: "Taux de réussite des exercices"
                },
                subtitles: [{
                    text: "Part en pourcentage"
                }],
                data: [{
                    type: "pie",
                    showInLegend: "true",
                    legendText: "{label}",
                    indexLabelFontSize: 16,
                    indexLabel: "{label} - #percent%",

                    dataPoints: <?php echo json_encode($dataPie, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart1.render();

            var chart2 = new CanvasJS.Chart("chartContainer2", {
                animationEnabled: true,
                title:{
                    text: "Evolution de votre score"
                },
                axisY: {
                    title: "Score",
                    suffix: " pts",
                },
                axisX: {
                    title: "Date",
                },
                data: [{
                    type: "spline",
                    lineColor: "green",
                    markerSize: 5,
                    xValueType: "dateTime",
                    dataPoints: <?php echo json_encode($dataCurve, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart2.render();
             
            }
        </script>

        <!--------------------------------- display graphs with parameters ------------------------->

        <div id="chartContainer1"></div>
        <br>
        <div id="chartContainer2"></div>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        <br>
        </div>
        <?php
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////:

    function displayRanking(){
    ?>
        <div id="statistic-container">
            <br>
            <h4>Votre classement</h4>
            <link rel="stylesheet" href="https://unpkg.com/purecss@2.0.5/build/pure-min.css" integrity="sha384-LTIDeidl25h2dPxrB2Ekgc9c7sEC3CWGM6HeFmuDNUjX76Ert4Z4IY714dhZHPLd" crossorigin="anonymous">

                <?php 
            //recuperer les ranking disponibles
                $userRanking=BDD::get()->query("SELECT `user_first_name`, `user_score` FROM `users` ORDER BY `user_score` DESC")->fetchAll();
                ?>
             <table class="pure-table pure-table-horizontal">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Score Total</th>
                </tr>
                </thead>
                <tbody>

                    <?php 
                        $index=0;
                        foreach ($userRanking as $rankedUser) {
                            if($index<=9){      //afficher le top 10
                            ?>
                            <tr>
                                <td><?php echo $index+1; ?></td>
                                <td><?php echo $userRanking[$index]['user_first_name']; ?></td>
                                <td><?php echo $userRanking[$index]['user_score']; ?></td>
                            </tr>
                        <?php  
                            }
                        $index+=1;      
                        }
                        ?>
                </tbody>
            </table>
        </div>
        <br>
    <?php
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function displayQuestionHistory($userBoard){

    ?>
    <div id="statistic-container">
        <br>
    <h4>Vos derniers exercices</h4>
    <?php 
    //recuperer les exercices faits disponibles
        $userAnswers=BDD::get()->query("SELECT `user_id`, `user_answer_time`, `question_id`, `question_score`, `quiz_id` FROM `user_answer` WHERE `user_id`= $userBoard ORDER BY `user_answer_time` DESC")->fetchAll(); 
    ?>
         <table class="pure-table pure-table-horizontal">
            <thead>
            <tr>
                <th>Exercice</th>
                <th>Question</th>
                <th>Date</th>
                <th>Score</th>
            </tr>
            </thead>
            <tbody>

                <?php 
                    $index=0;
                    foreach ($userAnswers as $question) {
                        $quizId=(int)$userAnswers[$index]['quiz_id'];
                        $questionId=(int)$userAnswers[$index]['question_id'];
                        $userQuiz=BDD::get()->query("SELECT `quiz_name` FROM `quiz` WHERE `quiz_id`=$quizId")->fetchAll();
                        $userQuestion=BDD::get()->query("SELECT `question_intitule` FROM `question` WHERE `question_id`=$questionId")->fetchAll();
                        ?>
                        <tr>
                            <td><?php echo $userQuiz[0]['quiz_name']; ?></td>
                            <td><?php echo $userQuestion[0]['question_intitule']; ?></td>
                            <td><?php echo $userAnswers[$index]['user_answer_time']; ?></td>
                            <td><?php echo $userAnswers[$index]['question_score']; ?></td>
                        </tr>
                    <?php  
                    $index+=1;      
                    }
                    ?>
            </tbody>
        </table>
    </div>

    <?php
    }

?>