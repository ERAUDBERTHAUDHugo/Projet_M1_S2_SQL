<link rel="stylesheet" type="text/css" href="View/styleDashboard.css">
<div id=dashboard>
	<div>
		<h1>Tableau de bord</h1>
		<h2>Bonjour User Name!<h2>
	</div>  

	<br>

	<div>
<!--  ----------------------------data for diagrams-------------------------- -->
	<?php
 
	$dataPie = array(
		array("label"=> "Réussite", "y"=> 5),
		array("label"=> "Echec", "y"=> 2),
	);

	 $dataCurve = array(
	array("x" => 946665000000, "y" => 3),
	array("x" => 978287400000, "y" => 4),
	array("x" => 1009823400000, "y" => 8),
 	);
	
?>

<!--  ----------------------------diagrams reation-------------------------- -->

<script>
window.onload = function () {
 
var chart1 = new CanvasJS.Chart("chartContainer1", {
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
	data: [{
		type: "spline",
		lineColor: "green",
		markerSize: 5,
		xValueFormatString: "YYYY",
		xValueType: "dateTime",
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
	<table class="pure-table pure-table-horizontal">
    <thead>
        <tr>
            <th>#</th>
            <th>Nom</th>
            <th>Score</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>Student 1</td>
            <td>99</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Student</td>
            <td>97</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Student 3</td>
            <td>90</td>
        </tr>
    </tbody>
	</table>
	</div>
	<!-- ---------------------------------table to make dynamic ----------------------------->
    <br>
    <div style="height: 300px; width: 50%; float:left;">
    <h4>Mes exercices</h4>
    <table class="pure-table pure-table-horizontal">
    <thead>
        <tr>
            <th>Exercice</th>
            <th>Date</th>
            <th>Score</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>6</td>
            <td>11 09 2021</td>
            <td>2</td>
        </tr>
        <tr>
            <td>2</td>
            <td>14 09 2021</td>
            <td>5</td>
        </tr>
        <tr>
            <td>1</td>
            <td>21 10 2021</td>
            <td>2</td>
        </tr>
    </tbody>
	</table>
	<div>
</body>
