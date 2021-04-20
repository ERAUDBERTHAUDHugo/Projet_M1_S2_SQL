
<div id=adminContent>
    <?php
    include("Controller/displayAdminPages.php");

    if (isset($_GET["func"])){
        if($_GET["func"]=="groupes"){
            displayButtons("exercices","page principale");
            displayManageGroups();
            tabTeams();
        }elseif($_GET["func"]=="exercices"){
             ?>
             <div class="title-container">
                Gérer les exercices
            </div>
            
             <?php
             displayButtons("groupes","page principale");
             if(isset($_COOKIE["delete"])){
                deleteExercice();
             }
            displayManageExercise();
            tabExercice();
            tpManagement();
            tpManagementDisplay();
            
        }else{
            header('Location: index.php?page=dashboard');
        }
    }
    else{
        include("Controller/treeAdmin.php");
        displayButtons("groupes","exercices");
        $GroupsInfo=displayTreeViewCheckbox();
        if (isset(array_keys($_POST)[0])){
            displayStudents(array_keys($_POST)[0]);
        }
    }
    ?>

   
</div>





