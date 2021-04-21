<?php
    function displayIntro() {
        ?>
    <div id=exercice>

		<?php //display quiz info
		$quizId=$_GET["id"]; //L'id du quiz est à récupérer par GET selon la page sélectionée par l'utilisateur

		$quizSelection=BDD::get()->query("SELECT `quiz_id`, `quiz_name`,`quiz_difficulty`, `quiz_description`, `quiz_database`,`quiz_img` FROM `quiz` WHERE `quiz_id`= $quizId")->fetchAll();
		?>

        <link rel="stylesheet" type="text/css" href="View/style.css">
        <div class="title">
            <h1><?php echo $quizSelection[0]['quiz_name']; ?></h1>
        </div>
        <div class="contextbox">
            <?php echo "Difficulté: ".$quizSelection[0]['quiz_difficulty'];?>            
		    <br> 
		    <?php echo "Enoncé: ".$quizSelection[0]['quiz_description']; ?>
            
        </div>
		<br>
        <div style="text-align:center;"> 
        <img style="height: 500px; margin:20px;" src="ImgExo/<?php echo($quizSelection[0]['quiz_img']);?>"> 
        </div>
        
        
		

	</div>
    <?php
    }

    function displayQuestion(){
        ?>
        <div class="questionbox">
            <h3>Voici la question : </h3>
            <?php  
            $quizId=$_GET["id"]; 
            $questionSelection=BDD::get()->query("SELECT `question_id`, `question_text`,`question_answer` FROM `question` WHERE `quiz_id`= $quizId")->fetchAll();
            ?>
            <div id='step'>
                <?php
                if(!empty($questionSelection)){
                
                $curentQuestion=$_SESSION["question"];
                $questionText=$questionSelection[$curentQuestion]['question_text'];
                echo $questionText;
                ?>

                <br> 
                <form action="index.php?page=exercice&id=<?php echo($_GET["id"]);?>" method="POST">
                    <input type="text" name="reponse">
                    <button >Valider</button>
                </form>
                <br>
                
                <?php
                }
                ?>
            </div>
        </div>
    <?php


    }
    function checkFirstTime(){

                $userId=$_SESSION["user"];
                $currentExerciceId=$_GET["id"];
                $username=BDD::get()->query("SELECT `user_adress` FROM `users` WHERE `user_id`= $userId")->fetchAll();
                $exoname=BDD::get()->query("SELECT `quiz_id` FROM `quiz` WHERE `quiz_id`= $currentExerciceId")->fetchAll();
                $dbname=hash("MD5",$username[0]['user_adress']).$exoname[0]['quiz_id'];
                $dbnameCorrec=$dbname."Correc";


                try{
                    $exists1= new PDO("mysql:host=localhost;dbname=".$dbname."","root","");
                    $exists2= new PDO("mysql:host=localhost;dbname=".$dbnameCorrec."","root","");
                    return 0;
            
                }catch (PDOException $e) {
                   return 1;
                }

    }

    function displayQuestionHistory1($user, $question, $quiz){

    ?>

    <div id="statistic-container" class="my-custom-scrollbar1">
    <br>
    <?php 
    //recuperer les exercices faits disponibles
        $userAnswers=BDD::get()->query("SELECT `user_answer_query`,`user_answer_time`, `user_answer_text`,`valide` FROM `user_answer` WHERE `user_id`= $user AND  `question_id`= $question AND `quiz_id`= $quiz ORDER BY `user_answer_time` DESC")->fetchAll(); 
    ?>
        <h4>Mes dernières réponses</h4>
         <table class="table table-bordered table-striped mb-0">
            <thead>
            <tr>
                <th class="titre-colonne-table">Date</th>
                <th class="titre-colonne-table">Requête</th>
                <th class="titre-colonne-table">Résultat</th>
            </tr>
            </thead>
            <tbody>

                <?php 
                if(empty($userAnswers)){
                    ?>
                        <tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                    <?php
                }else{
                
                    $index=0;
                    foreach ($userAnswers as $question){
                        ?>
                        <tr>
                            <td><?php echo $userAnswers[$index]['user_answer_time']; ?></td>
                            <td><?php echo $userAnswers[$index]['user_answer_query']; ?></td>
                            <td><?php if($userAnswers[$index]['valide']=='0'){echo '<font color="red">'.$userAnswers[$index]['user_answer_text'].'</font>';}else{echo '<font color="green">'.$userAnswers[$index]['user_answer_text'].'</font>';}?></td>
                        </tr>
                    <?php  
                    $index+=1;      
                    }
                }
                    ?>
            </tbody>
        </table>
    </div>

    <?php
    }

?>