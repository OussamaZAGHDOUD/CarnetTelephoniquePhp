<?php
session_start();      
session_unset();
session_destroy();                       
 
 ?>

<html>
    <head>
       <meta charset="utf-8">
        <!-- importer le fichier de style -->
        <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
    </head>
    <body>
        <div id="container">

            <form action="verification.php" method="POST">
                <h1>Connexion</h1>

                <label><b>Nom d'utilisateur</b></label>
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>

                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="password" required>

                <input type="submit" id='submit' value='LOGIN' >
                <?php
                if(isset($_GET['erreur'])){
                    $err = $_GET['erreur'];
                    if($err==1 || $err==2)
                        ?>
                        <p style='color:red'>Utilisateur ou mot de passe incorrect</p>
                        <?php
                }
                ?>
               <center> <a href="register.php"><span> S'inscrire ! </span></a> </center>
            </form>
        </div>
    </body>
</html>
