<?php

    session_start();
    if(isset($_SESSION['logado'])){
        header("Location: view/dashboard/index.php");
        die();
    }

    $aviso = null;
    if(isset($_GET['aviso'])){
        $aviso = $_GET['aviso'];
    }

    switch ($aviso) {
        case 'erro':
            echo "<script>
                    alert ('Login ou senha errados');
                </script>";
            break;
    }


?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
    
        <!-- CSS -->
        <!-- <link href="css/style.css" rel="stylesheet"> -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link href="css/sb-admin-2.css" rel="stylesheet">
    </head>
    <body class="bg-gradient-primary" >
      <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

          <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
              <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row center">
                  <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                  <div class="col-lg-6">
                    <div class="p-5">
                      <div class="text-center">
                        <img id="logo" src="img/circle-blitz.png" alt="logoBlitz" width="150px" height="150px">
                        <br><br>
                        <h1 class="h4 text-gray-900 mb-4">Bem vindo!</h1>
                      </div>
                      <form class="user" method="POST" action="backEnd/backPolicial.php?option=logar">
                        <div class="form-group">
                          <input type="text" maxlenght="14" name="identificacaoUser" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Identificação">
                        </div>
                        <div class="form-group">
                          <input type="password" name="passwordUser" class="form-control form-control-user" id="exampleInputPassword" placeholder="Senha">
                        </div>
                        <button href="index.html" class="btn btn-primary btn-user btn-block">
                          Logar
                        </button>
                        
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


    
        <!-- JS -->
        <script src="js/background_login.js"></script>
        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>