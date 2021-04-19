<?php
/*--------------------------------------------Page Gérer mes exercices------------------------------------------------------*/
include ("filesManagement.php");
function displayManageExercise(){
    if(isset($_POST["createExercise"])){
        $nameAlreadyUsed=0;

        if(!empty($_FILES["ImgModelMCD"]) AND !empty($_FILES["SQLFile"]) AND !empty($_FILES["QuestionFile"])){
            
            if(!empty($_POST['BDDFile']))
            {
                // On verifie si le champ est rempli
                if( !empty($_FILES["ImgModelMCD"]['name']))
                {
                    $returnQuestionFile=uploadCsvQuiz();
                    $returnSqlFile=uploadSqlFile();
                    $returnImage=uploadImgExercise();
                    // if all file are uploaded, then proced to create exercise : 
                    if ($returnQuestionFile[0]==1 AND $returnSqlFile[0]==1 AND $returnImage[0]==1){
                        addExercise($returnQuestionFile[1],$returnSqlFile[1],$returnImage[1]);
                        $msg="L'exercice a bien été créé ! ";
                        ?>
                        <div id="exerciceAdded">
                            <p>Votre exercice a bien été ajouté et est disponible dès maintenant  !</p> 
                        </div>
                        <?php
                    }else{
                        $msg=$returnImage[1];
                    }
                    
                }else{
                    $msg="Nom du fichier d'image invalide";
                }
            }
            else{
               // Sinon on affiche une erreur pour le champ vide
               $msg = 'Vous n\'avez pas mis d\'image MCD de l\'exercice';
               //echo "yes";
            }
            
        }
        else{
                $msg="Certains champs obligatoires ne sont pas complétés";
            }
        } 
?>


<div class="container-info">
    <h3>Créer un nouvel exercice : </h3>
    <form method="post" action="" name="createExerciseForm" enctype="multipart/form-data">
        
        <p>Titre de l'excercice :</p>
        <input type="text" name="exerciseName" placeholder="Titre de l'excercice" value="<?php if(isset($_POST["exerciseName"])) { echo $_POST["exerciseName"]; } ?>">
        
        <p>Description (facultatif) :</p>
        <textarea name="context" rows="10" cols="150" placeholder="Description de l'exercice"><?php if(isset($_POST["context"])) { echo $_POST["context"]; } ?></textarea><br /><br />
        
        <p>Importer le fichier SQL : </p>
        <input type="text"  id="input_SQLFile" readonly="readonly"/>
        <input type="file" name="SQLFile" accept="application/sql" onmousedown="return false" onkeydown="return false" onchange="document.getElementById('input_SQLFile').value = this.value" />
        
        <p>Importer les questions au format CSV : </p>
        <input type="text"  id="input_QuestionFile" readonly="readonly"/>
        <input type="file" name="QuestionFile" accept="text/csv" onmousedown="return false" onkeydown="return false" onchange="document.getElementById('input_QuestionFile').value = this.value" />
        
        <p>Importer l'image du modèle de la BDD : </p>
        <input type="text" name="BDDFile" id="input_BDDFile" readonly="readonly"/>
        <input type="file" name="ImgModelMCD" name="ImgModelMCD" accept="image/png, image/jpeg" onmousedown="return false" onkeydown="return false" onchange="document.getElementById('input_BDDFile').value = this.value" /><br/><br/>
        
        <input type="submit" class="button" value="Créer l'exercice" name="createExercise">
    </form>
    <?php
        if(isset($msg)){
            echo $msg;
        }
        

    if(isset($message)){
        echo $message;
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
    
    if(isset($_POST["addGroup"])){
        if(!empty($_POST["studentListFile"])){
            $returnCsvStudent=uploadCsvStudents();
            if ($returnCsvStudent[0]==1){
                echo("to");
                dispatchStudent($returnCsvStudent[1]);
            }
        }
        else{
            $msg="Tous les champs doivent être complétés !";
        }
    }
?>

<div class="title-container">
    Gérer les équipes et groupes
</div>
<div class="container-info">
    <h3>Mise à jour des listes étudiants</h3>
    <form method="POST" action="index.php?page=adminDashboard&func=groupes" name="addGroupForm" enctype="multipart/form-data">
        <p>Importer la liste d'étudiants au format CSV :</p>
        <input type="text" name="studentListFile" id="input_StudentListFile" readonly="readonly" />
        <input type="file"  name="fileToUpload" id="fileToUpload" accept="text/csv" onmousedown="return false" onkeydown="return false" onchange="document.getElementById('input_StudentListFile').value = this.value">
        <input type="submit" class="button" value="Mettre à jour les étudiants" name="addGroup">
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
/*----------------------------------Fin Afficher les boutons liant les 3 pages entre elles------------------------------------------------------*/
?>

<?php
/*--------------------------------------------Afficher les eleves equipes/groupes selectionnés------------------------------------------------------*/

 function displayStudents($PostNameGroup){ //id of groups and teams selected by admin

        //get group ids checked
        $InfoIds=BDD::get()->query("SELECT `groupe_id`, `equipe_id`FROM `groupe` WHERE `groupe_name` = '$PostNameGroup'")->fetchAll();
        $groupId=$InfoIds[0][0];
        $teamId=$InfoIds[0][1];

        //get team-group name to display
        $teamName=BDD::get()->query("SELECT `equipe_name`FROM `equipe` WHERE `equipe_id` = $teamId")->fetchAll();
        $groupName=BDD::get()->query("SELECT `groupe_name` FROM `groupe` WHERE `groupe_id` = $groupId")->fetchAll();
    ?>
        <div style="height: 300px; width: 50%; float:left;">
            <br>
            <h4><?php echo "Equipe: ".$teamName[0][0]." - Groupe: ".$groupName[0][0]; ?></h4>
            <link rel="stylesheet" href="https://unpkg.com/purecss@2.0.5/build/pure-min.css" integrity="sha384-LTIDeidl25h2dPxrB2Ekgc9c7sEC3CWGM6HeFmuDNUjX76Ert4Z4IY714dhZHPLd" crossorigin="anonymous">

                <?php
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
                            $answeredUser=BDD::get()->query("SELECT COUNT(*) FROM `user_answer` WHERE `user_id` = $idUser AND `valide`= 1 ")->fetchAll();
                            ?>
                            <tr>
                                <td><a href="index.php?page=dashboard&userBoard=<?php echo $idUser; ?>"><?php echo $groupUser[$index]['user_last_name']; ?></a></td>
                                <td><?php echo $groupUser[$index]['user_first_name']; ?></td>
                                <td><?php echo $groupUser[$index]['user_score']; ?></td>
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
/*------------------------------------------- Fin Afficher les eleves equipes/groupes selectionnés------------------------------------------------------*/
?>

<?php
/*----------------------------------------------------- Afficher TreeView Checkbox-----------------------------------------------------------*/

function displayTreeViewCheckbox(){

    ?>
    <div style="height: 300px; width: 50%; float:left;">
    <form action="index.php?page=adminDashboard" method="POST">
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
          <label class="general" for="<?php echo "n-".$teams[$index]['equipe_id'];?>"><?php echo $teams[$index]['equipe_name'];?></label>
          <div class="sub">

            <?php 
            $index1=0;
            foreach ($groups as $group)
            {
            ?> 
                <input type="checkbox" id="<?php echo $groups[$index1]['groupe_id'];?>" name= "<?php echo $groups[$index1]['groupe_name'];?>" onclick="this.form.submit()";>
                <label class= "general" for="<?php echo $groups[$index1]['groupe_id'];?>"><?php echo $groups[$index1]['groupe_name'];?></label>

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
      <input class="reset resetfocus" type="reset" value="Reset">
    </form>   
    </div>

<?php
return array($teams, $groups);//check values
}
/*----------------------------------------------------- Fin Afficher TreeView Checkbox-----------------------------------------------------------*/
/*----------------------------------------------------- Afficher/supprimer les exercices-----------------------------------------------------------*/
function tabExercice(){
    ?>
    <form action="index.php?page=adminDashboard&func=exercices" method="post">
        <table>
            <thead>
                <tr>
                <th colspan="3">Vos exerices disponbibles en ligne</th>
                </tr>
                <tr>
                <th ><?php echo("<input type='checkbox' onclick='selectAll(this)' name='selectAllExercice' /><label ></label>");?>All</th>
                <th>Nom</th>
                <th >Nombre de questions</th>
                </tr>
            </thead>
            <tbody>
        
    <?php
    $exercices=BDD::get()->query("SELECT `quiz_name`,`quiz_id` FROM `quiz` ")->fetchAll();
    if (!empty($exercice)){
        foreach ($exercices as $exo){
            $quiz_id=$exo['quiz_id'];
            $questionsOfExo=BDD::get()->query("SELECT `question_id` FROM `question` WHERE `quiz_id`=$quiz_id ")->fetchAll();
            $countQuestion=0;
            foreach ($questionsOfExo as $ques){
                $countQuestion=$countQuestion+1;
            }
            ?>
            <tr>
                <td> <?php echo("<input type='checkbox' class='exerciceCheck'name='quiz".$quiz_id."' /><label></label>"); ?> </td>
                <td> <?php echo($exo['quiz_name']); ?> </td>
                <td> <?php echo($countQuestion); ?> </td>
            </tr>

            <?php
        }
    } else{
        ?>
        <td colspan="3"> Pas d'exercices à afficher pour l'instant !  </td>
        <?php
    }
    ?>
            </tbody>
        </table>
        <button type="submit" name="deleteExercice" onclick="deleteConfirm(this)">Supprimer les exercices séléctionnés</button>
    </form>
    <?php
    //var_dump($exercices);
}
function deleteExercice(){
    $exercices=BDD::get()->query("SELECT `quiz_name`,`quiz_id` FROM `quiz` ")->fetchAll();
    foreach ($exercices as $exo){
        $postName="quiz".$exo['quiz_id'];
        if(isset($_POST[$postName])){
            // delete quiz's question 
            // delete quiz
            $quiz_id=$exo['quiz_id'];
            $deleteQuiz = BDD::get()->prepare('DELETE FROM quiz WHERE quiz_id=:id LIMIT 1');  
            $deleteQuiz->bindParam(':id',$quiz_id);
            $deleteQuiz->execute();
            echo("on va supprimer le quiz".$exo['quiz_id']);
        }
    }
    return 1;
}
/*-----------------------------------------------------FIn Afficher/supprimer les exercices-----------------------------------------------------------*/


?>


<?php
/*----------------------------------------------------- Gestion TPs ----------------------------------------------------------*/
function tpManagementDisplay(){
?>
    <div style="height: 300px; width: 50%;">
        <br>
        <h3>Gérer mes TPs</h3>
        <form method="post" action="index.php?page=adminDashboard&func=exercices" name="manageTpForm">

            <!-- Create-->
            <label for="createSelect">Créer un TP</label>

            <br>
            <input type="text" placeholder="Nom du nouveau TP" id="createName1" name="createName1" >

            <?php 
            $exerciseSelect=BDD::get()->query("SELECT * FROM `quiz` ")->fetchAll();
            $teamSelect=BDD::get()->query("SELECT * FROM `equipe` ")->fetchAll();
            ?>

            <select name="setExerciseSelect" id="setExerciseSelect">
                <option value="">--Choix Exercice--</option>

                <?php
                $num = 0;
                foreach($exerciseSelect as $exerciseAvailable){
                ?>
                <option value="<?php echo($exerciseSelect[$num]['quiz_id']); ?>"><?php echo($exerciseSelect[$num]['quiz_name']); ?></option>
                <?php  
                $num+=1;  
                }
                ?>

            </select>

            <select name="setTeamSelect" id="setTeamSelect">
                <option value="">--Choix Equipe--</option>

                <?php
                $num = 0;
                foreach($teamSelect as $teamAvailable){
                ?>
                <option value="<?php echo($teamSelect[$num]['equipe_id']); ?>"><?php echo($teamSelect[$num]['equipe_name']); ?></option>
                <?php  
                $num+=1;  
                }
                ?>

            </select>

            <br>
            <!-- Modify-->
            <label for="modifSelect">Modifier un TP</label>

            <br>

            <?php 
            $tpSelectModif=BDD::get()->query("SELECT * FROM `tp` ")->fetchAll();
            $exerciseSelectModif=BDD::get()->query("SELECT * FROM `quiz` ")->fetchAll();
            $teamSelectModif=BDD::get()->query("SELECT * FROM `equipe` ")->fetchAll();
            ?>

            <select name="setNameSelectModif" id="setNameSelectModif">
                <option value="">--TP à Modifier--</option>

                <?php
                $num = 0;
                foreach($tpSelectModif as $tpAvailableModif){
                ?>
                <option value="<?php echo($tpSelectModif[$num]['tp_name']); ?>"><?php echo($tpSelectModif[$num]['tp_name']); ?></option>
                <?php  
                $num+=1;  
                }
                ?>

            </select>

            <select name="setExerciseSelectModif" id="setExerciseSelectModif">
                <option value="">--Choix Exercice--</option>

                <?php
                $num = 0;
                foreach($exerciseSelectModif as $exerciseAvailableModif){
                ?>
                <option value="<?php echo($exerciseSelectModif[$num]['quiz_id']); ?>"><?php echo($exerciseSelectModif[$num]['quiz_name']); ?></option>
                <?php  
                $num+=1;  
                }
                ?>

            </select>

            <select name="setTeamSelectModif" id="setTeamSelectModif">
                <option value="">--Choix Equipe--</option>

                <?php
                $num = 0;
                foreach($teamSelectModif as $teamAvailableModif){
                ?>
                <option value="<?php echo($teamSelectModif[$num]['equipe_id']); ?>"><?php echo($teamSelectModif[$num]['equipe_name']); ?></option>
                <?php  
                $num+=1;  
                }
                ?>

            </select>

            <br>
            <!-- Delete-->
            <label for="deleteSelect">Supprimer un TP</label>

            <br>

            <?php 
            $tpSelectDel=BDD::get()->query("SELECT * FROM `tp` ")->fetchAll();
            ?>

            <select name="setNameSelectDel" id="setNameSelectDel">
                <option value="">--TP à Supprimer--</option>

                <?php
                $num = 0;
                foreach($tpSelectDel as $tpAvailableDel){
                ?>
                <option value="<?php echo($tpSelectDel[$num]['tp_name']); ?>"><?php echo($tpSelectDel[$num]['tp_name']); ?></option>
                <?php  
                $num+=1;  
                }
                ?>

            </select>

            <br><br>
            <input type="submit" class="button" value="Appliquer les changements" name="manageTpSubmit">
            <br><br>   
        </form>
    <div>

<?php
}
    //Apply database modications 
function tpManagement(){

    //Create
    if(isset($_POST['createName1']) && isset($_POST['setExerciseSelect']) && isset($_POST['setTeamSelect'])){
        if(!($_POST['createName1']=='') && !($_POST['setExerciseSelect']=='') && !($_POST['setTeamSelect']=='')){

            $createName = $_POST['createName1'];
            $newExercise = (int)$_POST['setExerciseSelect'];
            $newTeam = (int)$_POST['setTeamSelect'];  

            try{

                $createTp=BDD::get()->prepare("INSERT INTO tp VALUES (NULL, :tp_name, :quiz_id, :equipe_id)");

                $createTp->bindParam(':tp_name',$createName);
                $createTp->bindParam(':quiz_id',$newExercise);
                $createTp->bindParam(':equipe_id',$newTeam);

                $createTp->execute();

                echo "Création réussie!";
            }catch(Error $e){
                echo "Erreur lors de la création!";
            }
        }
    }

    //Modify
    if(isset($_POST['setNameSelectModif']) && isset($_POST['setExerciseSelectModif']) && isset($_POST['setTeamSelectModif'])){

        if(!($_POST['setNameSelectModif']=='') && !($_POST['setExerciseSelectModif']=='') && !($_POST['setTeamSelectModif']=='')){

            $modifyName = $_POST['setNameSelectModif'];
            $modifyExercise = (int)$_POST['setExerciseSelectModif'];
            $modifyTeam = (int)$_POST['setTeamSelectModif']; 

            try{

                $modifyTp=BDD::get()->query("UPDATE `tp` SET `quiz_id`= '$modifyExercise', `equipe_id`= '$modifyTeam' WHERE `tp_name` = '$modifyName'")->fetchAll();
                echo "Modification réussie!";
            }catch(Error $e){
                echo "Erreur lors de la modification!";
            }
        }
    }

    //Delete
    if(isset($_POST['setNameSelectDel'])){
        if(!($_POST['setNameSelectDel'])==''){

            $deleteName = $_POST['setNameSelectDel'];

            try{
                $deleteTp=BDD::get()->query("DELETE FROM `tp` WHERE `tp_name` = '$deleteName'")->fetchAll();
                echo "Suppression réussie!";
            }catch(Error $e){
                echo "Nom de l'exercice à supprimer invalide!";
            }
        }
    }  

    unset($_POST); 
}

?>