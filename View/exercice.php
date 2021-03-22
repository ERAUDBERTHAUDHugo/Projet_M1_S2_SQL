<body>

	<?php
	var_dump($_POST);
	
	if (isset($_GET["id"])){
		if($_SESSION["question"]==-1){
			$_SESSION["question"]=0;
			echo(checkFirstTime());
			if(checkFirstTime()==1){// creation of the unique db file for the exercice
				//get dbname using user lastname :

				$userId=$_SESSION["user"];
           		$username=BDD::get()->query("SELECT `user_last_name` FROM `users` WHERE `user_id`= $userId")->fetchAll();
				$dbname=hash("MD5",$username[0]["user_last_name"]);

				// get file name in bdd :
				$quizId=$_GET["id"];
				$quizname=BDD::get()->query("SELECT `quiz_database` FROM `quiz` WHERE `quiz_id`= $quizId")->fetchAll();
				$filename=$quizname[0]["quiz_database"];
				echo($filename);
				echo($dbname);
				createBase($dbname);
    			importSqlFile($dbname,$filename);
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
