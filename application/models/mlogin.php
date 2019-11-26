<?php



class Mlogin extends CI_Model{


public function ingresar($usu, $pass){
	$this->db->select('correo', 'contraseña');
	$this->db->from('persona');
	$this->db->where('correo', $usu);
	$this->db->where('contraseña', $pass);

	$resultado = $this->db->get();

	if($resultado->num_rows() == 1){

		return 1;
	}else{
		return 0;
	}


}





public function ingresarRec($usu, $txtClaveRecuperacion){
	$this->db->select('correo');
	$this->db->from('persona');
	$this->db->where('correo', $usu);

	$resultado = $this->db->get();

	if($resultado->num_rows() == 1){

	$this->db->select('num');
	$this->db->from('clave');
	$this->db->where('num', $txtClaveRecuperacion);

$resultado2 = $this->db->get();

	if($resultado2->num_rows() == 1){
		return 1;
		}

		
	}else{
		return 0;
	}


}

public function agregarClaveTemporal($claveTemporal){


$campoClave = array(
	'num' => $claveTemporal

);


$this->db->insert('clave', $campoClave);


return;
}



public function eliminarClaveTemporal($pass){

$this->db->where('num', $pass);
$this->db->delete('clave');

return 1;

}


}