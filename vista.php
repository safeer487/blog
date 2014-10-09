<?php  

function armar_diccionario($vista,$data) {
	$diccionario = array();
	//para html
	if ($vista == 'index') {
		$diccionario['MostrarPost'] = $data->getPost();
	}else{
		$diccionario['MostrarPost']= '';
	}

	//para css
	if ($vista == 'css') {
		$diccionario['MostrarPostCss'] = $data->getPost();
	}else{
		$diccionario['MostrarPostCss'] = '';
	}

	//para java
	if ($vista == 'javaScript') {
		$diccionario['MostrarPostJava'] = $data->getPost();
	}else{
		$diccionario['MostrarPostJava'] = '';
	}

	//para php
	if ($vista == 'php') {
		$diccionario['MostrarPostPhp'] = $data->getPost();
	}else{
		$diccionario['MostrarPostPhp'] = '';
	}


	if ($vista == 'mostrarPost') {
		$diccionario['mostrarPosts'] = $data->mostrarPost();
	}else{
		$diccionario['mostrarPosts'] = '';
	}

	
	return $diccionario;
}

function render_data($vista, $data) {
	$html = file_get_contents('arriba.html');
	if(($vista) && ($data)) {
		$diccionario = armar_diccionario($vista, $data);
			$html .= file_get_contents('plantilla_' . $vista . '.php');
			foreach ($diccionario as $clave => $valor) {
				$html = str_replace('{' . $clave . '}', $valor, $html);
			}
	}
	$html .= file_get_contents('abajo.html');
	print $html;
}

?>