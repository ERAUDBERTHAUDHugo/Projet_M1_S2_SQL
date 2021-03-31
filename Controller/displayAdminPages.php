

<?php
/*--------------------------------------------Page Gérer mes exercices------------------------------------------------------*/
function displayManageExercise(){
    if(isset($_POST["createExercise"])){
        if(!empty($_POST["exerciseName"]) AND !empty($_POST["SQLFile"]) AND !empty($_POST["QuestionFile"]) AND !empty($_POST["BDDFile"])){

        }
        else{
            $msg="Certains champs obligatoires ne sont pas complétés !";
        }
    }
?>

<div class="title-container">
    Gérer les exercices
</div>
<div class=container-info>
    <h3>Créer un nouvel exercice : </h3>
    <form method="POST" action="" name="createExerciseForm">
        
        <p>Titre de l'excercice :</p>
        <input type="text" name="exerciseName" placeholder="Titre de l'excercice" value="<?php if(isset($_POST["exerciseName"])) { echo $_POST["exerciseName"]; } ?>">
        
        <p>Description (facultatif) :</p>
        <textarea name="context" rows="10" cols="150" placeholder="Description de l'exercice"><?php if(isset($_POST["context"])) { echo $_POST["context"]; } ?></textarea><br /><br />
        
        <p>Importer le fichier SQL :</p>
        <input type="text" name="SQLFile" id="input_SQLFile" readonly="readonly" value="<?php if(isset($_POST["SQLFile"])) { echo $_POST["SQLFile"]; } ?>"/>
        <input type="file" accept="application/sql" onmousedown="return false" onkeydown="return false" onchange="document.getElementById('input_SQLFile').value = this.value" />
        
        <p>Importer les questions au format CSV :</p>
        <input type="text" name="QuestionFile" id="input_QuestionFile" readonly="readonly" value="<?php if(isset($_POST["QuestionFile"])) { echo $_POST["QuestionFile"]; } ?>"/>
        <input type="file" accept="text/csv" onmousedown="return false" onkeydown="return false" onchange="document.getElementById('input_QuestionFile').value = this.value" />
        
        <p>Importer l'image du modèle de la BDD :</p>
        <input type="text" name="BDDFile" id="input_BDDFile" readonly="readonly" value="<?php if(isset($_POST["BDDFile"])) { echo $_POST["BDDFile"]; } ?>"/>
        <input type="file" accept="image/png, image/jpeg" onmousedown="return false" onkeydown="return false" onchange="document.getElementById('input_BDDFile').value = this.value" /><br/><br/>
        
        <input type="submit" class="button" value="Créer l'exercice" name="createExercise">
    </form>
    <?php
        if(isset($msg)){
            echo $msg;
        }
    ?>
</div>
<?php 
} 
/*--------------------------------------------Fin Page Gérer mes exercices------------------------------------------------------*/
?>



<?php
/*--------------------------------------------Page Gérer mes groupes------------------------------------------------------*/
function displayManageGroups(){
    if(isset($_POST["addTeam"])){
        if(!empty($_POST["teamName"])){
        
        }
        else{
            $msg="Veuillez compléter le nom de votre équipe";
        }
    }   
    if(isset($_POST["addGroup"])){
        if(!empty($_POST["groupName"]) AND !empty($_POST["studentListFile"])){
        
        }
        else{
            $msg="Tous les champs doivent être complétés !";
        }
    }
?>

<div class="title-container">
    Gérer les groupes
</div>
<div class="container-info">    
    <h3>Ajouter une équipe</h3>
    <form method="POST" action="" name="addTeamForm">
        <p>Nom d'équipe :</p>
        <input type="text" name="teamName" placeholder="Nom de l'équipe" value="<?php if(isset($_POST["teamName"])) { echo $_POST["teamName"]; } ?>"><br/><br/>
        
        <input type="submit" class="button" value="Ajouter l'équipe" name="addTeam">
    </form>
    <?php
    if(isset($msg)){
        echo $msg;
    }
    ?>
</div>
<div class="container-info">
    <h3>Ajouter un groupe</h3>
    <form method="POST" action="" name="addGroupForm">
        <p>Nom du groupe :</p>
        <input type="text" name="groupName" placeholder="Nom du groupe" value="<?php if(isset($_POST["groupName"])) { echo $_POST["groupName"]; } ?>">
        
        <p>Selectionner l'équipe du groupe :</p>
        
        <p>Importer la liste d'étudiants au format CSV :</p>
        <input type="text" name="studentListFile" id="input_StudentListFile" readonly="readonly" value="<?php if(isset($_POST["studentListFile"])) { echo $_POST["studentListFile"]; } ?>"/>
        <input type="file" accept="text/csv" onmousedown="return false" onkeydown="return false" onchange="document.getElementById('input_StudentListFile').value = this.value" /><br/><br/>
        
        <input type="submit" class="button" value="Ajouter le groupe" name="addGroup">
    </form>
    <?php
    if(isset($msg)){
        echo $msg;
    }
    ?>
</div>

<?php
}
/*--------------------------------------------Fin Page Gérer mes groupes------------------------------------------------------*/
?>

<?php
/*--------------------------------------------Afficher les boutons liant les 3 pages entre elles------------------------------------------------------*/
function displayButtons($button1,$button2) {
?>

<div class="container-button">
    <a href="?page=adminDashboard&func=<?php echo($button1); ?>"><button class="button">Gérer mes <?php echo($button1); ?></button></a>
    <?php
    if($button2=="page principale"){?>
        <a href="?page=adminDashboard&func=<?php echo($button2); ?>"><button class="button">Retourner à la <?php echo($button2); ?></button></a>
    <?php }
    else{?>
        <a href="?page=adminDashboard&func=<?php echo($button2); ?>"><button class="button">Gérer mes <?php echo($button2); ?></button></a>
    <?php } ?>
</div>
    
<?php
}
/*--------------------------------------------Fin Afficher les boutons liant les 3 pages entre elles------------------------------------------------------*/
?>