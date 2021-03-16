<body>

	<div id=exercice>

		<?php 
		$quizId = 0;//Numéro du quizz dépend de la page cliquée (variable à mettre)
		$bddName = 'db_project';				//Nom de la base de donnée en jeu aussi
		?>

		<h1><?php echo "Quiz ".$quizId; ?></h1> 

		<?php 
		try{ 			 
			$con = new PDO('mysql:host=localhost;dbname='.$bddName,'root','');  //Connection PDO à bdd à faire extérieurement
		}catch(PDOException $e){ 
				die('Erreur : '.$e->getMessage()); 
		} 
		?>

	</div>

	<div>
		<h3>Answer All Questions : </h3>

		<?php
		$quizSelection= $con->query("SELECT `question_id`, `question_text`,`question_answer` FROM `question` WHERE `quizz_id`= $quizId");

 		foreach ($quizSelection as $question) {
  			$questionText=$question['question_text'];
  			echo $questionText;
  			?>
  			<br>
  			<input type="text" id="<?php echo($question['question_id']);?>" name="<?php echo($question['question_id']);?>">
  			<br>
  		<?php
  		}

		$quizSelection->closeCursor(); 
		?>

	</div>

</body>