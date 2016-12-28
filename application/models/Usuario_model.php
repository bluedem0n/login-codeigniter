<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Usuario_model extends CI_Model
{
	public function construct()
	{
		parent::__construct();
	}

	//realizamos la inserción de los datos y devolvemos el
	//resultado al controlador para envíar el correo si todo ha ido bien
	function new_user($nombre,$apellido,$correo,$direccion,$telefono,$nick,$password)
	{
       $data = array(
            'nombre_usuario' => $nombre,
            'apellido_usuario' => $apellido,
            'correo_usuario' => $correo,
            'direccion_usuario' => $direccion,
            'telefono_usuario' => $telefono,
            'nick_usuario' => $nick,
            'pass_usuario' => $password,
						'perfil_usuario' => "empleado"
        );
        return $this->db->insert('usuario', $data);
  }

			public function getUsuarios()
			{
			  $this->db->select('u.id,u.nombre_usuario,u.apellido_usuario,u.correo_usuario,u.direccion_usuario,u.telefono_usuario,u.nick_usuario,u.pass_usuario,u.perfil_usuario');
			  $this->db->from('usuario u');

			  $r = $this->db->get();
			  return $r->result();
		  }

	    function eliminar_usuario($idU){
	      $this->db->where('id',$idU);
	      $this->db->delete('usuario');
	    }

	    function actualizar_usuario($datos, $id)
			{
	      $this->db->where('id',$id);
		    $this->db->Update('usuario',$datos);
	    }

	    function buscarporapellido($busqueda)
			{
				$this->db->like('apellido_usuario',$busqueda, 'both');
	      $this->db->from('usuario');
	      $r = $this->db->get();

				if($r->num_rows() > 0){
            return $r->result();
        }else{
            return FALSE;
        }
	    }



}
