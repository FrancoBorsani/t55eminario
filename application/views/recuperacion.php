<!DOCTYPE html>
<html>
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!-- no additional media querie or css is required -->
<div class="container">
        <div class="row justify-content-center align-items-center" style="height:100vh">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <form action="<?php echo base_url();?>clogin/solucion" method="POST">
                            <div class="form-group">
                              <h1>SE ENVIARÁ LA CONTRASEÑA A SU CORREO</h1>
                         <input type="text" name="txtCorreoRecuperacion" placeholder="Ingrese su correo electronico" required="required" />
                            </div>
                            <div class="form-group">
                                 <select id="inputState" class="form-control" >
                            <option selected>Pregunta de seguridad</option>
                            <option>¿Nombre de su primera mascota</option>
                            <option>Numero de la vivienda en la que vive</option>
               <input type="text" name="txtPreguntaRespuestaRec" placeholder="Responda la pregunta" required="required" />
                          </select>
                            </div>
                          <button type="submit" class="btn btn-primary btn-block btn-large" name="Enviar">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



</body>
</html>
