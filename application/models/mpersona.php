<?php

class Mpersona extends CI_model {

	 function __construct(){
		parent::__construct();
	}


	public function guardar($param){
	$this->db->select('idPersona', 'nombre', 'contraseña');
	$this->db->from('persona'); 
	$this->db->where('nombre', $param['nombre']);
	$this->db->where('contraseña', $param['clave']);

	$resultado = $this->db->get();

	if($resultado->num_rows() >0){

		echo "ERROR AL ACCEDER, EL USUARIO YA EXISTE";
		return;
}else{



$campos = array(
	'nombre' => $param['nombre'],
	'contraseña' => $param['clave']
);

$this->db->insert('persona', $campos);
}

	}



}