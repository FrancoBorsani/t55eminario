<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Welcome extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('mpersona');

	}



	public function index()
	{
			$this->load->library('Recaptcha');
		$this->load->view('bienvenido.php');
	}

	public function guardar(){
	    
	    		// Load the library
		$this->load->library('recaptcha');

		// Catch the user's answer
	//	$captcha_answer = $this->input->post('g-recaptcha-response');
$captcha_answer = $this->input->post('g-recaptcha-response');
		// Verify user's answer
		$response = $this->recaptcha->verifyResponse($captcha_answer);

		// Processing ...
		if ($response['success']) {

	$param['nombreUs'] = 	$this->input->post('txtUsuario');
	$param['clave'] =  sha1($this->input->post('txtClave'));
	$param['claveRepeat'] = sha1($this->input->post('claveRepeat'));
	$param['nombrePersona'] = $this->input->post('txtNombre');
	$param['apellidoPersona'] = $this->input->post('txtApellido');
	$param['correo'] = $this->input->post('txtCorreo');
	$param['txtPreguntaRespuesta'] = $this->input->post('txtPreguntaRespuesta');


	if(strcmp($param['clave'], $param['claveRepeat']) != 0){

		echo"<script>alert('La clave no ha sido validada correctamente')</script>";
			$this->load->view('registro.php');
	}



	$variable = $this->mpersona->guardar($param);

	if($variable == 2){

	$this->load->view('inicio.php');
}else{

	$this->load->view('registro.php');
}




		} else {
		    echo"<script>alert('EL CAPTCHA NO HA SIDO VALIDADO')</script>";
		$this->load->view('registro.php');
		}
	    
	  

	}
	

}