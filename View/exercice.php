<body>

	<div id=exercice>

		<?php 
		try{ 			 
			$con = new PDO('mysql:host=localhost;dbname=db_project','root','');  //Connection PDO à bdd à faire extérieurement
		}catch(PDOException $e){ 
				die('Erreur : '.$e->getMessage()); 
		} 
		?>

		<?php //display quizz info
		$quizId=0;
		$quizSelection= $con->query("SELECT `quizz_id`, `quizz_name`,`quizz_difficulty`, `quizz_description` FROM `quizz` WHERE `quizz_id`= $quizId")->fetch();
		?>

		<h1><?php echo $quizSelection['quizz_name']; ?></h1>

		<br> 
		<?php echo "Diffuculté: ".$quizSelection['quizz_difficulty']; ?>
		<br> 
		<?php echo "Enoncé: ".$quizSelection['quizz_description']; ?>

	</div>

	<div>
		<h3>Answer All Questions : </h3>

		<?php //display questions   
		$questionSelection= $con->query("SELECT `question_id`, `question_text`,`question_answer` FROM `question` WHERE `quizz_id`= $quizId");

 		foreach ($questionSelection as $question) {
  			$questionText=$question['question_text'];
  			echo $questionText;
  			?>
  			<br> 
  			<input type="text" id="<?php echo($question['question_id']);?>" name="<?php echo($question['question_id']);?>">
  			<br>
  		<?php
  		} 
		?>

		<br>
		<form action='' method='POST'>
			<input type="submit" name="submitAnswers" value="Submit">
		</form>

      	<?php //write user answers
      	if(isset($_POST['submit'])){
			//$submitAnswers= $con->query("INSERT INTO user_answer(user_text) VALUES (1)"); ------> INSERT DATETIME, USERID LINK, USER INPUT VALUE
		}
		//$submitAnswers->closeCursor(); 
      	?>

	</div>

</body>