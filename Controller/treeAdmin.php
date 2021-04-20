<link rel="stylesheet" type="text/css" href="View/styleAdminPages.css">
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
?>

