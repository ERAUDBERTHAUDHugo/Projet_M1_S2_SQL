

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

<?php
/*--------------------------------------------Afficher les eleves equipes/groupes selectionnés------------------------------------------------------*/

 function displayStudents($teamId,$groupId){ //id of groups and teams selected by admin
        //fusion + unique ids from arrays 
        $teams = array(4, 3,4);  //test
        $groups = array(0);
        $fusion = array_merge($teams, $groups);
        var_dump($fusion);
        $final=array_unique($fusion);
        var_dump($final);  

        //get team-group name to display
        $teamName=BDD::get()->query("SELECT `equipe_name`FROM `equipe` WHERE `equipe_id` = $teamId")->fetchAll();
        $groupName=BDD::get()->query("SELECT `groupe_name` FROM `groupe` WHERE `groupe_id` = $groupId")->fetchAll();
    ?>
        <div style="height: 300px; width: 50%; float:left;">
            <br>
            <h4><?php echo "Equipe: ".$teamName[0][0]." - Groupe: ".$groupName[0][0]; ?></h4>
            <link rel="stylesheet" href="https://unpkg.com/purecss@2.0.5/build/pure-min.css" integrity="sha384-LTIDeidl25h2dPxrB2Ekgc9c7sEC3CWGM6HeFmuDNUjX76Ert4Z4IY714dhZHPLd" crossorigin="anonymous">

                <?php //CREATE FOR
                //recuperer les users liés au groupes/teams sélectionés
                $groupUser=BDD::get()->query("SELECT `user_id`, `user_last_name`, `user_first_name`, `user_score` FROM `users` WHERE `user_group` = $groupId ORDER BY `user_last_name` ASC")->fetchAll();
                ?>
             <table class="pure-table pure-table-horizontal">
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Points</th>
<!--                    <th>TP</th>  -->
                    <th>Questions réussies</th>
                </tr>
                </thead>
                <tbody>

                    <?php 
                        $index=0;
                        foreach ($groupUser as $user) {
                            $idUser=$groupUser[$index]['user_id'];
                            //get usernumber of exercise done
                            $answeredUser=BDD::get()->query("SELECT COUNT(*) FROM `user_answer` WHERE `user_id` = $idUser AND `valide`= 1 ")->fetchAll();
                            ?>

                            <tr>
                                <td><?php echo $groupUser[$index]['user_last_name']; ?></td>
                                <td><?php echo $groupUser[$index]['user_first_name']; ?></td>
                                <td><?php echo $groupUser[$index]['user_score']; ?></td>
<!--                                <td><?php //echo $groupUser[$index]['user_score']; ?></td>             GET TP NAME-->
                                <td><?php echo $answeredUser[0][0]; ?></td>
                            </tr>
                        <?php  
                        $index+=1;      
                        }
                        ?>
                </tbody>
            </table>
        </div>
        <br>
    <?php
    }
/*-------------------------------------------- Fin Afficher les eleves equipes/groupes selectionnés------------------------------------------------------*/
?>

<?php
/*----------------------------------------------------- Afficher TreeView Checkbox-----------------------------------------------------------*/

function displayTreeViewCheckbox(){

    ?>
    <div style="height: 300px; width: 50%; float:left;">
    <form>
      <h3>Equipes</h3>
      <div class="tree">

    <?php
    //get all teams, all groups name
    $teams=BDD::get()->query("SELECT `equipe_id`, `equipe_name` FROM `equipe` ORDER BY `equipe_name` ASC")->fetchAll();

    $index=0;
    foreach ($teams as $team) {
         $teamId=$teams[$index]['equipe_id'];
         $groups=BDD::get()->query("SELECT `groupe_id`, `groupe_name` FROM `groupe` WHERE `equipe_id` = $teamId ORDER BY `groupe_name` ASC")->fetchAll();
     ?>
    
        <div>
          <input id="<?php echo "n-".$teams[$index]['equipe_id'];?>" type="checkbox">
          <label for="<?php echo "n-".$teams[$index]['equipe_id'];?>"><?php echo $teams[$index]['equipe_name'];?></label>
          <div class="sub">

            <?php 
            $index1=0;
            foreach ($groups as $group)
            {
            ?>
                <a href="#link"><?php echo $groups[$index1]['groupe_name'];?></a>

                <?php
            $index1+=1;
            }
            ?>

          </div>
        </div>


    <?php
    $index+=1;
    }
    ?>


      </div>
      <input type="reset" value="Reset">
    </form>   
    </div>

<?php
}
/*----------------------------------------------------- Fin Afficher TreeView Checkbox-----------------------------------------------------------*/
?>

<?php
/*
function getCheckBox(){ //all $_POST['team_id'from checkbox]
foreach ($variable as $key => $value) {
    $array = array_push($_POST);
}
*/
?>

