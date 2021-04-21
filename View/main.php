<?php 
    if(isset($_POST['redirectMain'])){
        $_SESSION['question'] = -1;
        deleteBase($_GET["dbname"]);
        deleteBase($_GET["dbnameCorrec"]);
    }

?>

<div class="title-box">
        <h1>Vos derniers exercices en ligne :</h1>
        <p>Les exercices sont la meilleure chose à faire pour apprendre</p>
    </div>

    <div class="quiz-row">
    <?php
			$userId1 = $_SESSION['user'];
	        $tpNames=BDD::get()->query("SELECT tp_name,tp_id FROM tp WHERE equipe_id IN (SELECT equipe_id FROM groupe WHERE groupe_id IN (SELECT groupe_id FROM part_of WHERE user_id=$userId1) ORDER BY equipe_id ASC )")->fetchAll();
	        //$exerciseInfos=BDD::get()->query("SELECT quiz_id, quiz_name,quiz_difficulty, quiz_description, user_id FROM quiz WHERE quiz_id IN (SELECT quiz_id FROM tp WHERE equipe_id IN (SELECT equipe_id FROM groupe WHERE groupe_id IN (SELECT groupe_id FROM part_of WHERE user_id=$userId1)ORDER BY equipe_id ASC))")->fetchAll();
	    ?>
    <?php
        $index=0;
        foreach ($tpNames as $tp) { //afficher tous les exercices disponibles
            if($index<3){  
                $tp_id=$tp["tp_id"];
                $getQuizId=BDD::get()->query("SELECT `quiz_id` FROM `tp` WHERE `tp_id`='$tp_id'")->fetchall();
                if(!empty($getQuizId)){
                    $quiz_id=$getQuizId[0]["quiz_id"];
                    $exerciseInfos=BDD::get()->query("SELECT `quiz_name`,`quiz_description`,`user_id` FROM `quiz` WHERE `quiz_id`='$quiz_id'")->fetchall();
                    ?>
                    <a href="index.php?page=exercice&id=<?php echo($quiz_id); ?>">
                    <div class="quiz-box">

                        <?php //recuperer le teacher qui a crée le quiz
                        $id=(int)$exerciseInfos[0]['user_id'];
                        $quizCreator=BDD::get()->query("SELECT `user_id`,`user_last_name`,`user_first_name` FROM `users` WHERE `user_id`=$id")->fetchAll();
                        ?>

                        <h4><?php echo $tp['tp_name']; ?></h4>
                        <small><?php echo "Par ".$quizCreator[0]['user_first_name']." ".$quizCreator[0]['user_last_name'];?></small>
                        <img src="View/Img/avatar.png">
                        <div class="title-quiz-box">
                            <p1><?php echo $exerciseInfos[0]['quiz_name']; ?></p1>
                        </div>
                        <p><?php echo substr($exerciseInfos[0]['quiz_description'], 0, 55)."..."; ?></p>
                    </div>
                    </a>
                    <?php  
                    }else{
                        ?>
                        <p> Pas d'exercice à afficher pour l'instant !</p>
                        <?php
                }
            }
            $index=$index+1;     
        }
	         ?>
    </div>
<!-- ------------------------------------------------------------------------------------------------------------------------------------------->
</div>
    
</div>
</div>
<script>
// $(function () {
//     $(window).on('scroll', function () {
//         if ( $(window).scrollTop() > 10 ) {
//             $('.navbar').addClass('active');
//         } else {
//             $('.navbar').removeClass('active');
//         }
//     });
// });

</script>
