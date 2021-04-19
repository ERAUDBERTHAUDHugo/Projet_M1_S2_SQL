<div class="title-box">
        <h1>Vos exercices :</h1>
        <p>Les exercices sont la meilleure chose à faire pour apprendre</p>
    </div>

    <?php //recuperer les exercices disponibles
        $quizAvailable=BDD::get()->query("SELECT `quiz_id`, `quiz_name`,`quiz_difficulty`, `quiz_description`, `quiz_database`, `user_id` FROM `quiz`")->fetchAll();
    ?>

    <div class="quiz-row">

        <?php 
            $index=0;
            foreach ($quizAvailable as $quiz) {
                if($index<=3){      //afficher 4 exercices sur la page
                ?>
                <a href="index.php?page=exercice&id=<?php echo($quiz["quiz_id"]); ?>">
                <div class="quiz-box">

                    <?php //recuperer le teacher qui a crée le quiz
                    $id=(int)$quizAvailable[$index]['user_id'];
                    $quizCreator=BDD::get()->query("SELECT `user_id`,`user_role`,`user_first_name` FROM `users` WHERE `user_id`=$id")->fetchAll();
                    ?>

                    <h4><?php echo "Par ".$quizCreator[0]['user_first_name']; ?></h4>
                    <small><?php if($quizCreator[0]['user_role']==1){echo "Admin";} else{echo "Unknown";}?></small>
                    <img src="View/Img/avatar.png">
                    <div class="title-quiz-box">
                        <p1><?php echo $quizAvailable[$index]['quiz_name']; ?></p1>
                    </div>
                    <p><?php echo substr($quizAvailable[$index]['quiz_description'], 0, 55)."..."; ?></p>
                </div>
                </a>
                <?php  
                }
                $index+=1;      
            }
         ?>
    </div>
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