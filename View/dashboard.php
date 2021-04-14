
<link rel="stylesheet" type="text/css" href="View/styleDashboard.css">

<div id=dashboard>
    <div>
        <?php

        if(isset($_GET['userBoard'])){
            $userBoard=$_GET['userBoard'];    //link from admin dashboard to check students results
            //get user info
            $userInfo=BDD::get()->query("SELECT user_adress, user_last_name, user_first_name, user_score FROM users WHERE user_id= $userBoard")->fetchAll();
        ?>
            <h2>Etudiant: <?php echo $userInfo[0]['user_first_name'].' '.$userInfo[0]['user_last_name'];?> !</h2> <!-- display user info-->
        <?php
            include("Controller/displayDashboard.php");

            displayGraphs($userBoard); //display diagrams
            displayRanking(); //display global ranking
            displayQuestionHistory($userBoard); //display questions done by user

        }else{
            $userBoard=$_SESSION["user"];    //student watching his results
            //get user info
            $userInfo=BDD::get()->query("SELECT user_adress, user_last_name, user_first_name, user_score FROM users WHERE user_id= $userBoard")->fetchAll();
        ?>
            <h1>Tableau de bord</h1>
            <h2>Bonjour <?php echo $userInfo[0]['user_first_name'].' '.$userInfo[0]['user_last_name'];?> !</h2> <!-- display user info-->

        <?php
            include("Controller/displayDashboard.php");

            displayGraphs($userBoard); //display diagrams
            displayRanking(); //display global ranking
            displayQuestionHistory($userBoard); //display questions done by user
        }
        ?>

    </div>
    <br>

</div>
