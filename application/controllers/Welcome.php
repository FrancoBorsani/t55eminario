<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Welcome extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('mpersona');
	}



	public function index()
	{
	$this->load->view('login.php');
	//	$this->load->view('welcome_message');
	}

	public function guardar(){
	$param['nombre'] = 	$this->input->post('txtUsuario');
	$param['clave'] =  sha1($this->input->post('txtClave'));
	$this->mpersona->guardar($param);

	$this->load->view('login.php');

	}


	




}