<div id=main>
<link rel="stylesheet" type="text/css" href="View/styleMain.css">
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="title-box">
        <h1>Vos exercices :</h1>
        <p>Les exercices sont la meilleure chose à faire pour apprendre</p>
    </div>

    <?php //recuperer les exercices disponibles
        $quizAvailable=BDD::get()->query("SELECT `quiz_id`, `quiz_name`,`quiz_difficulty`, `quiz_description`, `quiz_database`, `user_id` FROM `quiz`")->fetchAll();
    ?>

    <div class="team-row">

        <?php 
            $index=0;
            foreach ($quizAvailable as $quiz) {
                if($index<=3){      //afficher 4 exercices sur la page
                ?>
                <div class="profile-box">

                    <?php //recuperer le teacher qui a crée le quiz
                    $id=(int)$quizAvailable[$index]['user_id'];
                    $quizCreator=BDD::get()->query("SELECT `user_id`,`user_role`,`user_name` FROM `users` WHERE `user_id`=$id")->fetchAll();
                    ?>

                    <h4><?php echo "Par ".$quizCreator[0]['user_name']; ?></h4>
                    <small><?php if($quizCreator[0]['user_role']==1){echo "Admin";} else{echo "Unknown";}?></small>
                    <img src="View/Img/avatar.png">
                    <div class="social-box">
                        <p1><?php echo $quizAvailable[$index]['quiz_name']; ?></p1>
                    </div>
                    <p><?php echo substr($quizAvailable[$index]['quiz_description'], 0, 55)."..."; ?></p>
                </div>

                <?php  
                }
                $index+=1;      
            }
         ?>

    <div class="title-box">
        <h1>Vos cours :</h1>
        <p>Les cours avec DD c'est la base, avec un très bon accent anglais en plus</p>
    </div>
    <div class="team-row">
        <div class="profile-box">
            <h4>D.DELANNOY</h4>
            <small>Admin</small>
            <img src="View/Img/avatar.png">
            <div class="social-box">
                <p1>Cours n°1</p1>
            </div>
            <p>Les cours avec DD c'est la base!</p>
        </div>
        <div class="profile-box">
            <h4>D.DELANNOY</h4>
            <small>Admin</small>
            <img src="View/Img/avatar.png">
            <div class="social-box">
                <p1>Cours n°2</p1>
            </div>
            <p>Les cours avec DD c'est la base!</p>
        </div>
        <div class="profile-box">
            <h4>D.DELANNOY</h4>
            <small>Admin</small>
            <img src="View/Img/avatar.png">
            <div class="social-box">
                <p1>Cours n°3</p1>
            </div>
            <p>Les cours avec DD c'est la base!</p>
        </div>
        <div class="profile-box">
            <h4>D.DELANNOY</h4>
            <small>Admin</small>
            <img src="View/Img/avatar.png">
            <div class="social-box">
                <p1>Cours n°4</p1>
            </div>
            <p>Les cours avec DD c'est la base!</p>
        </div>
    </div>
</div>