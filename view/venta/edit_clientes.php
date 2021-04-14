<!--TRADUCCION MENSAJE JQUERY VALIDATE -->
<script type="text/javascript">


    $(document).ready(function() {
    jQuery.extend(jQuery.validator.messages, {
    required: "Este campo es obligatorio.",
    remote: "Por favor, rellena este campo.",
    email: "Por favor, escribe una dirección de correo válida",
    url: "Por favor, escribe una URL válida.",
    date: "Por favor, escribe una fecha válida.",
    dateISO: "Por favor, escribe una fecha (ISO) válida.",
    number: "Por favor, escribe un número entero válido.",
    digits: "Por favor, escribe sólo dígitos numéricos.",
    creditcard: "Por favor, escribe un número de tarjeta válido.",
    equalTo: "Por favor, escribe el mismo valor de nuevo.",
    accept: "Por favor, escribe un valor con una extensión aceptada.",
    lettersonly: "Por favor, escribe solo letras válidas.",
    maxlength: jQuery.validator.format("Por favor, no escribas más de {0} caracteres."),
    minlength: jQuery.validator.format("Por favor, no escribas menos de {0} caracteres."),
    rangelength: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1} caracteres."),
    range: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1}."),
    max: jQuery.validator.format("Por favor, escribe un valor menor o igual a {0}."),
    min: jQuery.validator.format("Por favor, escribe un valor mayor o igual a {0}.")
    });
    });

</script>
<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Editar Cliente</h4>
                        <ol class="breadcrumb p-0 m-0">
                            <li>
                                <a href="#">Cliente</a>
                            </li>
                            <li class="active">
                                Editar Cliente
                            </li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <!--DESDE ACABA ABAJO -->
                <?php foreach ($this->model->infoClienteCompleta() as $rows) : ?> 

                <form class="form" id="formAEditCliente" name="formAEditCliente" method="POST">
                <div class="row">
                        <div class="col-lg-12">
                                <div class="portlet">
                                    <div class="portlet-heading bg-info">
                                        <h3 class="portlet-title">
                                            DATOS PERSONALES
                                        </h3>
                                        <div class="portlet-widgets">
                                            <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                                            <span class="divider"></span>
                                            <a data-toggle="collapse" data-parent="#accordion1" href="#seccionDatosPersonal"><i class="ion-minus-round"></i></a>
                                            <span class="divider"></span>
                                            <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div id="seccionDatosPersonal" class="panel-collapse collapse in">
                                        <div class="portlet-body">
                                                
                                                <div class="form-group col-lg-6"">
                                                    <label for="txtRutCliente">Rut Cliente (No Editable)</label>
                                                    <input type="text" id="txtRutCliente" name="txtRutCliente" class="form-control" placeholder="Ingrese el Rut del Cliente" maxlength="12" value="<?php echo $rows['rut_cliente'] ?>-<?php echo $rows['dv_cliente'] ?>" disabled>
                                                </div>
                                                <div class="form-group col-lg-6"">
                                                    <label for="txtNombreCliente">Nombres Cliente</label>
                                                    <input type="text" id="txtNombreCliente" name="txtNombreCliente" class="form-control" placeholder="Ingrese los Nombres de Cliente" maxlength="500" value="<?php echo $rows['nombres_cliente'] ?>">
                                                </div>
                                                
                                                <div class="form-group col-lg-6"">
                                                    <label for="txtPaternoCliente">Apellido Paterno</label>
                                                    <input type="text" id="txtPaternoCliente" name="txtPaternoCliente" class="form-control" placeholder="Ingrese el Apellido Paterno" maxlength="500" value="<?php echo $rows['apellidop_cliente'] ?>">
                                                </div>
                                                
                                                <div class="form-group col-lg-6"">
                                                    <label for="txtMaternoCliente">Apellido Materna</label>
                                                    <input type="text" id="txtMaternoCliente" name="txtMaternoCliente" class="form-control" placeholder="Ingrese el Apellido Materno" maxlength="500" value="<?php echo $rows['apellidom_cliente'] ?>">
                                                </div>
                                                 <div class="form-group">
                                                        <label for="selectSexo">Sexo</label>
                                                        <select id="selectSexo" name="selectSexo" class="form-control" required="">
                                                            <option>SELECCIONE ... </option>
                                                        <?php foreach ($this->modelSexo->lista() as $rowsp) :?> 

                                                            <?php if($rows['id_sexo'] == $rowsp['id_sexo']){
                                                            ?>
                                                                <option value="<?php echo $rowsp['id_sexo'] ?>" selected><?php echo $rowsp['descripcion_sexo'] ?></option>
                                                            <?php } else{?>
                                                                <option value="<?php echo $rowsp['id_sexo'] ?>"><?php echo $rowsp['descripcion_sexo'] ?></option>
                                                             <?php }  ?>   
                                                        <?php endforeach; ?>
                                                        </select>
                                                </div>
                                                <br>
                                                <label for="txtFecNacimiento">Fecha Nacimiento</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i> </span>
                                                    <input type="date" id="txtFecNacimiento" name="txtFecNacimiento" class="form-control datepicker" placeholder="Ej: 30/07/2016" value="<?php echo $rows['fechanac_cliente2'] ?>">
                                                </div>
                                                <br>
                                                
                                                <label for="txtCantidadHijos">Cantidad Hijos</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="zmdi zmdi-face"></i></span>
                                                    <input type="text" id="txtCantidadHijos" name="txtCantidadHijos" class="form-control" placeholder="Ej: 5" maxlength="2" value="<?php echo $rows['hijos_cliente'] ?>">
                                                </div>
                                                <br>
                                                <label for="txtTelCliente">Telefono Cliente</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="zmdi zmdi-phone"></i></span>
                                                    <input type="text" id="txtTelCliente" name="txtTelCliente" class="form-control" placeholder="Ingrese el Telefono" maxlength="10" value="<?php echo $rows['telefono_cliente'] ?>">
                                                </div>
                                                <br>
                                                <label for="txtCorreoElectronico">Correo Electronico</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>
                                                    <input type="text" id="txtCorreoElectronico" name="txtCorreoElectronico" class="form-control email" placeholder="Ej: ejemplo@gmail.com" maxlength="50" value="<?php echo $rows['correo_cliente'] ?>">
                                                </div>
                                                
                                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="portlet">
                                    <div class="portlet-heading bg-info">
                                        <h3 class="portlet-title">
                                            DIRECCIÓN
                                        </h3>
                                        <div class="portlet-widgets">
                                            <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                                            <span class="divider"></span>
                                            <a data-toggle="collapse" data-parent="#accordion1" href="#seccionDireccion"><i class="ion-minus-round"></i></a>
                                            <span class="divider"></span>
                                            <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div id="seccionDireccion" class="panel-collapse collapse in">
                                        <div class="portlet-body">
                                                <label for="txtDireccionCliente">Calle</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="zmdi zmdi-home zmdi-hc-fw"></i></span>
                                                    <input type="text" id="txtDireccionCliente" name="txtDireccionCliente" class="form-control" placeholder="Ej: AV. LOS CARRERAS" maxlength="100" value="<?php echo $rows['direccion_cliente'] ?>">
                                                </div>
                                                <br>
                                                <label for="txtNumeroCasa">Número de Casa</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="zmdi zmdi-n-1-square"></i></span>
                                                    <input type="text" id="txtNumeroCasa" name="txtNumeroCasa" class="form-control" placeholder="Ej: 322" maxlength="10" value="<?php echo $rows['numcasa_cliente'] ?>">
                                                </div>
                                                <br>
                                                <label for="comuna">Comuna</label>
                                                <div class="form-group "> 
                                                        <select id="comuna" name="comuna" class="form-control" required="">
                                                            <option value="0">SELECCIONE ... </option>
                                                        <?php foreach ($this->modelComuna->lista() as $rowsp) :?> 

                                                            <?php if($rows['id_comuna'] == $rowsp['id_comuna']){
                                                            ?>
                                                                <option value="<?php echo $rowsp['id_comuna'] ?>" selected><?php echo $rowsp['descripcion_comuna'] ?></option>
                                                            <?php } else{?>
                                                                <option value="<?php echo $rowsp['id_comuna'] ?>"><?php echo $rowsp['descripcion_comuna'] ?></option>
                                                             <?php }  ?>   
                                                        <?php endforeach; ?>
                                                        </select>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          
                            <div class="col-lg-12">
                                <div class="portlet">
                                    <div class="portlet-heading bg-info">
                                        <h3 class="portlet-title">
                                            FONDO DE PENSIONES
                                        </h3>
                                        <div class="portlet-widgets">
                                            <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                                            <span class="divider"></span>
                                            <a data-toggle="collapse" data-parent="#accordion1" href="#seccionPrevisional"><i class="ion-minus-round"></i></a>
                                            <span class="divider"></span>
                                            <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <?php if($rows['idprev_cliente']  == 1){
                                            $check1 = 'checked';
                                            $check2='';

                                                }else{
                                                        $check1 = '';
                                                        $check2='checked';
                                                } ?>
                                    <div id="seccionPrevisional" class="panel-collapse collapse in">
                                        <div class="portlet-body col-lg-12">
                                            <div class="form-group col-lg-4">
                                                <label for="tipoPrevision">Fondo de Pensión</label>
                                                    <div class="radio">
                                                        <input type="radio" name="tipoPrevision" id="isapre" value="2" required="" data-parsley-multiple="tipoPrevision" <?php echo $check1; ?>>
                                                        <label for="isapre">
                                                            IPS
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" name="tipoPrevision" id="fonasa" value="1" data-parsley-multiple="tipoPrevision" <?php echo $check1; ?>>
                                                        <label for="fonasa">
                                                            AFP
                                                        </label>
                                                    </div>
                                             </div>

                                             <div class="form-group col-lg-4">
                                                        <label for="detTipoPrevision">Detalle de Fondo</label>
                                                        <select id="detTipoPrevision" name="detTipoPrevision" class="form-control" required="">
                                                            <option>SELECCIONE ... </option>
                                                        <?php foreach ($this->modelTipoPrevision->lista($rows['idprev_cliente'] ) as $rowsp) :

                                                             if($rows['id_tipoprevison'] == $rowsp['id_tipoprevison']){
                                                            ?>
                                                                <option value="<?php echo $rowsp['id_tipoprevision'] ?>" selected><?php echo $rowsp['descripcion_tipoprevision'] ?></option>
                                                            <?php } else{?>
                                                                <option value="<?php echo $rowsp['id_tipoprevision'] ?>"><?php echo $rowsp['descripcion_tipoprevision'] ?></option>
                                                             <?php }  ?>   
                                                        <?php endforeach; ?>
                                                        </select>
                                             </div>
 
                                             <div class="form-group col-lg-4">
                                                        <label for="tipoPension">Tipo de Pensión</label>
                                                        <select id="tipoPension" name="tipoPension" class="form-control" required="">
                                                            <option value="0">SELECCIONE ... </option>
                                                         <?php foreach ($this->modelTipoPension->lista( ) as $rowsp) :?> 

                                                            <?php if($rows['id_tipopension'] == $rowsp['id_tipopension']){
                                                            ?>
                                                                <option value="<?php echo $rowsp['id_tipopension'] ?>" selected><?php echo $rowsp['descripcion_tipopension'] ?></option>
                                                            <?php } else{?>
                                                                <option value="<?php echo $rowsp['id_tipopension'] ?>"><?php echo $rowsp['descripcion_tipopension'] ?></option>
                                                             <?php }  ?>   
                                                        <?php endforeach; ?>
                                                        </select>
                                             </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <?php endforeach; ?>
                              
                </div>
                <div class="row">
                      <div class="form-group">

                            <button  style="margin-left:10px;" type="submit" class="btn btn-info btn-round btnSave" onclick="guardar()"><i class="zmdi zmdi-floppy"></i> Actualizar Cliente </button>
                                <a href="<?php echo $this->urlhome; ?>"> <button type="button" class="btn btn-danger btn-round"><i class="zmdi zmdi-long-arrow-return"></i> Volver</button></a>
                                <button type="button" onclick ="limpiar();" class="btn btn-danger btn-round"><i class="zmdi zmdi-delete"></i> Limpiar</button></a>
                     </div>
                </div>
              
            <!--DESDE ACA ARRIBA -->
            </div>
            <!-- end row -->
        </div> <!-- container -->
    </div> <!-- content -->

</div>

<script type="text/javascript">



//VALIDACION DE RUT

$('input#txtRutCliente').Rut({
        on_error: function(){
            $('button[type="submit"]').attr("disabled", true);
            $('button.btnSave').html('Ops! Rut incorrecto');
        },
        on_success:  function(){
            $('button[type="submit"]').attr("disabled", false);
            $('button.btnSave').html('<i class="zmdi zmdi-floppy"></i> Actualizar Cliente');

        },
        format_on: 'keyup'
});


$('.form-control').maxlength({
        alwaysShow: true,
        threshold: 10,
        warningClass: "label label-success",
        limitReachedClass: "label label-danger",
        placement: 'bottom',
        separator: ' / '
    });


    $('.chosen-select').chosen();
    $('.chosen-select-deselect').chosen({
        allow_single_deselect: true
    });

    //carga select de prevision
$("input[name=tipoPrevision]").click(function(){

         $("#detTipoPrevision").empty('');
         var condicionTipo = $('input:radio[name=tipoPrevision]:checked').val();
         var htmlPrevision = '';
         htmlPrevision = '<option>SELECCIONE ... </option>';
        if(condicionTipo == 2){
            <?php foreach ($this->modelTipoPrevision->lista($condicion=2) as $rowsp) : ?>
            htmlPrevision += '<option value="<?php echo $rowsp['id_tipoprevision'] ?>"><?php echo $rowsp['descripcion_tipoprevision'] ?></option>';
            <?php endforeach; ?>
        }
         else{
            <?php foreach ($this->modelTipoPrevision->lista($condicion=1) as $rowsp) : ?>
            htmlPrevision += '<option value="<?php echo $rowsp['id_tipoprevision'] ?>"><?php echo $rowsp['descripcion_tipoprevision'] ?></option>';
            <?php endforeach; ?>
         }

        $("#detTipoPrevision").append(htmlPrevision);

});

// VALIDACIONES CON JQUERY VALIDATE
$("#formAEditCliente").validate({
        rules:{
            
          txtFecNacimiento:{
            date: true,
            required: true 
          },
          txtTelCliente:{
            digits: true,
            required: true 
          },
          txtDireccionCliente:{
            required: true
          },
          txtNumeroCasa:{
            required: true,
            digits:true
          },
          txtCantidadHijos:{
            required: true,
            digits:true
          },
            tipoPension:{min:1
            },
            detTipoPrevision:{min:1
            },
             selectSexo:{min:1
            }
            ,
             comuna:{min:1
            }
        
        },
        messages :{
            
            tipoPension: { minlength: "Seleccione un tipo de Pensión" }
            ,
            detTipoPrevision:{
                minlength: "Seleccione un Tipo de Previsión"
            }
        }
    });
    


function guardar(){

    $.ajax({
                data: {
                    "txtRutCliente": $('#txtRutCliente').val(),
                    "txtNombreCliente": $('#txtNombreCliente').val(),
                    "txtPaternoCliente": $('#txtPaternoCliente').val(),
                    "txtMaternoCliente": $('#txtMaternoCliente').val(),
                    "txtFecNacimiento": $('#txtFecNacimiento').val(),
                    "txtTelCliente": $('#txtTelCliente').val(),
                    "txtCorreoElectronico": $('#txtCorreoElectronico').val(),
                    "txtDireccionCliente": $('#txtDireccionCliente').val(),
                    "txtNumeroCasa": $('#txtNumeroCasa').val(),
                    "tipoPrevision" : $('input:radio[name=tipoPrevision]:checked').val(),
                    "detTipoPrevision" : $("#detTipoPrevision").val(),
                    "tipoPension": $('#tipoPension').val(),
                    "selectSexo" : $('#selectSexo').val(),
                    "hijos" : $("#txtCantidadHijos").val(),
                    "comuna" : $("#comuna").val()
                },

                url: "<?php echo $this->urlupdate; ?>",
                type: "POST",
                cache: false,
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                beforeSend: function() {
                    $('.message').html('<div class="sk-wave"> <div class="sk-rect sk-rect1"></div> <div class="sk-rect sk-rect2"></div> <div class="sk-rect sk-rect3"></div> <div class="sk-rect sk-rect4"></div> <div class="sk-rect sk-rect5"></div> </div>');
                },
                success: function(respuesta) {
                    if (respuesta == 1) {
                        swal({
                                title: "Transacción Exitosa", 
                                text: "Cliente actualizado correctamente.", 
                                type: "success"
                            },
                            function () {
                              location.href= '<?php echo $this->urlhome ?>';
                            });
                    } else {
                        swal({
                                title: "Error en la Transacción", 
                                text: "Ocurrio un problema en la transacción o el rut ya esta registrado.", 
                                type: "warning"
                            });
                    }
                }
            });
            return false;
}

    function limpiar(){
        $('#formAEditCliente')[0].reset();
        swal("Limpiando", "El formulario fue reiniciado correctamente", "success");
    }


</script>