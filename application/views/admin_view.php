<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="<?= base_url().'../css/font.css' ?>" rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?= base_url().'../css/style.css' ?>">
    <link rel="stylesheet" href="<?= base_url().'../css/popup.css' ?>">
    <link rel="stylesheet" href="<?= base_url().'../css/table.css' ?>">
    <script src="<?= base_url().'../js/prefixfree.min.js' ?>"></script>

     <script type="text/javascript">
          var base_url = '<?=base_url()?>';
     </script>

  </head>
  <body>

    <form  action="http://localhost/login-codeigniter/index.php/Login_controller/logout_ci" method="post">
      <button style="width:100px;" class="button">salir</button>
    </form>

   <div class="form2">
     <h1 style="color:black;">Bienvenido Administrador</h1>

     <table id="tlbusuarios" class="table">
       <tr>
         <th>Id</th>
         <th>Nombre</th>
         <th>Apellido</th>
         <th>Correo</th>
         <th>Direccion</th>
         <th>Telefono</th>
         <th>Nick</th>
         <th>Pass</th>
         <th>Perfil</th>
         <th>Modificar</th>
         <th>Eliminar</th>
       </tr>
     </table>
    </div> <!--Div Form-->



 <div class="modal-wrapper" id="popup">
    <div class="popup-contenedor">
       <div id="signup">
            <h4>Actualiza tus datos</h4>
            <input id="frm_id" type="hidden"/>
              <div class="field-wrap">
                <input class="margenes" type="text" id="frm_nombre" name="nombre" placeholder="Nombre"  required autocomplete="off" />
            </div>
            <div class="top-row">
              <div class="field-wrap">
                <input class="margenes" type="text" id="frm_apellido" name="apellido" placeholder="Apellido"  required autocomplete="off" />
              </div>
            </div>

            <div class="field-wrap">
              <input type="hidden" name="grabar" value="si" />
              <input class="margenes" type="text" id="frm_correo" name="correo" placeholder="Correo"  required autocomplete="off"/>
            </div>

            <div class="field-wrap">
              <input class="margenes" type="text" id="frm_direccion" name="direccion" placeholder="Direccion"  required autocomplete="off" />
            </div>

           <div class="field-wrap">
              <input class="margenes" type="text" id="frm_telefono" name="telefono" placeholder="Telefono" required autocomplete="off" />
            </div>

            <div class="field-wrap">
               <input class="margenes" type="text" id="frm_nick" name="nick" placeholder="Usuario"  required autocomplete="off" />
            </div>

            <div class="field-wrap">
              <input class="margenes" type="password" id="frm_pass" name="pass" placeholder="Contraseña" required autocomplete="off" />
            </div>

            <div class="field-wrap select">
              <select class="margenes" id="frm_perfil">
                <option>empleado</option>
                <option>administrador</option>
              </select>
            </div>

            <a class="button button-block" id="btn_modificarUsuario" value="Actualizar" title="Actualizar"/>Actualizar</a>
            <br>
            <a class="button button-block" href="#" value="Cancelar" title="Cancelar"/>Cancelar</a>
            </form>

            <font color="red" style="font-weight: bold; font-size: 14px; text-decoration: underline"><?php echo validation_errors(); ?></font>

          </div>
       <a class="popup-cerrar" href="#">X</a>
    </div>
</div>




    <script src="<?= base_url().'../js/jquery.min.js' ?>"></script>
    <script src="<?= base_url().'../js/index.js' ?>"></script>
    <script src="<?= base_url().'../js/usuario.js' ?>"></script>

  </body>
</html>
