<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
	    <h1>Registro</h1>



    <form action="<?php echo base_url(); ?>Welcome/guardar" method="POST">
        
        <table>
            
            <tr>
                <tr>REGISTRARSE SI NO LO HA HECHO</tr>
                
                <td><label>Nombre de Usuario</label>  </td>
                <td><input type="text" name="txtUsuario"></td>

                </tr>

                <tr>
                     <td><label>Contraseñaaaaa</label>  </td>
                <td><input type="password" name="txtClave"></td>

                </tr>
                <tr>
                    
                    <td colspan="2"><input type="submit" name="guardar"></td>
                </tr>
        </table>

    </form>
    <a href="<?php echo base_url();?>clogin">LOGUEARSE</a>


</body>
</html>

