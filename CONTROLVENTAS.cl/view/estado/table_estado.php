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
