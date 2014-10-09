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
		<p class="mostrar">{mensajeGuardado}{error}</p>
		<form action="controlador.php?vista=userCrearPost" method="post">
			<span class="heading">Create Post</span><br>
			<input type="text" name="nombre" class="binput" placeholder="Nombre" >
			<input type="text" name="fecha" class="binput" placeholder="Date" value="{fechaActual}" disabled="disabled">
			<input type="text" name="image" class="binput" placeholder="Image Src">
			<input type="text" name="titulo" class="binput"placeholder="Title">
			<textarea class="messege" name="body" id="body" cols="67" rows="15" placeholder="Post body"></textarea>
			<input type="submit" class="blogin" value="Publish post">
			<a class="back" href="controlador.php?vista=userCrearPost">New Post</a>
			
			<a class="back" href="controlador.php?vista=logInIndex">&lt;- Go Back</a>

		</form>



	</div>
</body>
</html>
