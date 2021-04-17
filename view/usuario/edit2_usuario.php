<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Mi Perfil </h4>
                        <ol class="breadcrumb p-0 m-0">
                            <li>
                                <a href="#">Mantenedores</a>
                            </li>
                            <li class="active">
                                Mi Perfil
                            </li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <?php foreach ($this->model->lista() as $rows); ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        <div class="body">
                            <form class="form" id="form" method="POST">
                                <label for="txtRutUsuario">Rut Usuario</label>
                                <div class="form-group">
                                    <input type="text" id="txtRutUsuario" name="txtRutUsuario" value="<?php echo $rows['rut_usuario'].'-'.$rows['dv_usuario']?>" class="form-control" placeholder="Ingrese el Rut de Usuario">
                                </div>
                                <label for="txtNombreUsuario">Nombre Usuario</label>
                                <div class="form-group">
                                    <input type="text" id="txtNombreUsuario" name="txtNombreUsuario" value="<?php echo $rows['nombre_usuario']?>" class="form-control" placeholder="Ingrese el Nombre de Usuario">
                                </div>
                                <label for="txtApellidoP">Apellidos Paterno</label>
                                <div class="form-group">
                                    <input type="text" id="txtApellidoP" name="txtApellidoP" value="<?php echo $rows['apellido_usuario']?>" class="form-control" placeholder="Ingrese el Apellido de Usuario">
                                </div>
                                <label for="txtCorreoElectronico">Correo</label>
                                <div class="form-group">
                                    <input type="text" id="txtCorreoElectronico" name="txtCorreoElectronico" value="<?php echo $rows['correo_usuario']?>" class="form-control" placeholder="Ingrese el Apellido de Usuario">
                                </div>
                                <label for="tipoUsuario">Tipo Usuario</label>
                                <div class="form-group">
                                    <select class="form-control" id="tipoUsuario" name="tipoUsuario">
                                      <option value="0">SELECCIONE TIPO USUARIO</option>
                                      <?php foreach ($this->modelTipoUsuario->lista() as $rows2): ?>
                                       <?php if($rows['tipo_usuario']==$rows2['id_tipousuario']){ ?>
                                         <option value="<?php echo $rows2['id_tipousuario'] ?>" selected><?php echo $rows2['descripcion_tipousuario'] ?></option>
                                       <?php } else{ ?>
                                         <option value="<?php echo $rows2['id_tipousuario'] ?>"><?php echo $rows2['descripcion_tipousuario'] ?></option>
                                       <?php } endforeach;?>
                                    </select>
                                </div>
                                <label for="txtPassword">Contraseña</label>
                                <div class="form-group">
                                    <input onblur="validapwIguales()" type="password" id="txtPassword" name="txtPassword" value="<?php echo $rows['password_usuario']?>" class="form-control" placeholder="Contraseña" style="width: 50%;">
                                </div>
                                <label for="txtPassword2">Repetir Contraseña</label>
                                <div class="form-group">
                                    <input onblur="validapwIguales()" type="password" id="txtPassword2" name="txtPassword2" value="<?php echo $rows['password_usuario']?>" class="form-control" placeholder="Contraseña" style="width: 50%;">
                                </div>

                                <button type="button" onclick="editar(<?php echo $rows['rut_usuario']?>)" class="btn btn-info btn-round"><i class="zmdi zmdi-floppy"></i> Editar</button>
                                <a href="<?php echo $this->urlhome; ?>"> <button type="button" class="btn btn-danger btn-round"><i class="zmdi zmdi-long-arrow-return"></i> Volver</button></a>
                            </form>
                        </div>
                    </div>
                </div>
            </div> <!-- end row -->
        </div> <!-- container -->
    </div> <!-- content -->

</div>

<script type="text/javascript">
    //vlida el rut
    $('input[name="txtRutUsuario"]').Rut({
        on_error: function(){
            $('button[type="submit"]').attr("disabled", true);
            $('button.btnlogin').html('Ops! Rut incorrecto');
        },
        format_on: 'keyup'
    });

    $('input[name="txtRutUsuario"]').Rut({
        on_error: function(){
            $('button[type="submit"]').attr("disabled", true);
            alertify.error('Run Incorrecto');
        },
        on_success:  function(){
            $('button[type="submit"]').attr("disabled", false);
            alertify.success('Run Correcto');
        },
        format_on: 'keyup'
    });

    var errores = 0;

    function validapwIguales() {
        var pw1 = $('#txtPassword').val();
        var pw2 = $('#txtPassword2').val();

        if (pw1 && pw2 != '') {
            if (pw1 != pw2) {
                errores = 1;
                alertify.error('Las contraseñas no coinciden!');
            }
        } else {
            errores = 0;
        }
    }

    function editar(idusu) {

        if (validacionesUsu() == '') {
            $.ajax({
                data: {
                    "txtRutUsuario": $('#txtRutUsuario').val(),
                    "txtNombreUsuario": $('#txtNombreUsuario').val(),
                    "txtApellidoP": $('#txtApellidoP').val(),
                    "txtPassword": $('#txtPassword').val(),
                    "txtCorreoElectronico": $('#txtCorreoElectronico').val(),
                    "tipoUsuario": $('#tipoUsuario').val(),
                    "idusu":idusu
                },
                url: "<?php echo $this->urlupdate2; ?>",
                type: "POST",
                cache: false,
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                beforeSend: function() {
                    $('.message').html('<div class="sk-wave"> <div class="sk-rect sk-rect1"></div> <div class="sk-rect sk-rect2"></div> <div class="sk-rect sk-rect3"></div> <div class="sk-rect sk-rect4"></div> <div class="sk-rect sk-rect5"></div> </div>');
                },
                success: function(respuesta) {
                  //alert(respuesta);
                    if (respuesta == 1) {
                        alertify.success('Guardado Exitosamente!');
                        limpiar();
                        setTimeout(() => {
                            window.location.href = 'view.php';
                        }, 1000);
                    } else {
                        alertify.error('Error al ingresar la información');
                    }
                }
            });
            return false;
        } else {
            alert(validacionesUsu());
        }

    }

    function validacionesUsu() {
        var errores = '';

        if ($('#txtRutUsuario').val() == '') {
            errores += '- Debe completar el Rut de Usuario \n';
        }
        if ($('#txtNombreUsuario').val() == '') {
            errores += '- Debe completar el Nombre de Usuario \n';
        }
        if ($('#txtApellidoUsuario').val() == '') {
            errores += '- Debe completar el Apellido de Usuario \n';
        }
        if ($('#txtFecNacimiento').val() == '') {
            errores += '- Debe completar la Fecha de Nacimiento \n';
        }
        if ($('#txtCorreoElectronico').val() == '') {
            errores += '- Debe completar el Correo de Usuario \n';
        }
        if ($('#txtPassword').val() == '') {
            errores += '- Debe completar la Contraseña de Usuario \n';
        }

        var pw1 = $('#txtPassword').val();
        var pw2 = $('#txtPassword2').val();

        if (pw1 && pw2 != '') {
            if (pw1 != pw2) {
                errores += '- Las Contraseñas no Coinciden \n';
            }
        }

        return errores;
    }

    function limpiar() {
        $('#txtRutUsuario').val('');
        $('#txtNombreUsuario').val('');
        $('#txtApellidoUsuario').val('');
        $('#txtFecNacimiento').val('');
        $('#txtCorreoElectronico').val('');
        $('#txtTelUsuario').val('');
        $('#txtPassword').val('');
        $('#txtPassword2').val('');
    }
</script>
