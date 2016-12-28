<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 */
class Lo_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function login_user($username,$password)
	{

		$this->db->where('nick_usuario',$username );
		$this->db->where( 'pass_usuario', $password);
		$login = $this->db->get('usuario');

		/*$this->db->where('nick_usuario',$username);
		$this->db->where('pass_usuario',$password);
		$query = $this->db->get('usuario');*/
		if($login->num_rows() == 1)
		{
			return $login->row();
		}else{
		 return FALSE;
		}
	}

	public function reset_password($correo){

		$this->db->where('correo_usuario',$correo);
		$query = $this->db->get('usuario');

		if ($query->num_rows() == 1) {
	      return $query->row();
		}else{
			return FALSE;
		}

	}


}
