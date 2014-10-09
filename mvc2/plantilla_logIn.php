<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Log In</title>
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
		<p class="mostrar">
			{MensajeError}
		</p>
		<span class="heading">Log In</span>
	<form method="post" action="controlador.php?vista=logIn">
		<input class="binput" type="text" name="email" placeholder="Email"><br>
		<input class="binput" type="password" name="password" placeholder="Password"><br>
		<input class="blogin" type="submit" value="Entrar"><br>
		<a class="back" href="../controlador.php?vista=index">&lt;- Go Back</a>
	</form>
	</div>
</body>
</html>
