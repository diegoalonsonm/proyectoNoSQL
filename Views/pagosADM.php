<?php require __DIR__ . '/../vendor/autoload.php';
include('plantilla.php');
if (!$usuario_logueado || $id_rol != 1) {
  header('Location: index.php'); // Redirigir al inicio o a una página de acceso denegado
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css">        
  <link rel="stylesheet" href="plugins/toastr/toastr.css">
  <title>Pagos</title>
  <style> 
    table.dataTable td, table.dataTable th {
      color: white !important; /* Color de texto blanco */
      text-align: center;
      vertical-align: middle;
    }
    </style>
</head>
<br><br><br>
<body style="background-color: #000; color: white;">
  <br><br><br>
    <div class="col-md-12 text-center">
      <div class="card card-light" style="background-color: rgba(51, 51, 51, 0.8); color: white; border-radius: 8px;">
        <div class="card-header" style="background-color: rgba(51, 51, 51, 0.8); color: white;">
          <h1 class="card-title" style="text-align: center">Listado de Pagos</h1>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
          <div class="row mt-2">
            <div class="col-md-1"></div>
            <div class="col-md-10">
              <table id="tbllistado" class="table table-striped table-bordered table-hover" style="background-color: rgba(167, 167, 167, 0.8); color: white !important;">
                <thead style="background-color: rgba(51, 51, 51, 0.8);">
                  <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Cancha</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>MontoTotal</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Cancha</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>MontoTotal</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <div class="col-md-1"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br>
  <br>
  <div>

</script>
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="plugins/DataTables/datatables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap4.min.js"></script>
  <script src="plugins/bootbox/bootbox.min.js"></script>
  <script src="plugins/toastr/toastr.js"></script>
  <script src="assets/js/pagos.js"></script>
</body>
</html>