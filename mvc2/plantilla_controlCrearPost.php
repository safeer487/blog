<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>

</head>
<body>
	<div id="containerCP">
		<p class="mostrar">
		{mensaje}
		{errors}
		</p>
		<form action="controlador.php?vista=controlCrearPost" method="post">
			<span class="heading">Create Post</span><br>
			<input type="text" name="session" class="binput" placeholder="Session">
			<input type="text" name="nombre" class="binput" placeholder="Nombre">
			<input type="date" name="fecha" class="binput" placeholder="Date">
			<input type="text" name="image" class="binput" placeholder="Image Src">
			<input type="text" name="titulo" class="binput"placeholder="Title">
			<textarea class="messege" name="body" id="body" cols="67" rows="15" placeholder="Post body"></textarea>
			<input type="submit" class="blogin" value="Publish post">
			<a class="back" href="controlador.php?vista=controlCrearPost">New Post</a>
			
			<a class="back" href="controlador.php?vista=controlPanelIndex">&lt;- Go Back</a>

		</form>



	</div>
</body>
</html>

