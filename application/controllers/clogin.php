<?php



/**
 * 
 */
class Clogin extends CI_Controller
{
	private $myglobalvar=10000000;
	
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
      

$email_config = Array(
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => '465',
            'smtp_user' => 'borsafranco@gmail.com',
            'smtp_pass' => '2771999allforwindows10',
            'mailtype'  => 'html',
            'starttls'  => true,
            'newline'   => "\r\n"
        );


//CREACIÓN DE CLAVES ALEATORIOS:
		$this->myglobalvar = $this->myglobalvar + rand(1,900);
	
		if($this->myglobalvar > 10001000){
			 $myglobalvar=10000000;

		}
		$this->db->select('num');
		$this->db->from('clave'); 
		$this->db->where('num', $this->myglobalvar);
		$numero = $this->db->get();
	 $numeroRec = $numero->row();
      

        $this->load->library('email', $email_config);

        $this->email->from('borsafranco@gmail.com', 'Franco Borsani');
        $this->email->to($result1->correo);
        $this->email->subject('RECUPERACIÓN LOGIN TP SEMINARIO');
     //   $this->email->message($result2->contraseña);
		 $this->email->message($numeroRec->num);
        $this->email->send();


       $this->load->view('ingresarPassword.php');
}

      else
{

echo"<script>alert('LA PREGUNTA DE SEGURIDAD ES ERRÓNEA, VUELVA A INTENTARLO')</script>";
		$this->load->view('recuperacion.php');


}




}



 /* 
 if($this->email->send()){

 	
 }
          $this->session->set_flashdata("email_sent","Congragulation Email Send Successfully.");*/

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

	if($resultado->num_rows() == 1){
			$this->load->view('restablecerPassword.php');

}else{
	echo"<script>alert('Contraseña inválida. Por cuestiones de seguridad, se le devolverá a la página de inicio principal')</script>";
			$this->load->view('inicio.php');

}


}


}