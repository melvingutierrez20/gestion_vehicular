<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | ChartJS</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
  <link href="https://cdn.datatables.net/v/dt/dt-2.1.7/datatables.min.css" rel="stylesheet">
    <title>Lista de Uusario</title>

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
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="fas fa-database"></i>
              <p>
                Registros
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
                <a href="./esquelas.php" class="nav-link">
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
                <a href="" class="nav-link">
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
        <h2>Lista de Usuarios</h2>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-end mb-3">
                <a href="../../../../../vistas/agregar_usuarios.php" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Agregar Nuevo Usuario
                </a>
            </div>

            <div class="table-responsive table-container">
                <table id="usuarioTable" class="table table-sm table-hover table-bordered text-center w-100">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nombre de Usuario</th>
                            <th>Correo</th>
                            <th>Rol</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    require_once '../../../../../conexion_db/conexion.php';
                    $dbConn = new DatabaseConnection();
                    $db = $dbConn->Connect();
                    $usuariosCollection = $db->usuarios;
                    
                    $usuarios = $usuariosCollection->find();

                    foreach ($usuarios as $usuario) {
                        echo "<tr>";
                        echo "<td>{$usuario['nombre_usuario']}</td>";
                        echo "<td>{$usuario['correo']}</td>";
                        echo "<td>{$usuario['rol']}</td>";
                        echo "<td class='text-center'>
                                <button class='btn btn-success btn-sm editBtn' data-id='{$usuario['_id']}'>
                                    <i class='fas fa-edit'></i> Editar
                                </button>
                              </td>";
                        echo "<td class='text-center'>
                                <button class='btn btn-danger btn-sm deleteBtn' data-id='{$usuario['_id']}'>
                                    <i class='fas fa-trash'></i> Eliminar
                                </button>
                              </td>";
                        echo "</tr>";
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

</div>

<!-- JS and DataTable dependencies -->




    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

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
<script src="../../../../../js/usuario/editar_usuario.js"></script>
<script src="../../../../../js/usuario/eliminar_usuario.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    $(document).ready(function() {
        $('#usuarioTable').DataTable({
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
    $('.editBtn').on('click', function() {
        var id = $(this).data('id'); // Obtener el ID desde el botón
        // Redirigir a la página de editar
        window.location.href = '../../../../../vistas/editar_usuario.php?id=' + id;
    });
});

</script>
</body>
</html>
