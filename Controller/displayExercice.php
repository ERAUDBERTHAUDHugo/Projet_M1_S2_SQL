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
        <img src="ImgExo/<?php echo($quizSelection[0]['quiz_img']);?>"> 
        
		

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

                /*if(empty($exists1)&&empty($exists2)){
                    return 1;
                }else{
                    return 0;
                }*/



        //si vide return 1
        //si pas vide return 0
        /*
        $user_answer=BDD::get()->query("SELECT `question_id` FROM `user_answer` WHERE `user_id`= $user")->fetchAll();
        foreach ($user_answer as $questions){
            $id_question=$questions["question_id"];
            $quizz_id=BDD::get()->query("SELECT `quiz_id` FROM `question` WHERE `question_id`='$id_question' ")->fetchAll();
            if($quizz_id[0]["quiz_id"]==$_GET["id"]){
                return 0;
            }
        }*/

        /*$user=$_SESSION["user"];
		$user_answer=BDD::get()->query("SELECT `question_id` FROM `user_answer` WHERE `user_id`= $user")->fetchAll();
        foreach ($user_answer as $questions){
            $id_question=$questions["question_id"];
            $quizz_id=BDD::get()->query("SELECT `quiz_id` FROM `question` WHERE `question_id`='$id_question' ")->fetchAll();
            if($quizz_id[0]["quiz_id"]==$_GET["id"]){
                return 0;
            }
        }*/
    }

?>