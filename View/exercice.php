<body>

	<?php
	var_dump([$_SESSION]);
	var_dump($_POST);
	if (isset($_GET["id"])){
		if($_SESSION["question"]==-1){
			$_SESSION["question"]=0;
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
