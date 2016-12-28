<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 */
class Empleado_controller extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(array('url'));
	}

	public function index()
	{
		if($this->session->userdata('perfil_usuario') == FALSE || $this->session->userdata('perfil_usuario') != 'empleado')
		{
			redirect(base_url().'login_controller');
		}
		$data['titulo'] = 'Bienvenido Empleado';
		$this->load->view('empleado_view',$data);
	}
}
