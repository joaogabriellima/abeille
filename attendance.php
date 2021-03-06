<?php
    include('api/login_verify.php');
    include_once('api/conexao.php');

    if (!isset($_SESSION['attendance_on_progress'])) {
        header('Location: ../../abeille/index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Abeille</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="custom_css/custom.css" rel="stylesheet">
    <link href="js/sweetalert2.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                </div>
                <div class="sidebar-brand-text mx-3">Abeille</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Atendimento</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Funções
            </div>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Gestão</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Selecione a opção:</h6>
                        <a class="collapse-item" href="userspage.php">Funcionários</a>
                        <a class="collapse-item" href="attendance_hist.php">Atendimentos</a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider d-none d-md-block">            
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <?php include 'header.php'; ?>

            <div class="container-fluid">

                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h3 class="h4 mb-0 text-gray-800">Atendimento ao cliente em andamento</b></h3>
                    <button id="finish_attendance" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm btn-danger">
                        <i class="fas fa-user fa-sm text-white-50"></i> Finalizar Atendimento
                    </button>
                </div>


                <div class="card-header py-3">
              
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Senha</th>
                      <th>Atendente</th>
                      <th>Status</th>
                      <th>Horário de Início</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                    $attendanceId = $_SESSION['attendance_id'];
                    $query = "SELECT * FROM attendance a INNER JOIN users u ON a.id_user = u.id INNER JOIN status s ON s.id = a.status WHERE a.id = $attendanceId";
                    $result = mysqli_query($conexao, $query);

                    while($row = mysqli_fetch_array($result))
                    {
                      echo "<tr>";
                      echo "<td>".$row['queue_number']."</td>";
                      echo "<td>".$row['full_name']."</td>";
                      echo "<td>".$row['name']."</td>";
                      echo "<td>".$row['start_time']."</td>";
                      echo "</tr>";
                    }
                  ?>
                  </tbody>
                </table>
              </div>
            </div>

            <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Abeille 2019</span>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Deseja mesmo sair?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
                </div>
                <div class="modal-body">Clique em "Sair" abaixo para finalizar a sessão atual!</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="api/logout.php">Sair</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script src="scripts/index.js" type="text/javascript"></script>
    <script src="scripts/users.js" type="text/javascript"></script>
    <script src="plugins/jquery.mask.min.js" type="text/javascript"></script>
    <script src="plugins/loader/jquery.loadingModal.min.js" type="text/javascript"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</body>
</html>