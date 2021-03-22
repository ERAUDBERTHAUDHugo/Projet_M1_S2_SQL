

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
		<h3>Ton score actuel est de <?php echo $userInfo[0]['user_score']?> points.</h3>

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


	//recuperer les scores totaux au fil du temps
	$userEvolution=BDD::get()->query("SELECT COUNT(*) FROM `user_answer` WHERE `user_id`=$userBoard AND `valide`=0")->fetchAll();
	//gerer les dateTime pour l'affichage --> format
	 $dataCurve = array(
	array("x" => 3, "y" => 3),
	array("x" => 4, "y" => 4),
	array("x" => 5, "y" => 8),
 	);
	
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
	<div id="chartContainer2" style="height: 300px; width: 45%; float:left;"></div>
	<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
	<br>
	<!-- ---------------------------------table to make dynamic ----------------------------->

	<div style="height: 300px; width: 50%; float:left;">
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
    <h4>Mes derniers exercices</h4>
    <?php 
	//recuperer les exercices faits disponibles
        $userAnswers=BDD::get()->query("SELECT `user_id`, `user_answer_time`, `question_id`, `question_score`FROM `user_answer` WHERE `user_id`= $userBoard ORDER BY `user_answer_time` DESC")->fetchAll(); 
  	?>
     <table class="pure-table pure-table-horizontal">
    	<thead>
    	<tr>
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
        			?>
    				<tr>
            			<td><?php echo "Question n°".$userAnswers[$index]['question_id']; ?></td>
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
<!--	<?php 
	$user_role=1; //admin pour test, à determiner avec requete user session
	if($user_role==1){
		?>
		<div>
			<h4>Gérer les exercices</h4>
		</div>
		<?php
	}
	?> -->
</body>
