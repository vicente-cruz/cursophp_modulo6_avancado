<?php require 'config.php'; ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Classificados</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0" />
        <script type="text/javascript" src="../assets/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="../assets/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="assets/js/script.js"></script>
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/css/style.css" />
    </head>
    <body>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="./" class="navbar-brand">Classificados</a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <?php if (isset($_SESSION['cLogin']) && ( ! empty($_SESSION['cLogin']))): ?>
                        <li><a href="">Bem vindo <?php echo $_SESSION['nome']; ?></a></li>
                        <li><a href="meus-anuncios.php">Meus anúncios</a></li>
                        <li><a href="sair.php">Sair</a></li>
                    <?php else: ?>
                        <li><a href="cadastre-se.php">Cadastre-se</a></li>
                        <li><a href="login.php">Login</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>