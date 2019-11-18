<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <form action="<?php echo base_url(); ?>Welcome/guardar" method="POST">
            <table>
                <tr>

        <input type="text" name="txtUsuario" placeholder="Nombre de usuario" required="required" />
        <input type="password" name="txtClave" placeholder="Contaseña" required="required" />
        <input type="password" name="claveRepeat" placeholder="Repita la contraseña" required="required" />
        <input type="text" name="txtNombre" placeholder="Nombre" required="required" />
        <input type="text" name="txtApellido" placeholder="Apellido" required="required" />
        <input type="text" name="txtCorreo" placeholder="Correo electrónico" required="required" />

                </tr>

          
   <div class="row">
                <div class="col-md-4 offset-md-3">
                    <div class="form-group ">
                          <select id="inputState" class="form-control" >
                            <option selected>Pregunta de seguridad</option>
                            <option>¿Nombre de su primera mascota</option>
                            <option>Numero de la vivienda en la que vive</option>
               <input type="text" name="txtPreguntaRespuesta" placeholder="Responda la pregunta" required="required" />
                          </select>
                        </div>
                </div>
                 

        <button type="submit" class="btn btn-primary btn-block btn-large" name="guardar">REGISTRARSE</button>
    </form>

</body>
</html>
