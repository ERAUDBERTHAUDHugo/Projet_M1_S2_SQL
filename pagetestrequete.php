<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Page</title>
    </head>

    <body>
        <h1>Ceci est un test</h1>

		<?php 
		try{
			
			$con = new PDO('mysql:host=localhost;dbname=cycle_v3','root','');
			$response = $con->query("SELECT * FROM `fournisseur` ");

				while ($result = $response->fetch()) {
					echo ' '.$result['RAISON_SOCIALE'];
				}

			$response->closeCursor();

		}catch(PDOException $e){
				die('Erreur : '.$e->getMessage());
			}

        ?>


    </body>
</html>