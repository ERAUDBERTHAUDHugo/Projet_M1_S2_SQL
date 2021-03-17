<div id=dashboard>
	<div>
		<h1>Tableau de bord</h1>
	</div>  

	<br>

	<div>
		<?php
 
$dataPoints = array(
	array("label"=> "Réussite", "y"=> 5),
	array("label"=> "Echec", "y"=> 2),
);
	
?>
<!DOCTYPE HTML>
<html>
<head>  
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
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

		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html> 