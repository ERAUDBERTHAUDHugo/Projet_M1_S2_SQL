<div class="loginbox">
    <link rel="stylesheet" type="text/css" href="View/styleLogin.css">
    <img src="View/img/avatar.png" class="avatar">
        <h1>Enregistre-toi ici !</h1>
        <form action="index.php?page=login" method='POST'>
            <?php
                if (isset($_COOKIE["returnRegister"])){
                    echo($_COOKIE["returnRegister"]);
                }
                
            ?>
            <p>Email</p>
            <input type="text" name="mail" placeholder="Entre ton pseudo">
            <p>Nom</p>
            <input type="text" name="lastName" placeholder="Entre ton pseudo">
            <p>Prenom</p>
            <input type="text" name="firstName" placeholder="Entre ton pseudo">
            <p>Mot de passe</p>
            <input type="password" name="psw" placeholder="Entre ton mot de passe">
            <p>Confirmation mot de passe</p>
            <input type="password" name="pswConfirmed" placeholder="Entre ton mot de passe">
            <input type="submit" name="register" value="S'enregistrer">
            <a href="#">Lost your password ?</a><br>
            <a href="index.php?page=register">Don't have an account ?</a>
        </form>
</div>