<div class="title-box">
        <h1>Vos exercices :</h1>
        <p>Les exercices sont la meilleure chose à faire pour apprendre</p>
    </div>

    <?php
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         $userId1 = $_SESSION['user'];

         $tpNames=BDD::get()->query("SELECT tp_name FROM tp WHERE equipe_id IN (SELECT equipe_id FROM groupe WHERE groupe_id IN (SELECT groupe_id FROM part_of WHERE user_id=$userId1))")->fetchAll();

         $exerciseInfos=BDD::get()->query("SELECT quiz_id, quiz_name,quiz_difficulty, quiz_description, user_id FROM quiz WHERE quiz_id IN (SELECT quiz_id FROM tp WHERE equipe_id IN (SELECT equipe_id FROM groupe WHERE groupe_id IN (SELECT groupe_id FROM part_of WHERE user_id=$userId1)))")->fetchAll();

    ?>
    
    <div class="quiz-row">
        <?php 
            $index=0;
            foreach ($exerciseInfos as $infos) {
                if($index<=3){      //afficher 4 exercices sur la page
                ?>
                <a href="index.php?page=exercice&id=<?php echo($infos["quiz_id"]); ?>">
                <div class="quiz-box">

                    <?php //recuperer le teacher qui a crée le quiz
                    $id=(int)$exerciseInfos[$index]['user_id'];
                    $quizCreator=BDD::get()->query("SELECT `user_id`,`user_last_name`,`user_first_name` FROM `users` WHERE `user_id`=$id")->fetchAll();
                    ?>

                    <h4><?php echo $tpNames[$index]['tp_name']; ?></h4>
                    <small><?php echo "Par ".$quizCreator[0]['user_first_name']." ".$quizCreator[0]['user_last_name'];?></small>
                    <img src="View/Img/avatar.png">
                    <div class="title-quiz-box">
                        <p1><?php echo $exerciseInfos[$index]['quiz_name']; ?></p1>
                    </div>
                    <p><?php echo substr($exerciseInfos[$index]['quiz_description'], 0, 55)."..."; ?></p>
                </div>
                </a>
                <?php  
                }
                $index+=1;      
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
