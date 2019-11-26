<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require $_SERVER['DOCUMENT_ROOT'] . '/mail/Exception.php';
require $_SERVER['DOCUMENT_ROOT'] . '/mail/PHPMailer.php';
require $_SERVER['DOCUMENT_ROOT'] . '/mail/SMTP.php';
/**
 * 
 */
class Clogin extends CI_Controller
{
	private $myglobalvar=0;
	
	function __construct(){
			parent::__construct();
			$this->load->model('mlogin');
	}
		


	public function index(){

		$this->load->view('vlogin');
	
	}



	public function ingresar(){
		$usu = $this->input->post('txtCorreo');
		$pass = sha1($this->input->post("txtClave"));
		$res = $this->mlogin->ingresar($usu, $pass);

		if($res == 1){
			$this->load->view('welcome_message');
		}else{
			echo"<script>alert('VERIFIQUE USUARIO Y CONTRASEÑA, VUELVA A INTENTARLO')</script>";
			$this->load->view('inicio.php');
		}
	}



	public function problems(){
		$this->load->view('recuperacion');

	}


	public function solucion(){
	$email = $this->input->post('txtCorreoRecuperacion');
	$preg = $this->input->post('txtPreguntaRespuestaRec');
	
	$this->db->select('correo');
	$this->db->from('persona'); 
	$this->db->where('correo', $email);
	$resultado = $this->db->get();

	if($resultado->num_rows() == 1){
		$this->db->select('preguntaRespuesta', 'correo');
		$this->db->from('persona'); 
		$this->db->where('preguntaRespuesta', $preg);
		$this->db->where('correo', $email);

$resultado2 = $this->db->get();


			if($resultado2->num_rows() == 1){

		$this->db->select('correo');
		$this->db->from('persona'); 
		$this->db->where('preguntaRespuesta', $preg);
		$this->db->where('correo', $email);

	//	$correAEnviar = $this->db->get();
	//	$result1 = $this->db->get();
		$query = $this->db->get();
 $result1 = $query->row();
 
      


		$this->db->select('contraseña');
		$this->db->from('persona'); 
		$this->db->where('preguntaRespuesta', $preg);
		$this->db->where('correo', $email);

		//$contraseñaAEnviar = $this->db->get();
			$query2 = $this->db->get();
	 $result2 = $query2->row();
      
/*
$email_config = Array(
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => '465',
            'smtp_user' => 'borsafranco@gmail.com',
            'smtp_pass' => '2771999allforwindows10',
            'mailtype'  => 'html',
            'starttls'  => true,
            'newline'   => "\r\n"
        );*/


//CREACIÓN DE CLAVES ALEATORIOS:
		$this->myglobalvar = $this->myglobalvar + rand(1,1000);
	
	/*	if($this->myglobalvar > 10001000){
			 $myglobalvar=10000000;

		}*/
		
		$this->mlogin->agregarClaveTemporal($this->myglobalvar);
		
		
		$this->db->select('num');
		$this->db->from('clave'); 
		$this->db->where('num', $this->myglobalvar);
		$numero = $this->db->get();
	 $numeroRec = $numero->row();


$mail = new PHPMailer;
$mail->isSMTP(); 
//$mail->SMTPDebug = 2; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
$mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
$mail->Port = 587; // TLS only
$mail->SMTPSecure = 'tls'; // ssl is deprecated
$mail->SMTPAuth = true;
$mail->Username = 'tpseminariodelenguajes@gmail.com'; // email
$mail->Password = '2771999YT'; // password
$mail->setFrom('tpseminariodelenguajes@gmail.com', 'Franco Borsani'); // From email and name
$mail->addAddress($result1->correo, 'Sr'); // to email and name
$mail->Subject = 'RECUPERACION LOGIN TP SEMINARIO';
$mail->msgHTML($numeroRec->num); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
//$mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
// $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file
$mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
                
                
$mail->send();

   


      

      //  $this->load->library('email', $email_config);

     //   $this->email->from('borsafranco@gmail.com', 'Franco Borsani');
     //   $this->email->to($result1->correo);
     //   $this->email->subject('RECUPERACIÓN LOGIN TP SEMINARIO');
     //   $this->email->message($result2->contraseña);
	//	 $this->email->message($numeroRec->num);
     //   $this->email->send();


       $this->load->view('ingresarPassword.php');
}

      else
{

echo"<script>alert('LA PREGUNTA DE SEGURIDAD ES ERRÓNEA, VUELVA A INTENTARLO')</script>";
		$this->load->view('recuperacion.php');


}




}


else{
			echo"<script>alert('EL CORREO NO ESTÁ REGISTRADO, VUELVA A INTENTARLO')</script>";
			$this->load->view('recuperacion.php');
	}




	}




	public function verificar(){
	$correo = $this->input->post('txtCorreo');
	


		$usu = $this->input->post('txtCorreo');
		$txtClaveRecuperacion = $this->input->post('txtClaveRecuperacion');
		$res = $this->mlogin->ingresarRec($usu, $txtClaveRecuperacion);

		if($res == 1){
			$this->load->view('restablecerPassword.php');
		}else{
			echo"<script>alert('Algún dato ingresado fue inválido. Por cuestiones de seguridad, se le devolverá a la página de inicio principal')</script>";
			$this->load->view('inicio.php');
		}




	}



	public function restablecerPassword(){
		$correo = 	$this->input->post('correo');
		$nuevaClave = 	sha1($this->input->post('txtClave3'));
	$nuevaClave2 = 		sha1($this->input->post('txtClave4'));


	if(strcmp($nuevaClave, $nuevaClave2) == 0){

$this->db->set('contraseña', $nuevaClave);
$this->db->where('correo', $correo);
$this->db->update('persona'); 

$this->db->set('claveRepeat', $nuevaClave2);
$this->db->where('correo', $correo);
$this->db->update('persona'); 

   $this->load->view('inicio.php');
	}else{
echo"<script>alert('Las claves no coinciden.')</script>";
$this->load->view('restablecerPassword.php');
	}






	}


public function reestablecer(){
$pass = $this->input->post('txtPass');

	$this->db->select('num');
	$this->db->from('clave'); 
	$this->db->where('num', $pass);
	$resultado = $this->db->get();

	if($resultado->num_rows() >0){
	       $isEliminada = 	$this->mlogin->eliminarClaveTemporal($pass);
			$this->load->view('restablecerPassword.php');

}else if($resultado->num_rows() == 0){
	echo"<script>alert('Contraseña inválida. Por cuestiones de seguridad, se le devolverá a la página de inicio principal')</script>";
			$this->load->view('inicio.php');

}
	 

}


public function eliminarCuenta(){
    $this->load->view('eliminarCuenta.php');
    
    
}


public function borrarDatos(){
    $this->load->model('mpersona');
    $paramElim['txtCorreo'] = 	$this->input->post('txtCorreo');
	$paramElim['txtClave'] =  sha1($this->input->post('txtClave'));




	$variable = $this->mpersona->eliminar($paramElim);
    
    
	if($variable == 2){

	$this->load->view('bienvenido.php');
}else{
	echo"<script>alert('Alguno de los datos ingresados es inválido.')</script>";
			$this->load->view('bienvenido.php');
}
    
}


}