<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Control Panel</title>
	<link rel="stylesheet" href="css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
</head>
<body>
	<div id="formLogin">
		{mensajeError} <br>
		<span class="heading">Admin</span>
	<form method="post" action="controlador.php?vista=controlPanel">
		<input class="binput" type="text" name="alias" placeholder="Alias"><br>
		<input class="binput" type="password" name="password" placeholder="Password"><br>
		<input class="blogin" type="submit" value="Entrar"><br>
		<a class="back" href="../controlador.php?vista=index">&lt;- Go Back</a>
	</form>
	</div>
</body>
</html>