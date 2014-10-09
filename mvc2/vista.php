<?php  

/**
 * La vista debe hacer lo mínimo para encargarse de mostrar HTML al cliente.
 * Y nada más.
 */

function armar_diccionario($vista, $data) {//Crear diccionario
	$diccionario = array();
	if ($vista == "controlPanel") {
		$diccionario['mensajeError'] = '';
	}

	//contactos
	if ($vista == 'contacto') {
		$diccionario['Mensajes'] = $data->MensajeEnviado();
	}else{
		$diccionario['Mensajes'] = '';
	}

	//muestra los errores
	if ($vista == 'contacto' &&  $data->isError()) {
		$diccionario['Errors'] = $data->getMensajeErrors();
	}else{
		$diccionario['Errors'] = '';
	}


	if ($vista == 'signUp' && $data->isError()) {
		$diccionario['mensajeError'] = $data->getErrors();
	}else{
		$diccionario['mensajeError'] = '';
	}
	if ($vista == 'signUp') {
		$diccionario['mensajeRegistrado'] = $data->nuevoUsuario();
	}else{
		$diccionario['mensajeRegistrado'] = '';
	}

	if ($vista == 'logIn' && $data->isError()) {
		$diccionario['MensajeError'] = $data->mostrarError();
	}else{
		$diccionario['MensajeError'] = '';
	}

	//control panel crear post
	if ($vista == 'controlCrearPost') {
		$diccionario['mensaje'] = $data->getMensajeGuardado();
	}else{
		//$diccionario['mensajeGuardado'] = '';
 	}
 	if ($vista == 'controlCrearPost' && $data->isError()) {
 		$diccionario['errors'] = $data->mostrarError();
 	}else{
 		$diccionario['errors'] = '';
 	}

 	if ($vista == 'userCrearPost') {
		$diccionario['mensajeGuardado'] = $data->getMensajeGuardado();
	}else{
		$diccionario['mensajeGuardado'] = '';
 	}
 	if ($vista == 'userCrearPost' && $data->isError()) {
 		$diccionario['error'] = $data->mostrarError();
 	}else{
 		$diccionario['error'] = '';
 	}
 	//mensajes
 	if ($vista == 'mensajes') {
 		$diccionario['getMessege'] = $data->getMensaje();
 	}
 	//mostrar mensajes
 	if ($vista == 'mostrarMensaje') {
 		$diccionario['mostrarMensajes'] = $data->mostrarMensajes();
 	}
 	//logInIndex 
 	if ($vista == 'logInIndex') {
 		$diccionario['mostrarNombre'] = $data->mostrarNombre();
 	}

 	if ($vista == 'userCrearPost') {
 		$diccionario['fechaActual'] = date("j, n, Y");
 	}

    if ($vista == 'postRecibidos') {
 	  	$diccionario['names'] = $data->getPostsName();
 	}
	
	return $diccionario;
}

function render_data($vista, $data) {//$data realmente es una vista
	$html = '';
	if(($vista) && ($data)) {
		$diccionario = armar_diccionario($vista, $data);//vista es un get
		
			$html = file_get_contents('plantilla_' . $vista . '.php');
			foreach ($diccionario as $clave => $valor) {
				$html = str_replace('{' . $clave . '}', $valor, $html);
			}
		
	}
	print $html;//print $html es lo que hace imprime todo 
}




?>