<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Welcome extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('mpersona');
	}



	public function index()
	{
		$this->load->view('bienvenido.php');
	}

	public function guardar(){
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






	}

}