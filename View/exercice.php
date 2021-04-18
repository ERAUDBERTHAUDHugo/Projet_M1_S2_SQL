<body>

	<?php

	if (isset($_GET["id"])){
		if($_SESSION["question"]==-1){
			$_SESSION["question"]=0;
			echo(checkFirstTime());
			if(checkFirstTime()==1){// creation of the unique db file for the exercice
				//get dbname using user lastname :

				$userId=$_SESSION["user"];
           		$username=BDD::get()->query("SELECT `user_last_name` FROM `users` WHERE `user_id`= $userId")->fetchAll();
				$dbname=hash("MD5",$username[0]["user_last_name"]);
				$dbnameCorrec=$dbname."Correc";

				createBase($dbname);// creation db etudiant
				createBase($dbnameCorrec);//création db correction
				
				
				// get file name in bdd :

				$quizId=$_GET["id"];
				$quizname=BDD::get()->query("SELECT `quiz_database` FROM `quiz` WHERE `quiz_id`= $quizId")->fetchAll();
				echo("yes");
				var_dump($quizname);
				$filename=$quizname[0]["quiz_database"];

				importSqlFile($dbname,$filename);
    			importSqlFile($dbnameCorrec,$filename);
			}
		}elseif(isset($_POST["next"])){
			$_SESSION["question"]=$_SESSION["question"]+1;
		}elseif(isset($_POST["previous"]) and ($_SESSION["question"]>0)){
			$_SESSION["question"]=$_SESSION["question"]-1;
		}	
	}
	displayIntro();

	if (isset($_POST["reponse"])){
		
		include("Controller/correction.php");

		$userId=$_SESSION["user"]; //get user last name for hash
		$username=BDD::get()->query("SELECT `user_last_name` FROM `users` WHERE `user_id`= $userId")->fetchAll(); 
		$dbname=hash("MD5",$username[0]["user_last_name"]);
		$dbnameCorrec=$dbname."Correc";
		
		$getQuestionId=$_SESSION["question"];//get actual question id
		$questionId=BDD::get()->query("SELECT `question_id` FROM `question` WHERE `question_id`= $getQuestionId")->fetchAll();
		var_dump($questionId);
		$Id=$questionId[0][0];

		$resultat=dataBaseComparision($dbname,$dbnameCorrec,$_POST["reponse"],$_GET['id'],$Id); //call function correction
		echo " Résultat: ".$resultat[0]." - Points:".$resultat[1]." - Valide: ".$resultat[2];
		////////////////////////////////////test insertion user answer///////////////////////////////////////////
		writeUserAnswer($resultat[0],(int)$Id,(int)$userId,(int)$resultat[1], (int)$resultat[2], (int)$_GET['id']); //write user answer in database

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
		displayQuestion();
	}
	?>

</body>
