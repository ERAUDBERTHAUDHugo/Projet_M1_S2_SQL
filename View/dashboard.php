

<link rel="stylesheet" type="text/css" href="View/styleDashboard.css">

<div id=dashboard>
	<div>
		<?php
		$userBoard=$_GET["id"];
		//get user info
    	$userInfo=BDD::get()->query("SELECT `user_adress`, `user_last_name`, `user_first_name`, `user_score` FROM `users` WHERE `user_id`= $userBoard")->fetchAll();
		?>
		<h1>Tableau de bord</h1>
		<h2>Bonjour <?php echo $userInfo[0]['user_first_name'].' '.$userInfo[0]['user_last_name'];?> !<h2> <!-- display user info-->

	</div>  

	<br>

	<div>
<!--  ----------------------------data for diagrams-------------------------- -->
	<?php
	//recuperer le nombre de réponses valides et invalides
    $userValid=BDD::get()->query("SELECT COUNT(*) FROM `user_answer` WHERE `user_id`= $userBoard AND `valide`=1")->fetchAll();
    $userInvalid=BDD::get()->query("SELECT COUNT(*) FROM `user_answer` WHERE `user_id`=$userBoard AND `valide`=0")->fetchAll();

	$dataPie = array(
		array("label"=> "Réussite", "y"=> (int)$userValid[0][0]),
		array("label"=> "Echec", "y"=> (int)$userInvalid[0][0]),
	);

	//recuperer les scores totaux au fil du temps --> affichage scpre à chaque timestamp (question répondue)
	$scoresTime=BDD::get()->query("SELECT `user_answer_time` FROM `user_answer` WHERE `user_id`=$userBoard")->fetchAll();
	 // à faire pour chaque date length(times available)
	$i=0;
	$dataCurveTest=array();
	foreach ($scoresTime as $scoreTime) {
		$time = $scoresTime[$i]['user_answer_time'];
		$userEvolution=BDD::get()->query("SELECT SUM(`question_score`) FROM `user_answer` WHERE `user_id`= $userBoard  AND `user_answer_time`<= '$time'")->fetchAll(); // a changer avec vrai timestamp
		$arrayData = array("x" => $time, "y" => $userEvolution[0][0]);
		$dataCurve = array_merge($dataCurveTest,array($arrayData)); //probleme dans data (ajout des array)

		$i++;
	}
	var_dump($dataCurve); //gerer les dateTime pour l'affichage --> format
	

	// $dataCurve = array( -->test de depart
	//array("x" => $time, "y" => $userEvolution[0][0]),
	//array("x" => 4, "y" => 4),
	//array("x" => 5, "y" => 8),
 	//);
	
?>

<!--  ----------------------------diagrams creation-------------------------- -->

<script>
window.onload = function () {
 
var chart1 = new CanvasJS.Chart("chartContainer1", {
	animationEnabled: true,
	title:{
		text: "Taux de réussite des exercices"
	},
	subtitles: [{
		text: "Part en pourcentage"
	}],
	data: [{
		type: "pie",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} - #percent%",

		dataPoints: <?php echo json_encode($dataPie, JSON_NUMERIC_CHECK); ?>
	}]
});
chart1.render();

var chart2 = new CanvasJS.Chart("chartContainer2", {
	animationEnabled: true,
	title:{
		text: "Evolution de votre score"
	},
	axisY: {
		title: "Score",
		suffix: " pts",
	},
	axisX: {
		title: "Mois",
		xvalueFormatString:"#",
	},
	data: [{
		type: "spline",
		lineColor: "green",
		markerSize: 5,
		dataPoints: <?php echo json_encode($dataCurve, JSON_NUMERIC_CHECK); ?>
	}]
});
chart2.render();
 
}
</script>



<!--  ----------------------------diagrams display-------------------------- -->
<body>

	<div id="chartContainer1" style="height: 300px; width: 50%; float:left;"></div>
	<br>
	<div id="chartContainer2" style="height: 300px; width: 50%; float:left;"></div>
	<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
	<br>
	<!-- ---------------------------------table to make dynamic ----------------------------->

	<div style="height: 300px; width: 50%; float:left;">
		<br>
	<h4>Classement</h4>
	<link rel="stylesheet" href="https://unpkg.com/purecss@2.0.5/build/pure-min.css" integrity="sha384-LTIDeidl25h2dPxrB2Ekgc9c7sEC3CWGM6HeFmuDNUjX76Ert4Z4IY714dhZHPLd" crossorigin="anonymous">

        <?php 
	//recuperer les ranking disponibles
        $userRanking=BDD::get()->query("SELECT `user_first_name`, `user_score` FROM `users` ORDER BY `user_score` DESC")->fetchAll();
  		?>
     <table class="pure-table pure-table-horizontal">
    	<thead>
    	<tr>
            <th>#</th>
            <th>Nom</th>
            <th>Score Total</th>
        </tr>
    	</thead>
    	<tbody>

    		<?php 
            	$index=0;
            	foreach ($userRanking as $rankedUser) {
                	if($index<=9){      //afficher le top 10
        			?>
    				<tr>
            			<td><?php echo $index+1; ?></td>
            			<td><?php echo $userRanking[$index]['user_first_name']; ?></td>
            			<td><?php echo $userRanking[$index]['user_score']; ?></td>
        			</tr>
				<?php  
                	}
                $index+=1;      
            	}
         		?>
   		</tbody>
		</table>

	</div>
	<!-- ---------------------------------table to make dynamic ----------------------------->
    <br>
    <div style="height: 300px; width: 50%; float:left;">
    	<br>
    <h4>Mes derniers exercices</h4>
    <?php 
	//recuperer les exercices faits disponibles
        $userAnswers=BDD::get()->query("SELECT `user_id`, `user_answer_time`, `question_id`, `question_score`, `quiz_id` FROM `user_answer` WHERE `user_id`= $userBoard ORDER BY `user_answer_time` DESC")->fetchAll(); 
  	?>
     <table class="pure-table pure-table-horizontal">
    	<thead>
    	<tr>
            <th>Exercice</th>
            <th>Question</th>
            <th>Date</th>
            <th>Score</th>
        </tr>
    	</thead>
    	<tbody>

    		<?php 
            	$index=0;
            	foreach ($userAnswers as $question) {
                	if($index<=9){      //afficher les 10 derniers exercices faits
                	$quizId=(int)$userAnswers[$index]['quiz_id'];
        			$userQuiz=BDD::get()->query("SELECT `quiz_name` FROM `quiz` WHERE `quiz_id`=$quizId")->fetchAll();
        			?>
    				<tr>
    					<td><?php echo $userQuiz[0]['quiz_name']; ?></td>
            			<td><?php echo $userAnswers[$index]['question_id']; ?></td>
            			<td><?php echo $userAnswers[$index]['user_answer_time']; ?></td>
            			<td><?php echo $userAnswers[$index]['question_score']; ?></td>
        			</tr>
				<?php  
                	}
                $index+=1;      
            	}
         		?>
   		</tbody>
		</table>
	</div>

<!-- if user is admin (user_role==1) afficher rubrique gestion des exercices-->
</body>

<br>
Obligée d'ecrire quelque chose là sinon le footer se met mal, erreur à régler!
