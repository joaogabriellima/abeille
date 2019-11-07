<?php
   include('api/login_verify.php');
   include('api/permission_verify.php');
   include('api/check_attendance.php');
   include_once('api/conexao.php');
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
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
      <link rel="stylesheet" href="plugins/loader/jquery.loadingModal.min.css">
   </head>
   <body id="page-top">
      <div id="wrapper">
         <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
               <div class="sidebar-brand-icon rotate-n-15"></div>
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
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
               <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
         </ul>
         <!-- End of Sidebar -->
         <!-- Content Wrapper -->
         <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
               <?php include 'header.php'; ?>

               <div class="container-fluid">
                  <!-- Page Heading -->
                  <div class="d-sm-flex align-items-center justify-content-between mb-4">
                     <h1 class="h3 mb-0 text-gray-800">Gestão de Funcionários</h1>
                     <a href="#" id="addFunc" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                     <i class="fas fa-user fa-sm text-white-50"></i> Cadastrar Funcionário
                     </a>
                  </div>
                  <div class="card shadow mb-4">
                     <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Funcionários</h6>
                     </div>
                     <div class="card-body">
                        <div class="table-responsive">
                           <table id="table-users"></table>
                        </div>
                     </div>

                  </div>
               </div>
               <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
               <div class="container my-auto">
                  <div class="copyright text-center my-auto">
                     <span>Copyright &copy; Abeille 2019</span>
                  </div>
               </div>
            </footer>
            <!-- End of Footer -->
         </div>
         <!-- End of Content Wrapper -->
      </div>
      <!-- End of Page Wrapper -->
      <!-- Scroll to Top Button-->
      <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
      </a>
      <!-- Insert Users Modal -->
      <div class="modal fade" id="usersModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
               <div class="insertUserForm">
                  <h1 class="h3 mb-0 text-gray-800 text-center">Cadastro de Funcionário</h1>
                  <form name="userForm" id="userForm">
                     <div class="showrequire"><input type="text" id="full_name" class="form-control bg-light border-0 small" placeholder="Nome Completo" required></div>
                     <div class="showrequire"><input type="text" id="login" class="form-control bg-light border-0 small" placeholder="Login" required></div>
                     <div>
                        <input type="password" id="password" value="@abeille199" readonly class="form-control bg-light border-0 small" placeholder="Senha" required>
                        <a href="#" id="showpass" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm showpass">
                        <i class="fas fa-eye fa-sm text-white-50"></i>
                        </a>
                     </div>
                     <select id="permission" class="form-control bg-light border-0 small"></select>
                     <div class="showrequire"><input type="text" id="cpf" class="form-control bg-light border-0 small" placeholder="CPF" required></div>
                     <div class="showrequire"><input type="text" id="phone" class="form-control bg-light border-0 small" placeholder="Telefone" required></div>
                     <div class="showrequire"><input type="email" id="email" class="form-control bg-light border-0 small" placeholder="E-mail" required></div>
                     <div class="row">
                        <div class="col-md-6">
                            <input type="file" id="picture" accept=".jpg, .png" required>
                        </div>
                        <div class="col-md-6">
                            <a href="#" id="saveUser" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="width: 150px; margin-top: 15px;">
                                <i class="fas fa-user fa-sm text-white-50"></i> Salvar
                            </a>
                        </div>
                     </div>
                     <div class="profile-sidebar">
                        <div class="profile-userpic">
                            <img id="imgPreview" src="" class="img-responsive" alt="">
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <!-- Insert Users Modal -->
      
      <!-- Page level custom scripts -->
      <script src="js/demo/chart-area-demo.js"></script>
      <script src="js/demo/chart-pie-demo.js"></script>
      <script src="scripts/index.js" type="text/javascript"></script>
      <script src="scripts/users.js" type="text/javascript"></script>
      <script src="plugins/jquery.mask.min.js" type="text/javascript"></script>
      <script src="js/sweetalert2.all.min.js"></script>
      <script src="plugins/loader/jquery.loadingModal.min.js"></script>
   </body>
</html>