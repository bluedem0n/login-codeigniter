<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

  function __construct()
  {
  		parent::__construct();
      $this->load->model('usuario_model');
  }

	public function index()
	{
    $data['title'] = 'Formulario de registro';
		$data['head'] = 'Regístrate desde aquí';
		$this->load->view('login_new',$data);
	}


  function nuevo_usuario()
  	{
  		if(isset($_POST['grabar']) and $_POST['grabar'] == 'si')
  		{
  			//SI EXISTE EL CAMPO OCULTO LLAMADO GRABAR CREAMOS LAS VALIDACIONES
  			$this->form_validation->set_rules('nombre','Nombre','required');
  			$this->form_validation->set_rules('apellido','Apellido','required');
  			$this->form_validation->set_rules('correo','Correo','required');
  			$this->form_validation->set_rules('direccion','Direccion','required');
        $this->form_validation->set_rules('telefono','Telefono','required');
  			$this->form_validation->set_rules('nick','Usuario','required');
  			$this->form_validation->set_rules('pass','Password','required');

  			//SI HAY ALGÚNA REGLA DE LAS ANTERIORES QUE NO SE CUMPLE MOSTRAMOS EL MENSAJE
  			//EL COMODÍN %s SUSTITUYE LOS NOMBRES QUE LE HEMOS DADO ANTERIORMENTE, EJEMPLO,
  			//SI EL NOMBRE ESTÁ VACÍO NOS DIRÍA, EL NOMBRE ES REQUERIDO, EL COMODÍN %s
  			//SERÁ SUSTITUIDO POR EL NOMBRE DEL CAMPO
  			$this->form_validation->set_message('required', 'El %s es requerido');
  	        $this->form_validation->set_message('valid_email', 'El %s no es válido');

  			//SI ALGO NO HA IDO BIEN NOS DEVOLVERÁ AL INDEX MOSTRANDO LOS ERRORES
  			if($this->form_validation->run()==FALSE)
  			{
          $data['mensaje'] = "Ha ocurrido un error al registrarse, por favor intentelo nuevamente";
          $this->load->view('login_new', $datos);
  			}else{
  			//EN CASO CONTRARIO PROCESAMOS LOS DATOS
  				$nombre = $this->input->post('nombre');
  				$apellido = $this->input->post('apellido');
  				$correo = $this->input->post('correo');
  				$direccion = $this->input->post('direccion');
          $telefono = $this->input->post('telefono');
  				$nick = $this->input->post('nick');
  				$password = $this->input->post('pass');

          if ($this->comprobar_email($correo) == 1 ) {
                        //ENVÍAMOS LOS DATOS AL MODELO CON LA SIGUIENTE LÍNEA
            $insert = $this->usuario_model->new_user($nombre,$apellido,$correo,$direccion,$telefono,$nick,$password);
            //si el modelo nos responde afirmando que todo ha ido bien, envíamos un correo
            //al usuario y lo redirigimos al index, en verdad deberíamos redirigirlo al home de
            //nuestra web para que puediera iniciar sesión

            //cargamos la libreria email de ci
            $this->load->library("email");

            //configuracion para gmail
            $configGmail = array(
              'protocol' => 'smtp',
              'smtp_host' => '', //host del servidor de correo
              'smtp_port' => 587,
              'smtp_user' => '', //correo
              'smtp_pass' => '',  //clave
              'mailtype' => 'html',
              'charset' => 'utf-8',
              'newline' => "\r\n"
            );

            //cargamos la configuración para enviar con gmail
                $this->email->initialize($configGmail);

                $this->email->from(''); //EMAIL DE QUIEN ENVIA EL CORREO
                $this->email->to($correo); //DESTINATARIO
                $this->email->subject('Bienvenido/a al Sistema');
                $this->email->message('<h2>' . $nombre . ' gracias por registrarte en el sistema</h2><hr><br><br>
                Tu nombre de usuario es: ' . $nick . '.<br>Tu password es: ' . $password);
                $this->email->send();// ENVIAR CORREO

                if (! $this->email->send()) {
                  $data['registro'] = "El usuario se ha creado correctamente introdusca los datos para ingresar al sistema";
                  $this->load->view('login_new', $data);

                }else{
                  $data['registro'] = "Conexion a internet no permite el envio de correo, pero el usuario fue creado";
                  $this->load->view('login_new', $data);
                }
          }else{
            $data['registro']= "El correo ingresado no era valido ocurrio un error intentelo nuevamene";
            $this->load->view('login_new', $data);
          }


  			}
  		}
  	}

    function comprobar_email($email){
     $mail_correcto = 0;
     //compruebo unas cosas primeras
     if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@")){
        if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," "))) {
           //miro si tiene caracter .
           if (substr_count($email,".")>= 1){
              //obtengo la terminacion del dominio
              $term_dom = substr(strrchr ($email, '.'),1);
              //compruebo que la terminación del dominio sea correcta
              if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) ){
                 //compruebo que lo de antes del dominio sea correcto
                 $antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1);
                 $caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1);
                 if ($caracter_ult != "@" && $caracter_ult != "."){
                    $mail_correcto = 1;
                 }
              }
           }
        }
     }
     if ($mail_correcto)
        return 1;
     else
        return 0;
  }

        function mostrar_usuarios()
        {
        	echo json_encode($this->usuario_model->getUsuarios());
        }

    		function actualizarUsuario()
        {
    			  $id = $this->input->post('id_usuario');
            $nombre = $this->input->post('nombre_usuario');
    				$apellido = $this->input->post('apellido_usuario');
    				$correo = $this->input->post('correo_usuario');
    				$direccion = $this->input->post('direccion_usuario');
    				$telefono = $this->input->post('telefono_usuario');
    				$nick = $this->input->post('nick_usuario');
    				$pass = $this->input->post('pass_usuario');
    				$perfil = $this->input->post('perfil_usuario');

    				$datos_actualizar = array(
    					"nombre_usuario"=>$nombre,
    					"apellido_usuario"=>$apellido,
    					"correo_usuario"=>$correo,
    					"direccion_usuario"=>$direccion,
    					"telefono_usuario"=>$telefono,
    					"nick_usuario"=>$nick,
    					"pass_usuario"=>$pass,
    					"perfil_usuario"=>$perfil
    				);

    				$this->usuario_model->actualizar_usuario($datos_actualizar, $id);
    		}

    		function eliminar_usuario()
        {
    		$idU = $this->input->post('idU');
    		$this->usuario_model->eliminar_usuario($idU);
    		}







}
