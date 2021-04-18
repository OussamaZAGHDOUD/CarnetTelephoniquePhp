<?php
session_start();

$nom_utilisateur = "";
$errors   = array();

$db = mysqli_connect('localhost', 'root', '', 'sss');

if (isset($_POST['reg_user'])) {
	// Contre le xss et le SQL injection 
	$nom_utilisateur   = mysqli_real_escape_string($db, $_POST['nom_utilisateur']);
	$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
	$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

	// checking filled
	if (empty($nom_utilisateur)) {
		array_push($errors, "-Le nom d'utilisateur est obligatoire");
	}

	if ($password_1 != $password_2) {
		array_push ($errors, "-Mots de passe non identique ! ");
	}

	if (empty($password_1)) {
		array_push($errors, "- Le mot de passe est obligatoire");
	}

	$user_check_query = "SELECT * FROM utilisateur WHERE nom_utilisateur='$nom_utilisateur' LIMIT 1";
	$result = mysqli_query($db, $user_check_query);
	$user = mysqli_fetch_assoc($result);

	// Checking user in database
	if ($user) {
		if ($user['nom_utilisateur'] === $nom_utilisateur) {
			array_push($errors, "- Nom d'utilisateur est reservé ! ");
		}

	}

	echo "Nombre des erreur: " . count($errors);

	// Insertion de lutilisateur dans la base 
	if (count($errors) == 0) {
		// Cryptage 
		$password = md5($password_1);
		$query = "INSERT INTO utilisateur (nom_utilisateur, mot_de_passe) VALUES ('$nom_utilisateur', '$password')";
		mysqli_query($db, $query);
		header('location: index.php');
	}
}
// Click Login
if (isset($_POST['login_user'])) {
	$nom_utilisateur = mysqli_real_escape_string($db, $_POST['nom_utilisateur']);
	$password = mysqli_real_escape_string($db, $_POST['password']);
	if (empty($nom_utilisateur)) {
		array_push($errors, "nom_utilisateur is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}
	if (count($errors) == 0) {
		$password = md5($password);
		$query = "SELECT * FROM users WHERE nom_utilisateur='$nom_utilisateur' AND password='$password'";
		$results = mysqli_query($db, $query);
		if (mysqli_num_rows($results) == 1) {
			header('location: index.php');
		} else {
			array_push($errors, "Wrong nom_utilisateur/password combination");
		}
	}
}

?>
