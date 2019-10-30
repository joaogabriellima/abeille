<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <ul class="navbar-nav ml-auto">
        <div class="topbar-divider d-none d-sm-block"></div>
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['full_name']; ?></span>
                <img class="img-profile rounded-circle" src="<?php echo $_SESSION['picture']; ?>">
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <?php if($_SESSION['full_name'] != 'Administrator') { ?>
                    <a class="dropdown-item" href="#" data-id="<?=$_SESSION['id']?>" id="profile">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Meu Perfil
                    </a>
                <?php } ?>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>

<!-- Logout Modal-->
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

<!-- Insert Users Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="insertUserForm">
            <h1 class="h3 mb-0 text-gray-800 text-center">Profile</h1>
            <form name="userForm" id="userForm">
                <div class="showrequire"><input type="text" id="profile_full_name" class="form-control bg-light border-0 small" placeholder="Nome Completo" required></div>
                <div class="showrequire"><input type="text" id="profile_login" class="form-control bg-light border-0 small" placeholder="Login" required></div>
                <div>
                <input type="password" id="profile_password" value="@abeille199" readonly class="form-control bg-light border-0 small" placeholder="Senha" required>
                <a href="#" id="profile_showpass" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm showpass">
                <i class="fas fa-eye fa-sm text-white-50"></i>
                </a>
                </div>
                <div class="showrequire"><input type="text" id="profile_cpf" class="form-control bg-light border-0 small" placeholder="CPF" required></div>
                <div class="showrequire"><input type="text" id="profile_phone" class="form-control bg-light border-0 small" placeholder="Telefone" required></div>
                <div class="showrequire"><input type="email" id="profile_email" class="form-control bg-light border-0 small" placeholder="E-mail" required></div>
                <div class="row">
                <div class="col-md-6">
                    <input type="file" id="profile_picture" accept=".jpg, .png">
                </div>
                <div class="col-md-6">
                    <a href="#" id="profile_saveUser" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="width: 150px; margin-top: 15px;">
                        <i class="fas fa-user fa-sm text-white-50"></i> Salvar
                    </a>
                </div>
                </div>
                <div class="profile-sidebar">
                <div class="profile-userpic">
                    <img id="profile_imgPreview" src="" class="img-responsive" alt="">
                </div>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>
<!-- Insert Users Modal -->

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>
<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>
<!-- Page level custom scripts -->
<script src="scripts/profile.js" type="text/javascript"></script>