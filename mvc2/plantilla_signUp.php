<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Sign Up</title>
	<link rel="stylesheet" href="css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
	<style>
	div#formLogin{
		margin-top: 50px;
	}
	</style>
</head>
<body>
	<div id="formLogin">
	<p class="mostrar">{mensajeError}
	{mensajeRegistrado}</p>
	<form method="post" action="controlador.php?vista=signUp">
			<span class="heading">Sign Up</span>
			<input class="binput" type="text" name="name" placeholder="Name"><br>
			<input class="binput" type="text" name="email" placeholder="Email"><br>
			<input class="binput" type="password" name="password" placeholder="Password"><br>
			<input class="binput" type="password" name="rpassword" placeholder="Repeat password"><br>
			<input class="blogin" type="submit" value="Sign up">
			<a class="back" href="../controlador.php?vista=index">&lt;- Go Back</a>
		</form>
	</div>
</body>
</html>