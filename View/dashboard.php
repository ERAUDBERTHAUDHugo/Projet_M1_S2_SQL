

<link rel="stylesheet" type="text/css" href="View/styleDashboard.css">

<div id=dashboard>
	<div>
		<?php
		$userBoard=$_SESSION["user"];
		//get user info
    	$userInfo=BDD::get()->query("SELECT `user_adress`, `user_last_name`, `user_first_name`, `user_score` FROM `users` WHERE `user_id`= $userBoard")->fetchAll();
		?>
		<h1>Tableau de bord</h1>
		<h2>Bonjour <?php echo $userInfo[0]['user_first_name'].' '.$userInfo[0]['user_last_name'];?> !</h2> <!-- display user info-->
	</div>  
	<br>

	<?php
	include("Controller/displayDashboard.php");

	displayGraphs($userBoard); //display diagrams
	displayRanking(); //display global ranking
	displayQuestionHistory($userBoard); //display questions done by user
	?>

</div>


