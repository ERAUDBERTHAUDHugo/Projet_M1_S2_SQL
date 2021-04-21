<body>

	<?php

	if (isset($_GET["id"])){
		if($_SESSION["question"]==-1){
			$_SESSION["question"]=0;
			echo(checkFirstTime());
			if(checkFirstTime()==1){// creation of the unique db file for the exercice
				//get dbname using user lastname :
				$userId=$_SESSION["user"];
			    $currentExerciceId=$_GET["id"];
			    $username=BDD::get()->query("SELECT `user_adress` FROM `users` WHERE `user_id`= $userId")->fetchAll();
			    $exoname=BDD::get()->query("SELECT `quiz_id` FROM `quiz` WHERE `quiz_id`= $currentExerciceId")->fetchAll();
			    $dbname=hash("MD5",$username[0]['user_adress']).$exoname[0]['quiz_id'];
			    $dbnameCorrec=$dbname."Correc";

				createBase($dbname);// creation db etudiant
				createBase($dbnameCorrec);//création db correction
				
				
				// get file name in bdd :

				$quizId=$_GET["id"];
				$quizname=BDD::get()->query("SELECT `quiz_database` FROM `quiz` WHERE `quiz_id`= $quizId")->fetchAll();
				echo("yes");
				var_dump($quizname);
				$filename="DatabaseExercice\\".$quizname[0]["quiz_database"];

				importSqlFile($dbname,$filename);
    			importSqlFile($dbnameCorrec,$filename);
			}
		}elseif(isset($_POST["next"])){
			$_SESSION["question"]=$_SESSION["question"]+1;
		}elseif(isset($_POST["previous"]) and ($_SESSION["question"]>0)){
			$_SESSION["question"]=$_SESSION["question"]-1;
		}
		displayIntro();		

		if (isset($_POST["reponse"])){
			
			include("Controller/correction.php");

			$userId=$_SESSION["user"];
			$currentExerciceId=$_GET["id"];
			$username=BDD::get()->query("SELECT `user_adress` FROM `users` WHERE `user_id`= $userId")->fetchAll();
			$exoname=BDD::get()->query("SELECT `quiz_id` FROM `quiz` WHERE `quiz_id`= $currentExerciceId")->fetchAll();
			$dbname=hash("MD5",$username[0]['user_adress']).$exoname[0]['quiz_id'];
			$dbnameCorrec=$dbname."Correc";
			
			$getQuestionId=$_SESSION["question"];//get actual question id
			$questionId=BDD::get()->query("SELECT `question_id` FROM `question` WHERE `question_id`= $getQuestionId")->fetchAll();
			var_dump($questionId);
			$Id=$questionId[0][0];

			$resultat=dataBaseComparision($dbname,$dbnameCorrec,$_POST["reponse"],$_GET['id'],$Id); //call function correction
			echo " Résultat: ".$resultat[0]." - Points:".$resultat[1]." - Valide: ".$resultat[2];
			////////////////////////////////////test insertion user answer///////////////////////////////////////////
			writeUserAnswer($_POST["reponse"],$resultat[0],(int)$Id,(int)$userId,(int)$resultat[1], (int)$resultat[2], (int)$_GET['id']); //write user answer in database

			/////////////////////////////////////////////////////////////////////////////////////////////////////////
			?>
			<form action="index.php?page=exercice&id=<?php echo($_GET["id"]);?>" method="POST">
				<button name="previous">Question précédente</button>
			</form>
			<form action="index.php?page=exercice&id=<?php echo($_GET["id"]);?>" method="POST">
				<button name="next">Question suivante</button>
			</form>

	<?php
		}else{
			$quiz=$_GET['id'];
			$limit=BDD::get()->query("SELECT COUNT(*) FROM `question` WHERE `quiz_id`= $quiz")->fetchAll();
			if($_SESSION['question']<=((int)$limit)){

				$quiz=$_GET['id'];
				$user=$_SESSION['user'];
				$getQuestionId=$_SESSION["question"];//get actual question id
				$questionId=BDD::get()->query("SELECT `question_id` FROM `question` WHERE `question_id`= $getQuestionId")->fetchAll();
				$question=$questionId[0][0];
				displayQuestion();
				displayQuestionHistory1($user, $question, $quiz);

			}else{

				$userId=$_SESSION["user"];
			    $currentExerciceId=$_GET["id"];
			    $username=BDD::get()->query("SELECT `user_adress` FROM `users` WHERE `user_id`= $userId")->fetchAll();
			    $exoname=BDD::get()->query("SELECT `quiz_id` FROM `quiz` WHERE `quiz_id`= $currentExerciceId")->fetchAll();
			    $dbname=hash("MD5",$username[0]['user_adress']).$exoname[0]['quiz_id'];
			    $dbnameCorrec=$dbname."Correc";
			?>
				<h1>Vous avez fini l'exercice</h1>
				<p>Consultez vos résultats sur le tableau de bord</p>

				<form action="index.php?page=exercice&id=<?php echo($_GET["id"]);?>" method="POST">
					<button name="previous">Question précédente</button>
				</form>
				<form action="index.php?page=main&dbname=<?php echo($dbname);?>&dbnameCorrec=<?php echo($dbnameCorrec);?>" method="POST">
					<button name="redirectMain">Quitter l'exercice</button>
				</form>

			<?php
			}		
		}
			 
	}else{
	?>
	<div class="title-box">
		<p>Aucun exercice en cours</p>
		<?php

			$userId1 = $_SESSION['user'];

	        $tpNames=BDD::get()->query("SELECT tp_name,tp_id FROM tp WHERE equipe_id IN (SELECT equipe_id FROM groupe WHERE groupe_id IN (SELECT groupe_id FROM part_of WHERE user_id=$userId1) ORDER BY equipe_id ASC )")->fetchAll();
	        //$exerciseInfos=BDD::get()->query("SELECT quiz_id, quiz_name,quiz_difficulty, quiz_description, user_id FROM quiz WHERE quiz_id IN (SELECT quiz_id FROM tp WHERE equipe_id IN (SELECT equipe_id FROM groupe WHERE groupe_id IN (SELECT groupe_id FROM part_of WHERE user_id=$userId1)ORDER BY equipe_id ASC))")->fetchAll();
	    ?>
	    <h1>Sélectionnez un exercice</h1>
	    <div class="quiz-row">
	        <?php
	            foreach ($tpNames as $tp) { //afficher tous les exercices disponibles
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
	         ?>
	    </div>
	</div>

    <?php
	}
	?>

</body>
