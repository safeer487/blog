
	<div id="postArea">
		<form class="contactos" action="controlador.php?vista=contacto" method="post">	
			<h1>Contact us</h1><br>
			<p class="mensajes">{Mensajes}{Errors}</p>
			<label for="nombre">Name</label><br>
			<input type="text" id="nombre" name="nombre"><br>

			<label for="email">email</label><br>
			<input type="text" id="email" name="email"><br>

			<label for="subject">subject</label><br>
			<input type="text" id="subject" name="subject"><br>

			<label for="mensaje">messege</label><br>
			<textarea name="mensaje" id="mensaje" cols="30" rows="10"></textarea><br>

			<input type="submit" value="Contact">
		</form>
	</div>			
</div>
			
	
		