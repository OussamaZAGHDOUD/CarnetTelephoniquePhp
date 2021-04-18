<?php include('server.php') ?>

<html>
    <head>
       <meta charset="utf-8">
        <!-- importer le fichier de style -->
        <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
    </head>
    <body>
        <div id="container">

	<form method="post" action="register.php">
		<?php include('errors.php') ?>
		<div class="input-group">
			<label>Nom_utilisateur</label>
			<input type="text" name="nom_utilisateur">
		</div>

		<div class="input-group">
			<label>Mot de passe</label>
			<input type="password" name="password_1">
		</div>
		<div class="input-group">
			<label>Confirmation du mot de passe </label>
			<input type="password" name="password_2">
		</div>



		                <input type="submit" id='submit' name="reg_user" value="S'inscrire" >

		<p>
			Vous avez un compte ? <a href="index.php">Se connecter</a>
		</p>
	</form>
	</div>
</body>
</html>
