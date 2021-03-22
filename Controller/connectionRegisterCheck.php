<?php

    //--------------------------------REGISTER FUNCTIONS---------------------------------------------

    function insertNewUser($mail,$lastName,$firstName,$password,$role){

        $PDOuser = BDD::get()->prepare('INSERT INTO users VALUES (NULL,:mail, :lastName, :firstName, :password,:role)');  

        $PDOuser->bindParam(':mail',$mail);
        $PDOuser->bindParam(':lastName',$lastName);
        $PDOuser->bindParam(':firstName',$firstName);
        $PDOuser->bindParam(':password',$password);
        $PDOuser->bindParam(':role',$role);
      
        $PDOuser->execute();

    }

    function checkSimilarpassword($password,$confirmedPassword){

        if ($password==$confirmedPassword){
            return True;
        }
    }

    function mailUnique($mail){

        $users_adress=BDD::get()->query('SELECT user_adress FROM users;')->fetchAll();

        foreach ($users_adress as $adress){

            if ($adress["user_adress"]==$mail){

                return FALSE;
            }
        }
        return TRUE;
    }

    function register(){

        $mail=$_POST["mail"];
        $lastname=$_POST["lastName"];
        $firstname=$_POST["firstName"];
        $psw=$_POST["psw"];
        $pswConfirmed=$_POST["pswConfirmed"];

        if (checkSimilarpassword($psw,$pswConfirmed)){

            if (mailUnique($mail)){

                echo("yes");
                insertNewUser($mail,$lastname,$firstname,$psw,0);
                return("Inscription effectuée ! Connectez-vous. ");

            }else{

                return ("L'adresse mail est déjà utilisée");
            }
        }else {
            return("Les deux mots de passe ne corespondent pas");
        }
    }

    //----------------------------------CONNECTION FUNCTIONS--------------------------------------------------

    function checkConnection($mail,$hash_psw){

        disconnect();
        $users_names=BDD::get()->query('SELECT user_adress, user_id ,user_password FROM users;')->fetchAll();

        foreach ($users_names as $users){           
           
            if ($users["user_adress"]==$mail){

                if ($users["user_password"]==$hash_psw){

                    $_SESSION["connected"]=1;
                    $_SESSION["user"]=$users["user_id"];

                    return ("Vous êtes bien connecté");

                }else{

                    return ("Adresse ou mot de passe incorrect");
                }
            }
        }
        return("Adresse ou mot de passe incorrect");
    }

    function isConnected(){   
                      
        if (isset($_SESSION['connected'])) {

          return 1;
        }

        else {

          return 0;
        }
    }
           
    function disconnect(){   

        $_SESSION = array();
    }

    function cookieConnDestr(){

        $_SESSION["returnRegister"]="";
        $_SESSION["returnConnection"]="";
    }
    //---------------------------------------------Register Check-----------------------------------------------------

    if (isset($_POST["register"])){

        $returnRegister=register();
        setcookie("returnRegister",$returnRegister,time()+3);
        echo($returnRegsiter);

        if($returnRegister=="Inscription effectuée ! Connectez-vous. "){

            header('Location: index.php?page=login');

        }else{

            header('Location: index.php?page=register');

        }
    }

    
    
    //---------------------------------------------Connection Check---------------------------------------------------

    if (isConnected()==0){

        if (isset($_POST["login"])){

            $mail=$_POST["email"];
            $psw=$_POST["psw"];
            $returnCon=checkConnection($mail,$psw);
            echo($returnCon);
            setcookie("returnConnection",$returnCon,time()+3);

            if ($returnCon=="Vous êtes bien connecté")
            {
                header('Location: index.php?page=main');

            }else{

                header('Location: index.php?page=login');

            }
        }
    }
    

 