<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_controller extends CI_Controller {

  public function __construct()
      {
          parent::__construct();
  		$this->load->model('lo_model');
  		$this->load->library(array('session','form_validation'));
  		$this->load->helper(array('url','form'));
  		$this->load->database('default');

      }

  	public function index()
  	{
      if ($this->session->userdata('is_logued_in') == TRUE)
       {
         switch ($this->session->userdata('perfil_usuario')) {
           case '':
             $data['titulo'] = 'Login con roles de usuario en codeigniter';
             $this->load->view('login_new',$data);
             break;
           case 'administrador':
             redirect(base_url().'Admin_controller');
             break;
           case 'empleado':
             redirect(base_url().'Empleado_controller');
             break;
           default:
             $data['titulo'] = 'Login con roles de usuario en codeigniter';
             $this->load->view('login_new',$data);
             break;
         }
  	   }else{
         $this->load->view('login_new');
       }

  	}

  public function new_user()
  	{
              $this->form_validation->set_rules('username', 'username', 'required');
              $this->form_validation->set_rules('password', 'password', 'required');

              //lanzamos mensajes de error si es que los hay

  			if($this->form_validation->run() == FALSE)
  			{
  				$this->index();
  			}else{
  				$username = $this->input->post('username');
  				$password = $this->input->post('password');
  				$check_user = $this->lo_model->login_user($username,$password);
  				if($check_user == TRUE)
  				{
  					$data = array(
  	                'is_logued_in' 	=> 		TRUE,
  	                'perfil_usuario'		=>		$check_user->perfil_usuario,
  	                'nick_usuario' 		=> 		$check_user->nick_usuario
              		);
  					$this->session->set_userdata($data);
  					$this->index();
  				}

          if ($check_user == FALSE) {
             $datos["mensaje"]="Usuario y/o Contraseña Incorrectoas, intentelo Nuevamente";
             $datos["mensaje2"] = "Si el Problema persiste contactese con el administrador el sistema";

             $this->load->view('login_new',$datos);

          }

  			}

  	}

    public function reset_password(){

          $correo = $this->input->post('correo');
          $check_correo = $this->lo_model->reset_password($correo);

          if($check_correo == TRUE)
          {
            if ($check_correo->correo_usuario == $correo) {

                $nombre = $check_correo->nombre_usuario;
                $nick = $check_correo->nick_usuario;
                $pass = $check_correo->pass_usuario;

              //cargamos la libreria email de ci
                  $this->load->library("email");

                  //configuracion para gmail
                  $configGmail = array(
                  'protocol' => 'smtp',
                  'smtp_host' => '', //host de servidor de correos
                  'smtp_port' => 587,
                  'smtp_user' => '', //correo
                  'smtp_pass' => '',  //clave
                  'mailtype' => 'html',
                  'charset' => 'utf-8',
                  'newline' => "\r\n"
                );

                  //cargamos la configuración para enviar con gmail
                      $this->email->initialize($configGmail);

                      $this->email->from('');  //EMAIL DE QUIEN ENVIA EL CORREO
                      $this->email->to($correo); //DESTINATARIO
                      $this->email->subject('Recuperacion de Contraseña');
                      $this->email->message('<h2>' . $nombre . ' Estos son los datos para ingresar al sistema, gracias</h2><hr><br><br>
                      Tu nombre de usuario es: ' . $nick . '.<br>Tu password es: ' . $pass);
                      $this->email->send(); // ENVIAR CORREO

                         $this->load->view('login_new');
        }else{
          $data['registro']= "El correo ingresado no era valido ocurrio un error intentelo nuevamene";
          $this->load->view('login_new', $data);
        }

        }

    }

      function comprobar_email($email){
       $mail_correcto = 0;
       //compruebo el correo introducido
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



  	public function token()
  	{
  		$token = md5(uniqid(rand(),true));
  		$this->session->set_userdata('token',$token);
  		return $token;
  	}

  	public function logout_ci()
  	{
  		$this->session->sess_destroy();
  	  redirect(base_url());
  	}

  }
