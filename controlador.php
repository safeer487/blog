<?php  

/**
 * El objetivo de cualquier controlador son 2: capturar eventos y 
 * ejecutar el modelo adecuado. Y nada más.
 */

function capturar_evento() {
	$vista = '';
	if($_GET) {
		if(array_key_exists('vista', $_GET)) {
			$vista = $_GET['vista'];
		}
	}
	return $vista;
}

function identificar_modelo($vista) {
	if($vista) {
		switch ($vista) {
			case 'index':
				$modelo = 'ModeloIndex';
			break;
			case 'css':
				$modelo = 'ModeloCss';
			break;
			case 'php':
				$modelo = 'ModeloPhp';
			break;
			case 'javaScript':
				$modelo = 'ModeloJava';
			break;
			case 'mostrarPost':
				$modelo = 'ModeloMostrarPost';
			break;
			
			default:
			exit();
		}
	}
	return $modelo;
}

function invocar_modelo($modelo) {
	if($modelo) {
		require_once('modelos.php');
		$data = new $modelo();
		return $data;
	}
	#las modificaciones al modelo se harían aquí
}

function enviar_data() {
	$vista = capturar_evento();
	if($vista) {
		$modelo = identificar_modelo($vista);
		if($modelo) {
			$data = invocar_modelo($modelo);
			if($data) {
				require_once('vista.php');
				render_data($vista, $data);
			}
		}
	}
}

enviar_data();

?>