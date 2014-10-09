<?php  


class ModeloIndex {
	/**
	 * constructor
	 */
	public function __constructor(){


	}

	/**
	 * Metodo que recoje el post 
	 * @return post
	 */
	public function getPost(){
		$sHTML = '';
		require_once 'BD.class.php';
		$miDB = new DB();
		$sSQL = "SELECT * FROM posts WHERE session='html' ORDER BY fecha DESC LIMIT 3";
		$resultados = $miDB->obtenerResultado($sSQL);
		foreach ($resultados as $post) {
			//extract convierte cada elemento de post en un array
			extract($post);
			$bodyMain = substr($body, 0,500);
		$sHTML .= <<<EOT
			<div id="postArea">	
				<a id="heading" href="controlador.php?vista=mostrarPost&id={$id}">{$post['title']}</a><br>
				<span id="fecha">$fecha</span>
				<span id="nombre">By-> $nombre</span><br>
				<img src="$img" alt="" width="150px" height="150px">
				<p>$bodyMain...</p>
				<a id="readMore" href="controlador.php?vista=mostrarPost&id={$id}">Read More</a>
			</div>
EOT;
		}
		return $sHTML;
	}	
}

class ModeloJava {
	/**
	 * constructor
	 */
	public function __constructor(){


	}

	/**
	 * Metodo que recoje el post 
	 * @return post
	 */
	public function getPost(){
		$sHTML = '';
		require_once 'BD.class.php';
		$miDB = new DB();
		$sSQL = "SELECT * FROM posts WHERE session='java' ORDER BY fecha DESC LIMIT 3";
		$resultados = $miDB->obtenerResultado($sSQL);
		foreach ($resultados as $post) {
			//extract convierte cada elemento de post en un array
			extract($post);
			$bodyMain = substr($body, 0,500);
		$sHTML .= <<<EOT
			<div id="postArea">	
				<a id="heading" href="controlador.php?vista=mostrarPost&id={$id}">{$post['title']}</a><br>
				<span id="fecha">$fecha</span>
				<span id="nombre">By-> $nombre</span><br>
				<img src="$img" alt="" width="150px" height="150px">
				<p>$bodyMain...</p>
				<a id="readMore" href="controlador.php?vista=mostrarPost&id={$id}">Read More</a>
			</div>
EOT;
		}
		return $sHTML;
	}
	
}

class ModeloCss {
	/**
	 * constructor
	 */
	public function __constructor(){


	}

	/**
	 * Metodo que recoje el post 
	 * @return post
	 */
	public function getPost(){
		$sHTML = '';
		require_once 'BD.class.php';
		$miDB = new DB();
		$sSQL = "SELECT * FROM posts WHERE session ='css' ORDER BY fecha DESC LIMIT 3";
		$resultados = $miDB->obtenerResultado($sSQL);
		foreach ($resultados as $post) {
			//extract convierte cada elemento de post en un array
			extract($post);
			$bodyMain = substr($body, 0,500);
		$sHTML .= <<<EOT
			<div id="postArea">	
				<a id="heading" href="controlador.php?vista=mostrarPost&id={$id}">{$post['title']}</a><br>
				<span id="fecha">$fecha</span>
				<span id="nombre">By-> $nombre</span><br>
				<img src="$img" alt="" width="150px" height="150px">
				<p>$bodyMain...</p>
				<a id="readMore" href="controlador.php?vista=mostrarPost&id={$id}">Read More</a>
			</div>
EOT;
		}
		return $sHTML;
	}

	
}

class ModeloPhp {
	/**
	 * constructor
	 */
	public function __constructor(){


	}

	/**
	 * Metodo que recoje el post 
	 * @return post
	 */
	public function getPost(){
		$sHTML = '';
		require_once 'BD.class.php';
		$miDB = new DB();
		$sSQL = "SELECT * FROM posts WHERE session='php' ORDER BY fecha DESC LIMIT 3";
		$resultados = $miDB->obtenerResultado($sSQL);
		foreach ($resultados as $post) {
			//extract convierte cada elemento de post en un array
			extract($post);
			$bodyMain = substr($body, 0,500);
		$sHTML .= <<<EOT
			<div id="postArea">	
				<a id="heading" href="controlador.php?vista=mostrarPost&id={$id}">{$post['title']}</a><br>
				<span id="fecha">$fecha</span>
				<span id="nombre">By-> $nombre</span><br>
				<img src="$img" alt="" width="150px" height="150px">
				<p>$bodyMain...</p>
				<a id="readMore" href="controlador.php?vista=mostrarPost&id={$id}">Read More</a>
			</div>
EOT;
		}
		return $sHTML;
	}
	
}

class ModeloMostrarPost{

public function __constructor(){

}

private function getPost(){
	if (isset($_GET['id'])) {
		return $_GET['id'];
		
	}
}

	public function mostrarPost(){
		$sHTML = '';
		$iId = $this->getPost();
		require_once 'BD.class.php';
		$miDB = new DB();
		$sSQL = "SELECT * FROM posts WHERE id='$iId'";
		$aResul = $miDB->obtenerResultado($sSQL);
		foreach ($aResul as $post) {
			extract($post);
			$sHTML .= <<<EOT
				<div id="postArea">	
					<a id="heading" href="controlador.php?vista=mostrarPost&id={$id}">$title</a><br>
					<span id="fecha">$fecha</span>
					<span id="nombre">By-> $nombre</span><br>
					<img src="$img" alt="" width="150px" height="150px">
					<p>$body</p>
					<button class="back" onClick="history.go(-1)"><- back</button>
				</div>
EOT;
		}
		return $sHTML;
	}

}


?>
