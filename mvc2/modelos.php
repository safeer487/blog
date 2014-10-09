<?php  
/**
* Seguridad
*/
class Seguridad 
{
	/**
	 * constructor
	 */
	function __construct(){
			session_start();
		if (!isset($_SESSION['usuario'])) {
			header('Location: ../controlador.php?vista=index');
			exit;
		}
	}
}


/**
 * Modelo control
 */
class ModeloControl {
	//variables
	private $sAlias = '';
	private $sPassword = '';
	public function __construct(){
		if ($_POST){
			 $this->sAlias = trim($_POST['alias']);
			 $this->sPassword = trim($_POST['password']);
		}
		$this->validarControl();
	}
	/**
	 * Metodo que valida los datos
	 * si son correcto crea la session
	 */
	private function validarControl(){
		require_once 'BD.class.php';
		$miDB = new DB();
		$sSQL = "SELECT * FROM controlPanel WHERE usuario = '$this->sAlias' AND password = '$this->sPassword' ";
		$iNumResul = $miDB->contarResultadosQuery($sSQL);
		if ($iNumResul >= 1) {
			$this->rederegirAIndex($sSQL,$miDB);
		}
	}

	/**
	 * metodo que crea la session y manda a la pagina de index
	 */
	private function rederegirAIndex($inSQL,$inDB){
		$sResul = $inDB->obtenerResultado($inSQL);
		$iId = $sResul[0][0];
		session_start();
		$_SESSION['usuario'] = $iId;
		header('Location:controlador.php?vista=controlPanelIndex');
		exit;
	}
	
}
/**
* modelo controlPanelIndex
*/
class ModeloControlIndex{
	/**
	 * constructor
	 */
	public function __construct(){
		new Seguridad();
		$this->signOut();
	}
	/**
	 * Metodo que cierra la session
	 */
	private function signOut(){
		if (isset($_GET['cerrar'])) {
			session_start();
			session_destroy();
			header('Location: controlador.php?vista=controlPanel');
			exit;
		}
	}
}

/**
 * Modelo control crear post
 */
class ModeloControlCrearPost{
	private $sSession = '';
	private $sNom = '';
	private $iFecha = '';
	private $sImg = '';
	private $sTitulo = '';
	private $sBody = '';
	private $bMostrarError = '';

	/**
	 * constructor
	 */
	public function __construct(){
		new Seguridad();
		if($_POST){
			$this->sSession = trim($_POST['session']);
			$this->sNom= trim($_POST['nombre']);
			$this->iFecha = trim($_POST['fecha']);
			$this->sImg = trim($_POST['image']);
			$this->sTitulo = trim($_POST['titulo']);
			$this->sBody =trim($_POST['body']);
			$this->bMostrarError = false;
			$this->validations();
		 }
	}
	public function isError(){
		return $this->bMostrarError;
	}
		

	/**
	 * Metodo que muestra error
	 * @return  error
	 */
	public function mostrarError(){
		return "Need to fill all the fields";
	}
	/**
	 * Metodo que valida los datos
	 */
	private function validations(){
		if (empty($this->sSession) || empty($this->sNom) || empty($this->iFecha) || empty($this->sImg) ||empty($this->sTitulo) || empty($this->sBody)) {
			$this->bMostrarError = true;
			
		}else{
			$this->guardarABase();
		}
	}

	/**
	 * Metodo que guarda a base de datos
	 */
	private function guardarABase(){
		require_once 'BD.class.php';
		$miDB = new DB();
		$sSQL = "INSERT INTO posts VALUES('NULL','$this->sSession','$this->sNom','$this->iFecha','$this->sImg','$this->sTitulo','$this->sBody')	";
		$miDB->ejecutarQuery($sSQL);
		header('Location:controlador.php?vista=controlCrearPost&nuevo=1');
		exit;
	}

	/**
	 * Metodo que muestra el mensaje
	 * return mensaje 
	 */
	public function getMensajeGuardado(){
		if(isset($_GET['nuevo'])) {
			return 'Your post has been saved';
		}
	}
}


/**
 * Modelo usuarios
 */
class ModeloUsuarios{
	/**
	 * constructor
	 */
	public function __construct(){

	}
}

/**
 * ModeloPostRecibidos
 */
class ModeloPostRecibidos{
		/**
		 * constructor
		 */
		public function __construct(){
			new Seguridad();
			
			
		}

		public function getPostsName(){
			require_once "BD.class.php";
			$miDB = new DB();
			$sSQL = "SELECT nombre,id FROM users_posts order by fecha desc LIMIT 7";
			$sResul = $miDB->obtenerResultado($sSQL);
			$sHTML = '';
			foreach ($sResul as $name) {
			extract($name);
			$sHTML .= <<<EOT
			<a class="back" href="controlador.php?vista=showPost&id={$id}" ><span class="from">From -> </span>$nombre</a>
EOT;

			}
			return $sHTML;
				

		}
}


/**
 * ModeloMensajes
 */
class ModeloMensajes{
	/**
	 * constructor
	 */
	public function __construct(){

	}
	public function getMensaje(){
		require_once 'BD.class.php';
		$miDB = new DB();
		$sSQL = "SELECT * FROM contactos order by id desc";
		$aResul = $miDB->obtenerResultado($sSQL);
		$sHTML = '';
		foreach ($aResul as $sNom) {
		extract($sNom);
		$sHTML .= <<<EOT
		<a class="back" href="controlador.php?vista=mostrarMensaje&id={$id}" ><span class="from">From -> </span>$nombre</a>	

EOT;
		}
		return $sHTML;
	}



}
class ModeloMostrarMensaje{
	public function __construct(){
		$this->getId();
	}
	/**
	 * Metodo que recoge el id del mensajes
	 */
	private function getId(){
		if (isset($_GET['id'])) {
			$iId = $_GET['id'];
			return $iId;
		}
	}
	public function mostrarMensajes(){
		 $iId = $this->getId();
		require_once 'BD.class.php';
		$miDB = new DB();
		$sSQL = "SELECT * FROM contactos WHERE id='$iId'";
		$aResul = $miDB->obtenerResultado($sSQL);
		$sHTML = '';
		foreach ($aResul as $aMensaje) {
			extract($aMensaje);
		$sHTML.= <<<EOT
		<span class="from">Name:-</span>$nombre <br>
		<span class="from">Email:-</span>$email <br>
		<span class="from">Subject:-</span>$subject <br>
		<span class="from">Messege</span><br>
		<textarea rows="15" cols="26" resize="none">$mensaje</textarea> <br>


EOT;
			
		}	
		return $sHTML;
	}



}


/**
 * Modelo signUp
 */
class ModeloSignUp {
	//variables
	private $sNom = '';
	private $sEmail = '';
	private $sPass = '';
	private $rPass = '';
	private $bMostrarError = '';
	private $aMens = '';
	private $aMensajeError = ''; 
	/**
	 * Constructor
	 */
	public function __construct(){
		if ($_POST) {
			$this->sNom = trim($_POST['name']);
			$this->sEmail = trim($_POST['email']);
			$this->sPass = trim($_POST['password']);
			$this->rPass = trim($_POST['rpassword']);
			$this->bMostrarError = false;
			$this->aMens['emptyFields'] = 'Need to fill all the fields';
			$this->aMens['emailIncorrect'] = 'You have entered incorrect email address';
			$this->aMens['passwordError'] = 'your password doesnt matched';
			$this->aMens['nomLength'] = 'Your name should contain less then 50 caracters';
			$this->aMens['emailLength'] = 'Your email should contain less than 50 caracters';
			$this->aMens['userExists'] = 'You have already registered with this email address';
			$this->aMensajeError = array();
			$this->validarDatos();	
		}
	}
	/**
	 * Metodo que comprueba si existe el error
	 * @return boolean 
	 */
	public function isError(){
		return $this->bMostrarError;
	}

	/**
	 * metodo que comprueba los campos de sign up
	 * @return boolean 
	 */
	private function validarDatos(){
		if (empty($this->sNom) || empty($this->sEmail) || empty($this->sPass) || empty($this->rPass)) {
			$this->aMensajeError[] = $this->aMens['emptyFields'];
			$this->bMostrarError = true; 
		}
		if (!filter_var(($this->sEmail), FILTER_VALIDATE_EMAIL)) {
			$this->aMensajeError[] = $this->aMens['emailIncorrect'];
			$this->bMostrarError = true;
		}
		if ($this->sPass != $this->rPass) {
			$this->aMensajeError[] = $this->aMens['passwordError'];
			$this->bMostrarError = true;
		}
		if (strlen($this->sNom) > 50) {
			$this->aMensajeError[] = $this->aMens['nomLength'];
			$this->bMostrarError = true;
		}
		if (strlen($this->sEmail) > 50) {
			$this->aMensajeError[] = $this->aMens['emailLength'];
			$this->bMostrarError = true;
		}
		$this->comprobarUser();

		if (!$this->bMostrarError) {
			$this->guardarABase();
		}
	}

	/**
	 * Metodo que comprueba el email si el usuario ha registrado antes.
	 */
	private function comprobarUser(){
		require_once 'BD.class.php';
		$miDB = new DB();
		$sSQL = "SELECT email FROM usuario WHERE email='$this->sEmail' ";
		$iNumResul = $miDB->contarResultadosQuery($sSQL);
		if ($iNumResul == 1) {
			$this->aMensajeError[] = $this->aMens['userExists'];
			$this->bMostrarError = true;
		}
	}

	/**
	 * Metodo que muestra los errors
	 * @return string devuelve los errors
	 */
	public function getErrors(){
		$sHTML = '';
		foreach ($this->aMensajeError as $value) {
			$sHTML.= '*'.$value.'</br>';
		}
		return $sHTML;
	}

	/**
	 * Metodo que guarda a base de datos informacion del usuario
	 */
	private function guardarABase(){
		require_once 'BD.class.php';
		$miDB = new DB();
		$sSQL = "INSERT INTO usuario VALUES(NULL,'$this->sNom','$this->sEmail','$this->sPass')";
		$miDB->ejecutarQuery($sSQL);
		header('Location:controlador.php?vista=signUp&nuevo=1');
		exit;
	}

	/**
	 * Metodo que muestra el mensaje del nuevo usuario
	 */
	public function nuevoUsuario(){
		if (isset($_GET['nuevo'])) {
			return 'Welcome into world of learning an email has been send to your email address please confirm your registration.Thank you for registring,hope you will enjoy';
		}
	}
}


/*
* Modelo LogIn
*/
class ModeloLogIn{

	//variables
	private $email = '';
	private $sPassword = '';
	private $bMostrarError = false;
	
	/**
	 * constructor
	 */
	public function __construct(){
		if ($_POST) {
			$this->email = trim($_POST['email']);
			$this->sPassword = trim($_POST['password']);
			$this->validarControl();
		}	
	}
	/**
	 * Metodo que devuele error
	 * @return bMostrarError
	 */
	public function isError(){
		return $this->bMostrarError;
	}

	/**
	 * Metodo que comprueba si existe usuario
	 */
	private function validarControl(){
		require_once 'BD.class.php';
		$miDB = new DB();
		$sSQL = "SELECT * FROM usuario WHERE email = '$this->email' AND password = '$this->sPassword' ";
		$iNumResul = $miDB->contarResultadosQuery($sSQL);
		if ($iNumResul == 1) {
			$this->rederegirAIndex($sSQL,$miDB);
		}else{
			$this->bMostrarError = true;
			//preguntar a andros
		}
	}

	/**
	 * Metodo que muestra error
	 * @return string
	 */
	public function mostrarError(){
		return "Email or password incorrect";
	}

	/**
	 * metodo que crea la session y manda a la pagina de index
	 */
	private function rederegirAIndex($inSQL,$inDB){
		
		$sResul = $inDB->obtenerResultado($inSQL);
		$iId = $sResul[0][0];	
		session_start();
		$_SESSION['usuario'] = $iId;
		header('Location:controlador.php?vista=logInIndex');
		exit;
	}

}

/**
 * ModeloLogInIndex
 */
class ModeloLogInIndex{
	/**
	 * constructor
	 */
	public function __construct(){
		new Seguridad();
		
		$this->signOut();


	}

	private function getId(){
		session_start();
		$iId = $_SESSION['usuario'];
		return $iId;
	}
	public function mostrarNombre(){
		$iId = $this->getID();
		require_once "BD.class.php";
		$miDB = new DB();
		$sSQL = "SELECT nombre FROM usuario WHERE id='$iId';  ";
		$aResul = $miDB->obtenerResultado($sSQL);
		foreach ($aResul as $name) {
			extract($name);
			return $nombre;

		}
		
	}

	/**
	 * Metodo que cierra la session
	 */
	private function signOut(){
		if (isset($_GET['cerrar'])) {
			session_start();
			session_destroy();
			header('Location: controlador.php?vista=logIn');
			exit;
		}
	}
}

/**
 * ModeloContacto
 */
class ModeloContacto{
	//variables
	private $sNom = '';
	private $sEmail = '';
	private $sSubject = '';
	private $sMessege = '';
	private $bMostrarError = false;
	private $aMens = array();
	private $aMensajeError = array();

	/**
	* Constructor
	*/
	public function __construct(){
		if ($_POST) {
			$this->sNom = $_POST['nombre'];
			$this->sEmail = $_POST['email'];
			$this->sSubject = $_POST['subject'];
			$this->sMessege = $_POST['mensaje'];
			$this->aMens['fillError'] = 'Need to fill all the fields';
			$this->aMens['emailincorrect'] = 'You have entered incorrect email address'; 
			$this->validarDatos();
		}
	}

	/**
	 * Metodo que devuele true si hay error
	 * @return true 
	 */
	public function isError(){
		return $this->bMostrarError;
	}


	/**
	 * Methodo que valida los datos si hay error
	 */
	private function validarDatos(){
		//los campos no pueden estar vacios
		if (strlen($this->sNom) == 0 || strlen($this->sEmail) ==0 || strlen($this->sSubject) == 0 ||strlen($this->sMessege) == 0) {
			$this->aMensajeError[] = $this->aMens['fillError'];
			$this->bMostrarError = true;
		}
		//email verification
		if (!strstr($this->sEmail, '@') || !strstr($this->sEmail, '.')) {
			$this->aMensajeError[] = $this->aMens['emailincorrect'];
			$this->bMostrarError = true;
		}
		if (!$this->bMostrarError) {
			$this->guardarABase();
		}
	}
	/**
	 * Metodo que genera los errors
	 * @return Errors
	 */
	public function getMensajeErrors(){
		$sHTML = '';
		foreach($this->aMensajeError as $value) {
		$sHTML .= $value.'<br/>';
		}	
		return $sHTML;
	}
 
	/**
	 * Methodo que guarda a base de datos
	 */
	private function guardarABase(){
		require_once 'BD.class.php';
		 $miDB = new DB();
		//insertar into base
		$sSQL = "INSERT INTO contactos VALUES(NULL,'$this->sNom','$this->sEmail','$this->sSubject','$this->sMessege') ";
		 $miDB->ejecutarQuery($sSQL);
		header('Location: controlador.php?vista=contacto&nuevo=1');
		exit;
	}

	/**
	*Methodo que muestra el mensaje al usuario que esta enviado
	*@param return string
	*/
	public function MensajeEnviado(){
		if (isset($_GET['nuevo'])) {
			return "* Thank you for contacting us,We will shorty incontact with you.";
		}
	}	
}

class ModeloUserCrearPost{
	private $sNom = '';
	private $iFecha = '';
	private $sImg = '';
	private $sTitulo = '';
	private $sBody = '';
	private $bMostrarError = '';

	/**
	 * constructor
	 */
	public function __construct(){
		new Seguridad();
		if ($_POST) {
			$this->sNom= trim($_POST['nombre']);
			$this->sImg = trim($_POST['image']);
			$this->sTitulo = trim($_POST['titulo']);
			$this->sBody = htmlspecialchars($_POST['body']);
			$this->validations();
		 }
	}
	public function isError(){
		return $this->bMostrarError;
		
	}
		

	/**
	 * Metodo que muestra error
	 * @return  error
	 */
	public function mostrarError(){
		return "Need to fill all the fields";
	}
	/**
	 * Metodo que valida los datos
	 */
	private function validations(){
		if ( empty($this->sNom) || empty($this->sImg) ||empty($this->sTitulo) || empty($this->sBody)) {
			$this->bMostrarError = true;
			$this->mostrarError();
		}else{
			$this->guardarABase();
		}
	}

	/**
	 * Metodo que guarda a base de datos
	 */
	private function guardarABase(){
		require_once 'BD.class.php';
		$miDB = new DB();
		$sSQL = "INSERT INTO users_posts  VALUES('NULL','$this->sNom',CURDATE(),'$this->sImg','$this->sTitulo','$this->sBody')	";
		$miDB->ejecutarQuery($sSQL);
		header('Location:controlador.php?vista=userCrearPost&nuevo=1');
		exit;
	}
	/**
	 * Metodo que muestra el mensaje
	 * return mensaje 
	 */
	public function getMensajeGuardado(){
		if (isset($_GET['nuevo'])) {
			return 'Your post has been send after reviewing it will be posted';
		}
	}
}


Class ModeloViewPost{


	public function __construct(){

	}

	



}

Class ModeloShowPost{

	/**
	 * Constructor
	 */
	public function __construct(){
  		new Seguridad();
  		$this->getPost();

	}

	private function getId(){
		if (isset($_GET['id'])) {
			return $iId = $_GET['id'];
		}
	}

	private function getPost(){
		$iId = $this->getId();

		require_once 'BD.class.php';
		$miDB = new DB();
		$sSQL = "SELECT * FROM users_posts WHERE id = $iId";
		$aResul = $miDB->obtenerResultado($sSQL);
		foreach ($aResul as $post) {
			extract($post);
			$sHTML = <<<EOT
			<div id="containerCP">
			<form action="controlador.php?vista=controlCrearPost" method="post">
				<span class="heading">$nombre</span><br>
				<input type="text" name="session" class="binput" placeholder="Session">
				<input type="text" name="nombre" class="binput" placeholder="Nombre" value="{$nombre}">
				<input type="date" name="fecha" class="binput" placeholder="Date" value="{$fecha}">
				<input type="text" name="image" class="binput" placeholder="Image Src" value="{$img}">
				<input type="text" name="titulo" class="binput"placeholder="Title" value="{$title}">
				<textarea class="messege" name="body" id="body" cols="67" rows="15" placeholder="Post body">$body</textarea>
				<input type="submit" class="blogin" value="Publish post">
				<a class="back" href="controlador.php?vista=controlCrearPost">New Post</a>
				
				<a class="back" href="controlador.php?vista=controlPanelIndex">&lt;- Go Back</a>

			</form>

			</div>
EOT;
		}
		echo $sHTML;

	}




}

?>