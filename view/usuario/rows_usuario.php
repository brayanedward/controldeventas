<div class="page-title-box bartlt">
    <h6 class="page-title tlt-table tt">ÚLTIMOS 10 REGISTROS</h6>
</div>
<table class="table table-condensed table-striped table-bordered">
    <thead>
        <tr>
            <th>Rut</th>
            <th>Nombre</th>
            <th>Rol</th>
        </tr>
    </thead>
    <tbody >
        <?php foreach ($this->model->lista() as $rows): ?>
        <tr>
            <td><?php echo $rows['rut_usuario'] . '-' . $rows['dv_usuario']; ?></td>
            <td><?php echo $rows['nombre_usuario'] . ' ' . $rows['apellido_usuario']; ?></td>
            <td><?php echo $rows['descripcion_rol']; ?></td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>

