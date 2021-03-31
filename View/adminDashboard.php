    <?php
    class BDD{
        private static $connexion;
            public static function get(){
               if(!self::$connexion instanceof PDO){
                  self::$connexion = new PDO('mysql:host=localhost;dbname=db_project;charset=utf8', 'root', '');
               }
               return self::$connexion;
            }
    }

    function displayStudents($teamId,$groupId){ //id of group selected 
        //get team-group name
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

    displayStudents(1,1);

    ?>