<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="<?= base_url().'../css/font.css' ?>" rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?= base_url().'../css/style.css' ?>">
    <link rel="stylesheet" href="<?= base_url().'../css/popup.css' ?>">
  </head>

  <body>

    <div class="form">

        <ul class="tab-group">
          <li class="tab active"><a href="#login">Iniciar Sesion</a></li>
          <li class="tab"><a href="#signup">Registrarse</a></li>
        </ul>

        <div class="tab-content">

          <div id="login">
            <h1>Ingresa tus datos</h1>

            <form action="<?= base_url().'Login_controller/new_user' ?>" method="post">

            <div class="field-wrap">
              <input type="text" name="username" onkeypress="return soloLetras(event)" placeholder="Usuario" maxlength="50"  required autocomplete="off"/>
            </div>
            <div class="field-wrap">
              <input type="password" name="password" placeholder="Contraseña" maxlength="30" required autocomplete="off"/>
            </div>

            <h2 style="color:red; font-size: 14px; letter-spacing:.3px;"><?php if(isset($mensaje)) echo $mensaje; ?></h2>
            <h2 style="color:red; font-size: 14px; letter-spacing:.3px;"><?php if(isset($mensaje2)) echo $mensaje2; ?></h2>
            <h2 style="color:#1ab188; font-size: 14px; letter-spacing:.3px;"><?php if(isset($registro)) echo $registro; ?></h2>
            <br>
            <?=validation_errors();?>
            <p class="forgot"><a class="mostrarmodal" href="#">¿Olvidaste tu Contraseña?</a></p>
            <button class="button button-block"/>Aceptar</button>

            </form>

          </div>


          <div class="cajaexterna">
            <div class="cajainterna animated">
              <div class="cajacentrada">
                  <h2>Restablecer Contraseña</h2>
                  <form class="" action="<?= base_url().'Login_controller/reset_password' ?>" method="post">
                    <div class="field-wrap">
                      <input type="email" name="correo" maxlength="50" placeholder="Ingresa el correo de recuperacion" value="<?php echo set_value('correo') ?>" required autocomplete="off" />
                    </div>
                    <button  style="margin-left: 130px;" class="button button-block" type="submit" name="Enviar">Aceptar</button>
                  </form>
                <div class="cierramodal">
                 <a href="#" style="margin-left: 500px;"  class="cerrarmodal">cerrar</a>
                </div>
              </div>
            </div>
          </div>


          <div id="signup">
            <h1>Ingresa tus datos</h1>

            <form action="<?= base_url().'Usuario/nuevo_usuario' ?>" method="post">

            <div class="top-row">
              <div class="field-wrap">
                <input type="text" class="margin2" name="nombre" onkeypress="return soloLetras(event)" maxlength="20" placeholder="Nombre" value="<?php echo set_value('nombre') ?>" required autocomplete="off" />
              </div>

              <div class="field-wrap">
                <input type="text" maxlength="30" class="margin" onkeypress="return soloLetras(event)" name="apellido" placeholder="Apellido" value="<?php echo set_value('apellido') ?>" required autocomplete="off" />
              </div>
            </div>

            <div class="field-wrap">
              <input type="hidden" name="grabar" value="si" />
              <input type="email" name="correo" placeholder="Correo" value="<?php echo set_value('correo') ?>" required autocomplete="off"/>
            </div>

            <div class="field-wrap">
              <input type="text" maxlength="100" name="direccion" placeholder="Direccion" value="<?php echo set_value('direccion') ?>" required autocomplete="off" />
            </div>

           <div class="field-wrap">
              <input type="number" maxlength="9" name="telefono" placeholder="Telefono" value="<?php echo set_value('telefono') ?>" required autocomplete="off" />
            </div>

            <div class="field-wrap">
               <input type="text" maxlength="50" name="nick" placeholder="Usuario" value="<?php echo set_value('nick') ?>" required autocomplete="off" />
            </div>

            <div class="field-wrap">
              <input type="password" maxlength="30" name="pass" placeholder="Contraseña" required autocomplete="off" />
            </div>

            <button class="button button-block" type="submit" value="Registrarme" title="Registrarme"/>Registrarse</button>

            </form>

            <font color="red" style="font-weight: bold; font-size: 14px; text-decoration: underline"><?php echo validation_errors(); ?></font>

          </div>



        </div><!-- tab-content -->

  </div> <!-- /form -->

    <script src="<?= base_url ().'../js/jquery.min.js'?>"></script>
    <script src="<?= base_url ().'../js/index.js'?>"></script>

    <script>
    function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }
</script>

    <script type="text/javascript">
    $(document).ready(function(e) {
      var mozillaPresente = false,
              mozilla = (function detectarNavegador(navegador) {
              if(navegador.indexOf("Firefox") != -1 ) {
                  mozillaPresente = true;
              }
          })(navigator.userAgent);
          function darEfecto(efecto) {
              el = $('.cajainterna');
              el.addClass(efecto);
              el.one('webkitAnimationEnd oanimationend msAnimationEnd animationend',
              function (e) {
                  el.removeClass(efecto);
              });
          }
  function mostrar(e) {
      $(".cajaexterna").show();
      darEfecto("bounceIn");
  }
  function ocultar() {
      $(".cajaexterna").fadeOut("fast", function() {
          if(mozillaPresente) {
          setTimeout(function() {
              $(".cajainterna").removeClass("bounceIn");
          }, 5);
      }
      });
  }
  $("a.mostrarmodal").click(mostrar);
  $("a.cerrarmodal").click(ocultar);
});
    </script>

  </body>
</html>
