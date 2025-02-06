<?php require 'header.php'; ?>
<!-- Contenido -->
<div class="content-wrapper">        
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h1 class="box-title">
                            Usuario 
                            
                        </h1>
                        <button class="btn btn-success pull-right" id="btnagregar" onclick="mostrarform(true)">
                                <i class="fa fa-plus-circle"></i> Agregar
                            </button>
                    </div>
                    <!-- Listado de Usuarios -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Acciones</th>
                                    <th>Nombre</th>
                                    <th>Documento</th>
                                    <th>Número</th>
                                    <th>Teléfono</th>
                                    <th>Email</th>
                                    <th>Login</th>
                                    <th>Foto</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <th>Acciones</th>
                                    <th>Nombre</th>
                                    <th>Documento</th>
                                    <th>Número</th>
                                    <th>Teléfono</th>
                                    <th>Email</th>
                                    <th>Login</th>
                                    <th>Foto</th>
                                    <th>Estado</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Formulario de Usuario -->
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="idusuario" id="idusuario">

                            <div class="form-group col-lg-12">
                                <label>Nombre (*):</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" maxlength="100" placeholder="Nombre" required>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Tipo Documento (*):</label>
                                <select class="form-control select-picker" name="tipo_documento" id="tipo_documento" required>
                                    <option value="DNI">DNI</option>
                                    <option value="LICENCIA">Licencia</option>
                                    <option value="PASAPORTE">Pasaporte</option>
                                </select>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Número (*):</label>
                                <input type="text" class="form-control" name="num_documento" id="num_documento" maxlength="20" placeholder="Número de documento" required>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Dirección:</label>
                                <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Dirección" maxlength="70">
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Teléfono:</label>
                                <input type="text" class="form-control" name="telefono" id="telefono" maxlength="20" placeholder="Teléfono">
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Email:</label>
                                <input type="email" class="form-control" name="email" id="email" maxlength="50" placeholder="Email">
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Cargo:</label>
                                <input type="text" class="form-control" name="cargo" id="cargo" maxlength="20" placeholder="Cargo">
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Login (*):</label>
                                <input type="text" class="form-control" name="login" id="login" maxlength="20" placeholder="Login" required>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Clave (*):</label>
                                <input type="password" class="form-control" name="clave" id="clave" maxlength="64" placeholder="Clave" required>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Imagen:</label>
                                <input type="file" class="form-control" name="imagen" id="imagen">
                                <input type="hidden" name="imagenactual" id="imagenactual">
                                <img src="" width="150px" height="120px" id="imagenmuestra" style="display: none; border: 1px solid #ddd;">
                            </div>

                            <div class="form-group col-lg-12">
                                <button class="btn btn-primary" type="submit" id="btnGuardar">
                                    <i class="fa fa-save"></i> Guardar
                                </button>
                                <button class="btn btn-danger" type="button" onclick="cancelarform()">
                                    <i class="fa fa-arrow-circle-left"></i> Cancelar
                                </button>
                            </div>
                        </form>
                    </div>

                </div> <!-- /.box -->
            </div> <!-- /.col -->
        </div> <!-- /.row -->
    </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->

<?php require 'footer.php'; ?>

<!-- Scripts -->
<script src="scripts/usuario.js"></script>
<script>
$(document).ready(function() {
    if (!$.fn.DataTable.isDataTable("#tbllistado")) {
        $('#tbllistado').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true
        });
    }
});
</script>
