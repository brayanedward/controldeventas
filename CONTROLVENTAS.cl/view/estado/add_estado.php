<!--<div class="row">
    <div class="col-sm-12 tlt-header">
        <div class="page-title-box">
            <div class="btn-group pull-right">
                <ol class="breadcrumb hide-phone p-0 m-0">
                    <li class="breadcrumb-item"><a href="#">Estado</a></li>
                    <li class="breadcrumb-item"><a href="#"><?php echo $this->seccion; ?></a></li>
                    <li class="breadcrumb-item active">Agregar</li>
                </ol>
            </div>
            <h5 class="page-title"><?php echo strtoupper($this->seccion); ?></h5>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-8">
        <div class="card-box">
            <form class="form" id="form" method="POST">
            <div class="page-title-box bartlt">

                <button type="submit" class="btn-success pull-right mr-0 btnms" data-toggle="tooltip" data-original-title="Guardar">
                    <i class="fa fa-save"></i>
                </button>

                <a href="<?php echo $this->urllist; ?>">
                    <div class="btn-danger pull-right mr-0 btnms" data-toggle="tooltip" data-original-title="Cancelar">
                        <i class="fa fa-times"></i>
                    </div>
                </a>
                <a href="<?php echo $this->urladd; ?>">
                    <div class="btn-primary pull-right mr-0 btnms" data-toggle="tooltip" data-original-title="Actualizar">
                        <i class="fa fa-refresh"></i>
                    </div>
                </a>
                <h6 class="page-title tlt-table tt">FORMULARIO DE <?php echo strtoupper($this->lista); ?></h6>

            </div>




            <div class="form-row">

                <div class="form-group col-md-6">
                    <label for="descripcion" class="col-12 col-form-label">Descripción
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-12">
                        <input type="text" class="form-control" name="descripcion" placeholder="descripcion">
                    </div>
                </div>

            </div>




            </form>



            <dir class="col-12 message">
                <div class="alert alert-info" role="alert">
                    <i class="fa fa-info-circle"></i> Complete los datos del formulario.
                </div>

            </dir>


        </div>


    </div>

    <div class="col-md-4">
        <div class="card-box" id="ultimosRegistros">


        </div>


    </div>
</div>




<script type="text/javascript">

    //VALIDACION DE RUT

     $('input[name="rut"]').Rut({
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



    $("form").validate({
        rules:{
          nombre:{
            required: true,
            maxlength: 100,
            minlength: 3,
            sololetras: true 
          },
          apellido:{
            required: true,
            maxlength: 100,
            minlength: 3,
            sololetras: true
          },
          password:{
            required: true,
            maxlength: 100,
            minlength: 4
          },
          direccion:{
            required: true,
            maxlength: 200,
            minlength: 4
          },
          telefono:{
            required: true,
            maxlength: 9,
            minlength: 8,
            digits: true,
            solonumeros: true
          },
          email:{
            required: true,
            maxlength: 200,
            minlength: 4,
            email:true,
            expemail:true
          },
          codigo:{
            required: true,
            maxlength: 200,
            minlength: 4
          }
        },
        messages :{
            telefono:{
                minlength: "Ingrese solo digitos, al menos 8, maximo 9.",
            }
        }
    });

    UltimosRegistros();

    $('body').on('submit', 'form', function(event) {
        event.preventDefault();

        var formData = new FormData($('form')[0]);
        $.ajax({
            data: formData,
            url: "<?php echo $this->urlsave; ?>",
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('.message').html('<div class="sk-wave"> <div class="sk-rect sk-rect1"></div> <div class="sk-rect sk-rect2"></div> <div class="sk-rect sk-rect3"></div> <div class="sk-rect sk-rect4"></div> <div class="sk-rect sk-rect5"></div> </div>');
            },
            success: function(respuesta) {
                if (respuesta == 1) {
                    $('.message').html('<div class="alert alert-success" role="alert"><i class="fa fa-check"></i> Información ingresada correctamente.</div>');
                    $('form')[0].reset();
                    UltimosRegistros();

                } else {
                    $('.message').html('<div class="alert alert-danger" role="alert"><i class="fa fa-times"></i> Ops! Error al ingresar la información.</div>');
                }
            }
        });
        return false;
    });

    function UltimosRegistros(){
        $.ajax({
            url: "<?php echo $this->urlultimo; ?>",
            beforeSend: function() {
                $('#ultimosRegistros').html('<div class="sk-wave"> <div class="sk-rect sk-rect1"></div> <div class="sk-rect sk-rect2"></div> <div class="sk-rect sk-rect3"></div> <div class="sk-rect sk-rect4"></div> <div class="sk-rect sk-rect5"></div> </div>');
            },
            success: function(respuesta) {
                $('#ultimosRegistros').html(respuesta);
            }
        });
    }
</script>

-->

<section class="content">
<div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Mantenedor
                <small>Estado</small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Mantenedores</a></li>
                    <!--<li class="breadcrumb-item"><?php echo $this->subseccion; ?></li>-->
                    <li class="breadcrumb-item"><?php echo $this->seccion; ?></li>
                    <li class="breadcrumb-item active">Lista</li>
                </ul>
            </div>
        </div>
    </div>
<div class="container-fluid">
        <!-- Basic Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <ul class="header-dropdown">
                            <li class="">
                                <button class="btn btn-primary">AGREGAR</button>
                            </li>
                        </ul>
                        <br>
                    </div>
                    <div class="table table-hover m-b-0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-left">Código</th>
                                    <th class="text-center">Descripción</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($this->model->lista() as $rows): ?>
                                <tr>

                                    <td class="text-left"><?php echo str_pad($rows['id_estado'], 5, "0", STR_PAD_LEFT); ?></td>
                                    <td class="text-center"><?php echo $rows['descripcion_estado']; ?></td>
                                    <td class="text-center">
                                        <a href="javascript:void(0);" class="btn btn-success waves-effect waves-float waves-green"><i class="zmdi zmdi-edit"></i></a>
                                        <a href="javascript:void(0);" class="btn btn-danger waves-effect waves-float waves-red"><i class="zmdi zmdi-delete"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
