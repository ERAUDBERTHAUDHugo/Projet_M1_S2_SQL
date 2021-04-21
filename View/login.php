<div class="loginbox">
    <link rel="stylesheet" type="text/css" href="View/style.css">
    <img src="View/img/avatar.png" class="avatar">
        <h1>Connecte-toi ici !</h1>
        <form action="index.php?page=login" method='POST'>
            <p>
            <?php
            if (isset($_COOKIE["returnConnection"])){
                if($_COOKIE["returnConnection"]=="Adresse ou mot de passe incorrect"){
                    echo($_COOKIE["returnConnection"]);
                }
            }
            ?>
            </p>
            <p>Email</p>
            <input type="text" name="email" placeholder="Entre ton pseudo">
            <p>Mot de passe</p>
            <input type="password" name="psw" placeholder="Entre ton mot de passe">
            <input type="submit" name="login" value="Se connecter">
        </form>
</div>

