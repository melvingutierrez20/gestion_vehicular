<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | ChartJS</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
  <link href="https://cdn.datatables.net/v/dt/dt-2.1.7/datatables.min.css" rel="stylesheet">
    <title>Lista de vehiculos</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<link rel="stylesheet" href="../../../../../css/tabla_persona.css">

<style>
.card-body {
    padding: 20px; /* Espacio interior del contenedor */
    min-height: 600px; /* Altura mínima del cuadro */
    overflow: visible; /* Mostrar el contenido completo */
}

.table-container {
    width: 100%; /* Asegura que el contenedor ocupe todo el ancho */
    overflow-x: auto; /* Permite el desplazamiento horizontal solo cuando sea necesario */
    padding-bottom: 20px; /* Añade espacio debajo de la tabla */
}

.card {
    margin: 20px auto; /* Centra la tarjeta */
    width: 100%; /* Asegura que la tarjeta ocupe todo el ancho de la pantalla */
}


th, td {
    text-align: center;
    vertical-align: middle;
    white-space: nowrap; /* Mantiene el texto en una sola línea */
    overflow: hidden; /* Evita que el texto se desborde */
    text-overflow: ellipsis; /* Añade "..." al final si el texto es muy largo */
}

th {
    min-width: 100px; /* Ancho mínimo para las columnas */
}

td {
    min-width: 120px; /* Ancho mínimo para las celdas */
}

.btn {
    padding: 5px 10px; /* Tamaño cómodo para los botones */
}


</style>

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->

    <!-- Right navbar links -->

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="http://localhost/gestion_vehicular/vendor/almasaeed2010/adminlte/" class="brand-link">
      <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Gestion Vehicular</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="http://localhost/gestion_vehicular/vendor/almasaeed2010/adminlte/" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="fas fa-database"></i>
              <p>
                Registros
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./persona.php" class="nav-link">
                  <i class="fas fa-users"></i>
                  <p>Personas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./vehiculos.php" class="nav-link">
                  <i class="fas fa-car"></i>
                  <p>Carros</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./motos.php" class="nav-link">
                  <i class="fas fa-motorcycle"></i>
                  <p>Motos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="fas fa-receipt"></i>
                  <p>Multas</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-user"></i>
              <p>
                Usuarios
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./usuarios.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Datos Usuarios</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
  

    <!-- Main content -->

      
    <div class="container mt-4">
    <div class="text-center mb-4">
        <h2>Lista de Vehiculos</h2>
    </div>

    <div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-end mb-3">
            <a href="../../../../../vistas/agregar_vehiculo.php" class="btn custom-btn">
                <i class="fas fa-plus"></i> Agregar Nuevo Vehículo
            </a>
        </div>

        <div class="table-responsive table-container">
        <table id="esquelasTable" class="table table-sm table-hover table-bordered text-center w-100 table-striped">
    <thead class="thead">
        <tr>
            <th>Placa del Vehículo</th>
            <th>Descripción</th>
            <th>Monto</th>
            <th>Estado</th>
            <th>Editar</th>
        </tr>
    </thead>
    <tbody>
    <?php
    require_once '../../../../../conexion_db/conexion.php';
    $dbConn = new DatabaseConnection();
    $db = $dbConn->Connect();
    
    // Colección de esquelas y vehículos
    $esquelasCollection = $db->esquelas;
    $vehiculosCollection = $db->vehiculos;
    
    // Obtener todas las esquelas
    $esquelas = $esquelasCollection->find();

    foreach ($esquelas as $esquela) {
        // Obtener la placa del vehículo asociado a la esquela
        $vehiculo = $vehiculosCollection->findOne(['_id' => $esquela['vehiculo_id']]);

        // Verifica que el vehículo existe
        if ($vehiculo) {
            echo "<tr>";
            echo "<td>{$vehiculo['placa']}</td>";
            echo "<td>{$esquela['descripcion']}</td>";
            echo "<td>\${$esquela['monto']}</td>";
            echo "<td>{$esquela['estado']}</td>";
            
            // Si la esquela ya está pagada, deshabilitar el botón de editar
            if ($esquela['estado'] === 'pagada') {
                echo "<td class='text-center'>
                        <button class='btn btn-secondary btn-sm' disabled>
                            <i class='fas fa-check-circle'></i> Pagada
                        </button>
                      </td>";
            } else {
                echo "<td class='text-center'>
                        <button class='btn btn-success btn-sm editEsquelaBtn' data-id='{$esquela['_id']}'>
                            <i class='fas fa-edit'></i> Editar Estado
                        </button>
                      </td>";
            }
            echo "</tr>";
        }
    }
    ?>
    </tbody>
</table>



        </div>
    </div>
</div>

</div>

</div>

</div>

</div>

</div>

</div>

<!-- JS and DataTable dependencies -->




    </section>
    <!-- /.content -->
  </div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Add Content Here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../../plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page specific script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/v/dt/dt-2.1.7/datatables.min.js"></script>
<script src="../../../../../js/vehiculo/editar_vehiculo.js"></script>
<script src="../../../../../js/vehiculo/eliminar_vehiculo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    $(document).ready(function() {
        $('#esquelasTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                "search": "Buscar:",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });
    });
</script>
<script>
$(document).ready(function() {
    // Asignar evento para el botón de Editar
    $('.editEsquelaBtn').on('click', function() {
        var id = $(this).data('id'); // Obtener el ID de la esquela

        // Mostrar SweetAlert para cambiar el estado solo a 'pagada'
        Swal.fire({
            title: 'Cambiar estado a "Pagada"',
            text: "¿Estás seguro de que deseas marcar esta esquela como pagada?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, marcar como pagada',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Hacer solicitud AJAX para actualizar solo el estado a 'pagada'
                $.ajax({
                    url: '/gestion_vehicular/controladores/actualizar_esquela.php',
                    type: 'POST',
                    data: {
                        id: id,  // ID de la esquela
                        estado: 'pagada'  // Cambiar a 'pagada'
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire('Éxito', 'El estado de la esquela ha sido actualizado a "pagada".', 'success').then(() => {
                                location.reload(); // Recargar la página para ver los cambios
                            });
                        } else {
                            Swal.fire('Error', response.message, 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'Hubo un problema al actualizar el estado de la esquela.', 'error');
                    }
                });
            }
        });
    });
});
</script>


<script>
  $(document).ready(function() {
    // Asignar evento para el botón de Editar
    $('.editBtn').on('click', function() {
        var id = $(this).data('id'); // Obtener el ID desde el botón
        // Redirigir a la página de editar
        window.location.href = '../../../../../vistas/editar_vehiculo.php?id=' + id;
    });
});

</script>
</body>
</html>
