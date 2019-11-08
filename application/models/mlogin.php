<?php



class Mlogin extends CI_Model{


public function ingresar($usu, $pass){
	$this->db->select('idPersona', 'nombre', 'contraseña');
	$this->db->from('persona'); 
	$this->db->where('nombre', $usu);
	$this->db->where('contraseña', $pass);

	$resultado = $this->db->get();

	if($resultado->num_rows() == 1){
	/*	$r = $resultado->row();

		$s_usuario = array(
			's_idPersona' => $r->idPersona,
			's_userName' => $r->nombre
		);

	//	$this->session->set_userdata($s_usuario);*/
		return 1;
	}else{
		return 0;
	}


}



}