<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Contact</title>
	<link rel="stylesheet" href="css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
	<style>
	body{
		
	}

	</style>
</head>
<body>
		
	<div id="containerCP">
		
		
	<form method="post" action="controlador.php?vista=contacto">
		<span class="heading">Contact US</span><br>
		<p class="mostrar">{Errors}{Mensajes}</p>
		<input class="binput" type="text" name="nombre" placeholder="Name">
		<input class="binput" type="text" name="email" placeholder="Email">
		<input class="binput" type="text" name="subject" placeholder="Subject">
		<textarea class="messege" name="mensaje" id="mensaje" cols="67" rows="15" placeholder="Messege"></textarea><br>
		<input class="blogin" type="submit" value="Send"><br>
		<a class="back" href="../controlador.php?vista=index">&lt;- Go Back</a>
	</form>
	</div>

</body>
</html>