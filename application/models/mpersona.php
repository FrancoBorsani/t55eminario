<?php

class Mpersona extends CI_model {

	 function __construct(){
		parent::__construct();
	}


	public function guardar($param){
	$this->db->select('nombre');
	$this->db->from('persona');
	$this->db->where('nombre', $param['nombreUs']);

	$resultado = $this->db->get();

	if($resultado->num_rows() >0){
		echo"<script>alert('EL NOMBRE DE USUARIO YA EXISTE, ELIJA OTRO')</script>";
	return;}

	$this->db->select('correo');
	$this->db->from('persona'); 
	$this->db->where('correo', $param['correo']);

	$resultado2 = $this->db->get();


	if($resultado2->num_rows() >0){
		echo"<script>alert('EL CORREO YA ESTÁ REGISTRADO EN ESTA PÁGINA')</script>";
		return;
}

	$campos = array(
	'nombre' => $param['nombreUs'],
	'contraseña' => $param['clave'],
	'claveRepeat' => $param['claveRepeat'],
	'nombrePersona' => $param['nombrePersona'],
	'apellidoPersona' => $param['apellidoPersona'],
	'correo' => $param['correo'],
	'preguntaRespuesta' => $param['txtPreguntaRespuesta']
);

$this->db->insert('persona', $campos);

return 2;
}

	}

