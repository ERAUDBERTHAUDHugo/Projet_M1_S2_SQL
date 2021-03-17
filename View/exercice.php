<body>

	<div id=exercice>

		<?php 
		try{ 			 
			$con = new PDO('mysql:host=localhost;dbname=db_project','root','');  //Connection PDO à bdd à faire extérieurement
		}catch(PDOException $e){ 
				die('Erreur : '.$e->getMessage()); 
		} 
		?>

		<?php //display quiz info
		$quizId=0; //L'id du quiz est à récupérer par GET selon la page sélectionée par l'utilisateur
		$quizSelection= $con->query("SELECT `quiz_id`, `quiz_name`,`quiz_difficulty`, `quiz_description`, `quiz_database` FROM `quiz` WHERE `quiz_id`= $quizId")->fetch();
		?>

		<h1><?php echo $quizSelection['quiz_name']; ?></h1>

		<br> 
		<?php echo "Diffuculté: ".$quizSelection['quiz_difficulty']; ?>
		<br> 
		<?php echo "Enoncé: ".$quizSelection['quiz_description']; ?>

	</div>

	<div>
		<h3>Répondez à la question : </h3>

		<?php //display questions   
		$questionSelection= $con->query("SELECT `question_id`, `question_text`,`question_answer` FROM `question` WHERE `quiz_id`= $quizId");
 		foreach ($questionSelection as $question) {
 			?>
 			<div id='step' name='step'>

 			<?php
  			$questionText=$question['question_text'];
  			echo $questionText;
  			?>

  			<br> 
  				<input type="text" id="<?php echo($question['question_id']);?>" name="<?php echo($question['question_id']);?>">
  			<br>
 
  			<script>
			function next(el,index) {
  				document.getElementById(el).remove();
			}
			</script>

  			<button onclick="next('step')">Valider</button>
  			</div>
			
  			<br>
  			<?php
  		} 
		?>

		<br>
			

      	<?php //write user answers
      	//if(isset($_POST['submit'])){

      		// inserer apres infos user DATETIME, USERID LINK, USER INPUT VALUE
			

			//try{ 			 
			//$test = new PDO('mysql:host=localhost;dbname='.$quizSelection['quiz_database'],'root','');  //connexion à la bdd quiz
			//}catch(PDOException $e){ 
				//die('Erreur : '.$e->getMessage()); 
			//}

			//try{
				//$submitAnswers= $test->query($_POST[0])->fetch(); //test requete user sur la bdd du quiz 
			//}catch(PDOException $e){ 
				//die('Requête non valide!'); 
			//}
			
		//}

      	?>

	</div>

</body>