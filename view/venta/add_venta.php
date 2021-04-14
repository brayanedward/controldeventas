<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Registrar Ventas </h4>
                        <ol class="breadcrumb p-0 m-0">
                            <li>
                                <a href="#">Mantenedores</a>
                            </li>
                            <li class="active">
                                Registro de ventas
                            </li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="portlet">
                        <div class="portlet-heading bg-info">
                            <h3 class="portlet-title">
                                DATOS VENTA
                            </h3>
                            <div class="portlet-widgets">
                                <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                                <span class="divider"></span>
                                <a data-toggle="collapse" data-parent="#accordion1" href="#ventas"><i
                                        class="ion-minus-round"></i></a>
                                <span class="divider"></span>
                                <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div id="ventas" class="panel-collapse collapse in">
                            <div class="portlet-body">
                                <div class="form-group col-lg-6">
                                    <label for="txtValorventa">Valor Venta</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="zmdi zmdi-money"></i></span>
                                        <input type="number" id="txtValorventa" name="txtValorventa"
                                            class="form-control" placeholder="" maxlength="9">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="txtFechaventa">Fecha Venta</label>
                                    <input type="date" id="txtFechaventa" name="txtFechaventa" class="form-control"
                                        placeholder="">
                                </div>

                                <div class="form-group col-lg-6">
                                    <label for="txtNombrecventa">Nombres Cliente Venta</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="zmdi zmdi-account-box-o"></i></span>
                                        <input type="text" id="txtNombrecventa" name="txtNombrecventa"
                                            class="form-control" placeholder="Ingrese los Nombres de Cliente"
                                            maxlength="500">
                                    </div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label for="txtDireccioventa">Dirección Venta</label>
                                    <input type="text" id="txtDireccioventa" name="txtDireccioventa"
                                        class="form-control" placeholder="Ingrese Direccion de la Venta"
                                        maxlength="500">
                                </div>
                                <br>
                                <label for="txtCorreoElectronico">Tipo de Pago</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="zmdi zmdi-card"></i></span>
                                    <select id="selTipopago" name="selTipopago" class="form-control" required="">
                                        <option>SELECCIONE ... </option>
                                        <?php foreach ($this->model->listaPagos() as $rowPago) : ?>
                                        <option value="<?php echo $rowPago['id_tipopago'] ?>">
                                            <?php echo $rowPago['descripcion_tipopago'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="txtDetalleventa">Detalle Venta</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="zmdi zmdi-border-color"></i></span>
                                        <textarea class="form-control" name="txtDetalleventa" id="txtDetalleventa" rows="3" style="width:100%;"  maxlength="500"></textarea>
                                    </div>
                                </div>
                                <br>
                                <button type="button" onclick="grabar()" class="btn btn-info btn-round"><i class="zmdi zmdi-floppy"></i> Guardar</button>
                                <a href="<?php echo $this->urlhome; ?>"> <button type="button" class="btn btn-danger btn-round"><i class="zmdi zmdi-long-arrow-return"></i> Volver</button></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div> <!-- end row -->
        </div> <!-- container -->
    </div> <!-- content -->
</div>

<script type="text/javascript">
$('.form-control').maxlength({
    alwaysShow: true,
    threshold: 10,
    warningClass: "label label-success",
    limitReachedClass: "label label-danger",
    placement: 'bottom',
    separator: ' / '
});

//vlida el rut
$('input[name="txtRutUsuario"]').Rut({
    on_error: function() {
        $('button[type="submit"]').attr("disabled", true);
        $('button.btnlogin').html('Ops! Rut incorrecto');
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
            $.notify({
                // options
                message: 'Las Contraseñas no Coinciden'
            }, {
                // settings
                type: 'danger'
            });
        }
    } else {
        errores = 0;
    }
}

$('input[name="txtRutUsuario"]').Rut({
    on_error: function() {
        $('button[type="submit"]').attr("disabled", true);
        alertify.error('Run Incorrecto');
    },
    on_success: function() {
        $('button[type="submit"]').attr("disabled", false);
        alertify.success('Run Correcto');
    },
    format_on: 'keyup'
});

function grabar() {

    if (validacionesUsu() == '') {
        $.ajax({
            data: {
                "txtRutUsuario": $('#txtRutUsuario').val(),
                "txtNombreUsuario": $('#txtNombreUsuario').val(),
                "txtApellidoP": $('#txtApellidoP').val(),
                "txtApellidoM": $('#txtApellidoM').val(),
                "txtPassword": $('#txtPassword').val()
            },
            url: "<?php echo $this->urlsave; ?>",
            type: "POST",
            cache: false,
            dataType: "html",
            contentType: "application/x-www-form-urlencoded",
            beforeSend: function() {
                $('.message').html(
                    '<div class="sk-wave"> <div class="sk-rect sk-rect1"></div> <div class="sk-rect sk-rect2"></div> <div class="sk-rect sk-rect3"></div> <div class="sk-rect sk-rect4"></div> <div class="sk-rect sk-rect5"></div> </div>'
                );
            },
            success: function(respuesta) {
                if (respuesta == 1) {
                    alertify.success('Guardado Exitosamente!');
                    limpiar();
                    setTimeout(() => {
                        window.location.href = '<?php echo $this->urlhome; ?>';
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