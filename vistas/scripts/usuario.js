var tabla;

// Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function (e) {
        guardaryeditar(e);
    });

    $("#imagenmuestra").hide();

    // Mostramos los permisos
    $.post("../ajax/usuario.php?op=permisos&id=", function (r) {
        $("#permisos").html(r);
    });
}

// Función para limpiar los campos del formulario
function limpiar() {
    $("#nombre").val("");
    $("#num_documento").val("");
    $("#direccion").val("");
    $("#telefono").val("");
    $("#email").val("");
    $("#cargo").val("");
    $("#login").val("");
    $("#clave").val("");
    $("#imagenmuestra").attr("src", "");
    $("#imagenactual").val("");
    $("#usuario_id").val("");
}

// Función para mostrar formulario
function mostrarform(flag) {
    limpiar();
    if (flag) {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled", false);
        $("#btnagregar").hide();
    } else {
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
        $("#btnagregar").show();
    }
}

// Función para cancelar formulario
function cancelarform() {
    limpiar();
    mostrarform(false);
}

// Función para listar usuarios en DataTable
function listar() {
    if ($.fn.DataTable.isDataTable("#tbllistado")) {
        $("#tbllistado").DataTable().destroy(); // 🔹 Destruye la instancia previa
    }

    tabla = $("#tbllistado").DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "ajax": {
            url: '../ajax/usuario.php?op=listar',
            type: "GET",
            dataType: "json",
            error: function (e) {
                console.log("Error en la carga de datos:", e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 5,
        "order": [[0, "desc"]],
        "dom": 'Bfrtip',
        "buttons": [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdf'
        ],
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false
    });
}

// Función para guardar o editar usuario
function guardaryeditar(e) {
    e.preventDefault();
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/usuario.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function (datos) {
            bootbox.alert(datos);
            mostrarform(false);
            tabla.ajax.reload();
        }
    });
    limpiar();
}

// Función para mostrar un usuario
function mostrar(usuario_id) {
    $.post("../ajax/usuario.php?op=mostrar", { usuario_id: usuario_id }, function (data, status) {
        data = JSON.parse(data);
        mostrarform(true);

        $("#nombre").val(data.nombre);
        $("#tipo_documento").val(data.tipo_documento);
        $("#tipo_documento").selectpicker('refresh');
        $("#num_documento").val(data.num_documento);
        $("#direccion").val(data.direccion);
        $("#telefono").val(data.telefono);
        $("#email").val(data.email);
        $("#cargo").val(data.cargo);
        $("#login").val(data.login);
        $("#imagenmuestra").show();
        $("#imagenmuestra").attr("src", "../files/usuarios/" + data.imagen);
        $("#imagenactual").val(data.imagen);
        $("#usuario_id").val(data.usuario_id);
    });

    $.post("../ajax/usuario.php?op=permisos&id=" + usuario_id, function (r) {
        $("#permisos").html(r);
    });
}

// Función para desactivar usuario
function desactivar(usuario_id) {
    bootbox.confirm("¿Está seguro de desactivar el usuario?", function (result) {
        if (result) {
            $.post("../ajax/usuario.php?op=desactivar", { usuario_id: usuario_id }, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}

// Función para activar usuario
function activar(usuario_id) {
    bootbox.confirm("¿Está seguro de activar el usuario?", function (result) {
        if (result) {
            $.post("../ajax/usuario.php?op=activar", { usuario_id: usuario_id }, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}

init();
